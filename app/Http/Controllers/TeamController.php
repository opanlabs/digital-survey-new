<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Roles;
use App\Models\Team;
use App\Models\Branch;

use Illuminate\Http\Request;
use App\DataTables\TeamDataTable;
use Illuminate\Support\Facades\Hash;
use Auth;

class TeamController extends Controller
{   

    public function test_query(Request $request)
    {
        $team = [];

        $team = Team::with('branch')->get();

        return response()->json($team);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(TeamDataTable $dataTable)
    {
        $roles = Roles::whereIn('id_role', ['3','4'])->get();
        $team = Team::all();
        $branch = Branch::all();

        $approval_request = User::where('approved', '=', 0)
                                 ->where('id_branch', Auth::user()->id_branch)   
                                 ->get();
        $count_approval_request = count($approval_request);

        return $dataTable->render('dashboard.team.index',['roles' => $roles , 'approval_request' => $approval_request, 'count_approval_request' => $count_approval_request, 'team' => $team, 'branch' => $branch]);
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
            'name_team' => 'required',
            'id_branch' => 'required',
        ]);

        $users = Team::create([
            'name_team' => $request->name_team,
            'id_branch' => $request->id_branch,
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
        $request->validate([
            'name_team' => 'required',
            'id_branch' => 'required',

            'province_name' => 'required',
            'address' => 'required',
            'id_user' => 'required',

        ]);

        $team = Team::find($id)->update([
            'name_team' => $request->name_team,
            'id_branch' => $request->id_branch,
        ]);

        $branch = Branch::find($request->id_branch)->update([
            'province_name' => $request->province_name,
            'address' => $request->address,
            'id_user' => $request->id_user,
        ]);

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
        Team::destroy($id);

        return redirect()->back()->with('message','Team Deleted.');
    }
}
