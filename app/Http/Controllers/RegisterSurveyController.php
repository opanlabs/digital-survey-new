<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DataTables\RegisterSurveyDataTable;
use App\models\Branch;
use App\models\Vehicle;
use App\models\RegisterSurvey;
use App\models\Customer;
use App\models\User;
use Auth;

use Carbon\Carbon;
use \MacsiDigital\Zoom\Facades\Zoom;

class RegisterSurveyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(RegisterSurveyDataTable $dataTable)
    {
        $branch = Branch::all();
        $vehicle = Vehicle::all();
        
        return $dataTable->render('dashboard.register-survey.index',['branch' => $branch , 'vehicle' => $vehicle]);

        // $meetings = Zoom::user()->find('gakuran404@gmail.com')->meetings()->create([
        //     'topic' => 'Test Create Meeting',
        //     'duration' => 15, // In minutes, optional
        //     'start_time' => new Carbon('2022-01-01 03:00:00'),
        //     'timezone' => 'Asia/Jakarta',
        // ]);

        // $meetings->settings()->make([
        //     'join_before_host' => false,
        //     'enforce_login' => false,
        //     'waiting_room' => false,
        //   ]);
      
        // Zoom::user()->find('gekikara404@gmail.com')->meetings()->save($meetings);
      
        // return response()->json(['joinURL' => $meetings->join_url, 'data' => $meetings]);


        // $user = Zoom::user()->create([
        //     'first_name' => 'gaku',
        //     'last_name' => 'ran',
        //     'email' => 'gakuran404@gmail.com',
        //     'password' => 'admin123'
        // ]); 

        // return $user;
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
        // return $request;
            $request->validate([
                'email' => 'unique:customer,email,'.$request->email.',email',
                'year' => 'required',
                'customer_name' => 'required',
                'phone_number' => 'required',
                'id_vehicle' => 'required',
                'plat_no' => 'required',
                'surveyor' => 'required',
                'id_branch' => 'required',
            ]);
            // dd($request);

            $cus = Customer::create([
                'customer_name' => $request->customer_name,
                'phone_number' => $request->phone_number,
                'email' => $request->email
            ]);


            RegisterSurvey::create([
                'register_no' => substr(str_shuffle(MD5(microtime())), 0, 10),
                'id_customer' => $cus->id_customer,
                'id_vehicle' => $request->id_vehicle,
                'year' => $request->year,
                'plat_no' => $request->plat_no,
                'surveyor' => $request->surveyor,
                'id_user' => Auth::user()->id_user,
                'survey_date' => '',
                'link_zoom' => '',
                'status' => 'OPEN',
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
        // return $request;

        // return redirect()->back()->with('message','Data Successfully Added.');
    }

    public function updateSchedule(Request $request){
        $id = $request->id;

        $registerSurvey = RegisterSurvey::find($id);
        $user = User::find($registerSurvey->id_user);
        $customer = Customer::find($registerSurvey->id_customer);
        

        $meetings = Zoom::user()->find($user->email)->meetings()->create([
            'topic' => 'Survey Kendaraan Customer ' . $customer->customer_name,
            'duration' => 15, // In minutes, optional
            'start_time' => new Carbon($request->survey_date . ' 00:00:00'),
            'timezone' => 'Asia/Jakarta',
        ]);

        $meetings->settings()->make([
            'join_before_host' => false,
            'enforce_login' => false,
            'waiting_room' => false,
          ]);
      
        Zoom::user()->find('gekikara404@gmail.com')->meetings()->save($meetings);
      
        $registerSurvey->update([
            'survey_date' =>  $request->survey_date,
            'status' =>  'SCHEDULE',
            'link_zoom' => $meetings->join_url
        ]);


        return redirect()->back()->with('message','Added Schedule.');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deleteSurvey(Request $request)
    {
        RegisterSurvey::destroy($request->id);

        return redirect()->back()->with('message','Delete Survey.');
    }
}
