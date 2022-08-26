<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Roles;
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
        return $dataTable->render('dashboard.branch.index');
    }

}
