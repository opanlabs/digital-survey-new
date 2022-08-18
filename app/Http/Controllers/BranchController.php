<?php

namespace App\Http\Controllers;

use App\Models\branch;
use Illuminate\Http\Request;
use App\DataTables\BranchDataTable;

class BranchController extends Controller
{
    public function autocomplete(Request $request)
    {
        $branch = [];
        $search = $request->input('q');
        $branch = branch::select("id_branch", "provience_name")
                ->where('provience_name', 'like', "%$search%")
                ->get();
        return response()->json($branch);
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
