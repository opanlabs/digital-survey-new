<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Roles;

use Illuminate\Http\Request;
use App\DataTables\UsersDataTable;
use Illuminate\Support\Facades\Hash;
use Auth;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(UsersDataTable $dataTable)
    {
        $roles = Roles::all();

        $approval_request = User::where('approved', '=', 0)->get();
        $count_approval_request = count($approval_request);
        // dd($total_approval_request);
        return $dataTable->render('dashboard.users.index',['roles' => $roles , 'approval_request' => $approval_request, 'count_approval_request' => $count_approval_request]);
    }


    public function approve(Request $request, $id)
    {   

        if ($request->type == 'confirm') {
            $users = User::find($id)->update([
                'approved' => 1,
            ]);
            return redirect()->back()->with('message', User::find($id)->name . ' Successfully Approved.');
        } else {
            User::destroy($id);
            return redirect()->back()->with('message','User declined and Deleted.');
        }
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
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users',
            'id_role' => 'required',
            'phone_number' => 'required',
            'new-password' => 'required|string|min:8|confirmed',

        ]);

        $users = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'id_role' => $request->id_role,
            'phone_number' => $request->phone_number,
            'id_team' => $request->id_team,
            'id_branch' => Auth::user()->id_branch,
            'password' => Hash::make($request->get('new-password')),
            'approved' => 1
        ]);

        return redirect()->back()->with('message','Data Successfully Added.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
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
            'email' => 'unique:users,email,'.$id.',id_user',
            'id_role' => 'required',
            'phone_number' => 'required'

        ]);

        $users = User::find($id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'id_role' => $request->id_role,
            'id_team' => $request->id_team,
            'phone_number' => $request->phone_number,
        ]);

        return redirect()->back()->with('message','Data Successfully Saved.');
    }

    public function resetPassword(Request $request, $id)
    {
        //untuk change password
        if($request->get('new-password')){
            $request->validate([
                'new-password' => 'required|string|min:8|confirmed',
            ]);
            
            $users = User::find($id)->update([
                'password' => Hash::make($request->get('new-password'))
            ]);
        };

        return redirect()->back()->with('message','Password Successfully Saved.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::destroy($id);

        return redirect()->back()->with('message','User Deleted.');
    }
}
