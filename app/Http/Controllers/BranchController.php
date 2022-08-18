<?php

namespace App\Http\Controllers;

use App\Models\branch;
use Illuminate\Http\Request;

class BranchController extends Controller
{
    public function autocomplete(Request $request)
    {
        $branch = [];
        $search = $request->input('q');
        $branch = branch::select("id_branch", "province_name")
                ->where('province_name', 'like', "%$search%")
                ->get();
        return response()->json($branch);
    }
}
