<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Roles;
use App\Models\Team;
use App\Models\User;

use Illuminate\Http\Request;
use App\DataTables\BranchDataTable;

class BranchController extends Controller
{
    public function autocomplete(Request $request)
    {
        $branch = [];
        $search = $request->input('q');
        $branch = Branch::select("id_branch", "province_name")
                ->where('province_name', 'like', "%$search%")
                ->get();
        return response()->json($branch);
    }

    public function autocompleteRole(Request $request)
    {
        
        $role = [];
        $search = $request->input('q');
        $role = Roles::select("id_role", "role")
                ->where('role', 'not like', "Super Admin")
                ->get();
        return response()->json($role);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(BranchDataTable $dataTable)
    {
        $user_admin = User::where('id_role', '=', 2)->get();
        $team = Team::all();
        $branch = Branch::all();

        return $dataTable->render('dashboard.branch.index',['user_admin' => $user_admin, 'team' => $team, 'branch' => $branch]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'province_name' => 'required',
            'id_user' => 'required',
            'address' => 'required',
        ]);

        $branch = Branch::create([
            'province_name' => $request->province_name,
            'id_user' => $request->id_user,
            'address' => $request->address,
        ]);

        return redirect()->back()->with('message','Data Successfully Added.');
    }

}
