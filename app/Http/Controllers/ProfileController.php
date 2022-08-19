<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\User;
use Illuminate\Support\Facades\Hash;
use Auth;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.profile.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {       
        // dd($request);
        $request->validate([
            'name' => 'required',
            'email' => 'unique:users,email,'.$request->id_user.',id_user',
            'id_branch' => 'required',
            'phone_number' => 'required'

        ]);

        //untuk change password
        if($request->get('new-password')){
            $request->validate([
                'current-password' => 'required',
                'new-password' => 'required|string|min:8|confirmed',
            ]);

            if (!(Hash::check($request->get('current-password'), Auth::user()->password))) {
                // Cek Password apakah sesuai dengan password sebelumnya
                return redirect()->back()->with("error","Your current password does not matches with the password.");
            }

            if(strcmp($request->get('current-password'), $request->get('new-password')) == 0){
                // Cek password apakah sama dengan password sebelumnya
                return redirect()->back()->with("error","New Password cannot be same as your current password.");
            }

            $users = User::find($request->id_user)->update([
                'password' => Hash::make($request->get('new-password'))
            ]);
        };

        $users = User::find($request->id_user)->update([
            'name' => $request->name,
            'email' => $request->email,
            'id_branch' => $request->id_branch,
            'phone_number' => $request->phone_number,
        ]);

        //untuk update foto
        if ($request->file('photo')) {

            $request->validate([
                'url' => 'file|max:5120|mimes:jpg,jpeg',
            ]);
            
            $file_name = $request->file('photo')->getClientOriginalName();
            $extension = pathinfo($file_name, PATHINFO_EXTENSION);
            if(Auth::user()->photo_url){
                \Storage::delete(Auth::user()->photo_url);
              }
            $users = User::find($request->id_user)->update([
                'photo_url' =>  $request->file('photo')->storeAs('public/images','photo-profile-'.$request->id.'.'.$extension),
            ]);
        };

        //hapus photo profile
        if (!empty($request->photo_remove)) {
            if(\Storage::exists(Auth::user()->photo_url)){
                \Storage::delete(Auth::user()->photo_url);
              }
            $users = User::find($request->id_user)->update([
            'photo_url' =>  null,
            ]);
        }

        return redirect()->back()->with('message','Data Successfully Saved.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
