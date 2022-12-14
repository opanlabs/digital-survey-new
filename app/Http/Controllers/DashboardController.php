<?php

namespace App\Http\Controllers;
use App\Charts\RegisterChart;
use App\Charts\PolishChart;
use App\Charts\ClaimChart;
use App\Charts\RiskChart;

use App\Models\Branch;
use App\Models\Vehicle;
use App\Models\TypePart;
use App\Models\RegisterSurvey;
use App\Models\RegisterClaim;
use App\Models\Part;
use Auth;

use App\DataTables\RegisterClaimDashboardDataTable;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(RegisterChart $RegisterChart,PolishChart $PolishChart,ClaimChart $ClaimChart,RiskChart $RiskChart ,RegisterClaimDashboardDataTable $dataTable )
    {   
        $branch = Branch::all();
        $vehicle = Vehicle::all();
        $allCategories = TypePart::get();
        $registerSurvey = RegisterSurvey::where('id_branch', Auth::user()->id_branch)->get();
        $total_polis_perbranch = RegisterClaim::select('no_polis')->where('id_branch', Auth::user()->id_branch)->distinct()->get()->count();
        $total_register_claim_perbranch = RegisterClaim::where('id_branch', Auth::user()->id_branch)->get()->count();

        foreach ($allCategories as $rootCategory) {
            $rootCategory->children = Part::where('id_typepart' , $rootCategory->id_typepart)->get();

            foreach ($rootCategory->children as $data) {
                $data->isStandard = false;
                $data->description = '';
            }
        }

        return $dataTable->render('dashboard.index',[
        
                'RegisterChart' => $RegisterChart->build(),
                'PolishChart' => $PolishChart->build(),
                'ClaimChart' => $ClaimChart->build(),
                'RiskChart' => $RiskChart->build(),
                'branch' => $branch , 
                'vehicle' => $vehicle , 
                'part' => $allCategories ,
                'registerSurvey' => $registerSurvey ,
                'total_register_claim_perbranch' => $total_register_claim_perbranch ,
                'total_polis_perbranch' => $total_polis_perbranch ,
            ]);
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
        //
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
