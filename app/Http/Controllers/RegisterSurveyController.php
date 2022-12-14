<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DataTables\RegisterSurveyDataTable;
use App\DataTables\RegisterSurveyReportDataTable;
use App\Models\Branch;
use App\Models\Vehicle;
use App\Models\RegisterSurvey;
use App\Models\Customer;
use App\Models\User;
use App\Models\Part;
use App\Models\TypePart;
use App\Models\Transmission;
use Auth;
use Mail;
use App\Mail\JinggaMail;
use Validator;

use Datatables;
use Redirect,Response,DB,Config;

use App\Exports\RegisterSurveyExport;
use Maatwebsite\Excel\Facades\Excel;

use Carbon\Carbon;
use \MacsiDigital\Zoom\Facades\Zoom;

use PDF;

class RegisterSurveyController extends Controller
{   

    public function test_query()
    {
        // $meetingTomorrow = RegisterSurvey::whereDate('survey_date', '=', Carbon::tomorrow())->get();

        // foreach ($meetingTomorrow as $data) {
        //     $mailData = [
        //         'name' => $data->customer->customer_name,
        //         'link' => $data->link_zoom,
        //         'hours' => Carbon::parse($data->survey_date)->format('H:i')
        //     ];
        //     Notification::route('mail',$data->customer->email)->notify(new ScheduleNotification($mailData));
        //     echo('email sended to '.$data->customer->customer_name.PHP_EOL);
        // }
    }

    public function export_excel($id)
	{   
        $query = RegisterSurvey::where('id_register_survey',$id)->with(['vehicle','customer','branch','transmission'])->get();
		return Excel::download(new RegisterSurveyExport($query), 'RegisterSurveyExport_'. $query[0]->register_no .'_.xlsx');
	}

    public function export_excel_survey_summary_report(Request $request){
        $id_vehicle = null;
        $id_branch = null;
        if ($request->id_vehicle) {
            $id_vehicle = (int)$request->id_vehicle;
        }
        if ($request->id_branch) {
            $id_branch = (int)$request->id_branch;
        }

        $query = RegisterSurvey::query();
        if ($id_vehicle !== null) {
            $query
            ->when($id_vehicle, function ($query) use ($id_vehicle){
                return  $query->Where('id_vehicle', $id_vehicle);
            });
        }
        if ($id_branch !== null) {
            $query
            ->when($id_branch, function ($query) use ($id_branch){
                return  $query->Where('id_branch', $id_branch);
            });
        }

        $data = Auth::user()->id_role === 1 ? $query
        ->with(['vehicle','customer','branch','transmission'])
        ->where('status', 'DONE')
        ->get() : 
        $query
        ->with(['vehicle','customer','branch','transmission'])
        ->where([['status', 'DONE'],['id_branch', Auth::user()->id_branch]])
        ->get();

        return Excel::download(new RegisterSurveyExport($data), 'RegisterSurveyReportExport_'.date('d F Y').'_.xlsx');
    }

    public function export_excel_survey_summary(Request $request){
        $id_vehicle = null;
        $id_branch = null;
        if ($request->id_vehicle) {
            $id_vehicle = (int)$request->id_vehicle;
        }
        if ($request->id_branch) {
            $id_branch = (int)$request->id_branch;
        }

        $query = RegisterSurvey::query();
        if ($id_vehicle !== null) {
            $query
            ->when($id_vehicle, function ($query) use ($id_vehicle){
                return  $query->Where('id_vehicle', $id_vehicle);
            });
        }
        if ($id_branch !== null) {
            $query
            ->when($id_branch, function ($query) use ($id_branch){
                return  $query->Where('id_branch', $id_branch);
            });
        }

        $data = Auth::user()->id_role === 1 ? $query
        ->with(['vehicle','customer','branch','transmission'])
        ->get() : 
        $query
        ->with(['vehicle','customer','branch','transmission'])
        ->where('id_branch', Auth::user()->id_branch)
        ->get();

        return Excel::download(new RegisterSurveyExport($data), 'RegisterSurveyExport_'.date('d F Y').'_.xlsx');
    }

    public function export_pdf($id){
        $query = RegisterSurvey::where('id_register_survey',$id)->with(['vehicle','customer','branch','transmission'])->get();
        $regist = $query[0];
        $allCategories = TypePart::get();

        foreach ($allCategories as $rootCategory) {
            $rootCategory->children = Part::where('id_typepart' , $rootCategory->id_typepart)->get();

            foreach ($rootCategory->children as $data) {
                // desc veh
                $arrVehicle = json_decode($regist->descriptionVehicle, true);
                $tempVeh = [];
                for ($x = 1; $x < count($arrVehicle) + 1; $x++)
                {
                    $tempVeh[] = $arrVehicle[$x];
                }

                for ($a = 0; $a < count($tempVeh); $a++)
                {
                    if ($tempVeh[$a]['id_part'] == $data->id_part) {
                        $data->description = $tempVeh[$a]['value'] ?? '';
                    }
                }

                // standard veh 

                $arrStandard = json_decode($regist->isStandardVehicle, true);
                $tempStandard = [];
                for ($b = 1; $b < count($arrStandard) + 1; $b++)
                {
                    $tempStandard[] = $arrStandard[$b];
                }

                for ($c = 0; $c < count($tempStandard); $c++)
                {
                    if ($tempStandard[$c]['id_part'] == $data->id_part) {
                        $data->isStandard = $tempStandard[$c]['value'] ?? false;
                    }
                }
                
                // photo veh

                $arrPhoto = json_decode($regist->photoVehicle, true);

                for ($d = 0; $d < count($arrPhoto); $d++)
                {
                    if ($arrPhoto[$d]['id_part'] == $data->id_part) {
                        $data->photoURL = $arrPhoto[$d]['url'] ?? false;
                    }
                }
            }
        }

        $pdf = PDF::loadView('exports.survey_export_pdf', compact('query' , 'allCategories'));
        return $pdf->download('RegisterSurveyExport_'.$query[0]->register_no.'_.pdf');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(RegisterSurveyDataTable $dataTable)
    {
        $branch = Branch::all();
        $vehicle = Vehicle::all();
        $allCategories = TypePart::get();
        $transmission = Transmission::all();

        foreach ($allCategories as $rootCategory) {
            $rootCategory->children = Part::where('id_typepart' , $rootCategory->id_typepart)->get();

            foreach ($rootCategory->children as $data) {
                $data->isStandard = false;
                $data->description = '';
            }
        }
        
        return $dataTable->render('dashboard.register-survey.index',['branch' => $branch , 'vehicle' => $vehicle , 'part' => $allCategories , 'transmission' => $transmission ]);
    }

    public function report(RegisterSurveyReportDataTable $dataTable)
    {
        $branch = Branch::all();
        $vehicle = Vehicle::all();
        $allCategories = TypePart::get();
        $transmission = Transmission::all();

        foreach ($allCategories as $rootCategory) {
            $rootCategory->children = Part::where('id_typepart' , $rootCategory->id_typepart)->get();

            foreach ($rootCategory->children as $data) {
                $data->isStandard = false;
                $data->description = '';
            }
        }
        
        return $dataTable->render('dashboard.risk-report.index',['branch' => $branch , 'vehicle' => $vehicle , 'part' => $allCategories , 'transmission' => $transmission]);
    }
    
    //dipakai untuk return json nama,jadwal,link zoom meeting
    public function meetSchedule(Request $request)
    {
        $meetSchedule = [];

        $meetSchedule = RegisterSurvey::with("customer:id_customer,customer_name")
                ->where('status', 'like', "%SCHEDULE%")
                ->get()
                ->map(function($data){
                    return [
                        // 'id_register_survey' => $data->id_register_survey,
                        'title' => $data->customer->customer_name,
                        'start' => $data->survey_date,
                        'url' => $data->link_zoom,
                    ];
                });
        return response()->json($meetSchedule);
    }

    public function filterRegisterDate()
    {
        $registerQuery = RegisterSurvey::query();
 
        $start_date = (!empty($_GET["start_date"])) ? ($_GET["start_date"]) : ('');
        $end_date = (!empty($_GET["end_date"])) ? ($_GET["end_date"]) : ('');
 
        if($start_date && $end_date){
 
         $start_date = date('Y-m-d', strtotime($start_date));
         $end_date = date('Y-m-d', strtotime($end_date));
 
         $registerQuery->whereRaw("date(created_at) >= '" . $start_date . "' AND date(created_at) <= '" . $end_date . "'");
        }
        $RegisterSurvey = $registerQuery->select('*');
        return datatables()->of($RegisterSurvey)
            ->make(true);
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

    public function detailSurvey(Request $request){
        $id = $request->id;
        $list = RegisterSurvey::with('customer','vehicle','branch','transmission')->find($id);
        return response()->json(['details'=>$list]);
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
                'type' => 'required',
                'id_transmission' => 'required',
                'colour' => 'required'
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
                'type' => $request->type,
                'year' => $request->year,
                'plat_no' => $request->plat_no,
                'id_user' => Auth::user()->id_user,
                'survey_date' => '-',
                'link_zoom' => '',
                'surveyor' => '-',
                'descriptionVehicle' => '{}',
                'isStandardVehicle' => '{}',
                'photoVehicle' => '{}',
                'link_report_zoom' => '',
                'status' => 'OPEN',
                'id_branch' => Auth::user()->id_branch,
                'id_transmission' => $request->id_transmission,
                'colour' => $request->colour
            ]);
        return redirect()->back()->with('message','Data Successfully Added.');
    }
    public function send_email(Request $request){
        $id = $request->id;

        $registerSurvey = RegisterSurvey::find($id);
        $user = User::find(Auth::user()->id_user);
        $customer = Customer::find($registerSurvey->id_customer);

        $meetings = Zoom::user()->find($user->email)->meetings()->create([
            'topic' => 'Survey Kendaraan Customer ' . $customer->customer_name,
            'duration' => 15, // In minutes, optional
            'start_time' => new Carbon($request->survey_date),
            'timezone' => 'Asia/Jakarta',
        ]);

        $meetings->settings()->make([
            'join_before_host' => false,
            'enforce_login' => false,
            'waiting_room' => false,
          ]);
      
        Zoom::user()->find($user->email)->meetings()->save($meetings);

        $mailData = [
            'email' => $customer->customer_name,
            'link' => $meetings->join_url
        ];

        Mail::to($customer->email)->send(new JinggaMail($mailData));
      
        $registerSurvey->update([
            'survey_date' =>  $request->survey_date,
            'status' =>  'SCHEDULE',
            'link_zoom' => $meetings->join_url,
            'id_user' => Auth::user()->id_user,
            'surveyor' => $user->name,
        ]);

        return redirect()->back()->with('message','Data Successfully Reschedule to '. $customer->email );
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
        // return $request->type;
        $request->validate([
            'email' => 'unique:customer,email,'.$request->email.',email',
            'year' => 'required',
            'customer_name' => 'required',
            'phone_number' => 'required',
            'id_vehicle' => 'required',
            'plat_no' => 'required',
            'type' => 'required',
            'id_transmission' => 'required',
            'colour' => 'required'
        ]);
        
        $cus = Customer::find($request->id_customer)->update([
            'customer_name' => $request->customer_name,
            'phone_number' => $request->phone_number,
            'email' => $request->email
        ]);

        RegisterSurvey::find($id)->update([
            'id_customer' => $request->id_customer,
            'id_vehicle' => $request->id_vehicle,
            'type' => $request->type,
            'year' => $request->year,
            'plat_no' => $request->plat_no,
            'id_branch' => Auth::user()->id_branch,
            'id_transmission' => $request->id_transmission,
            'colour' => $request->colour
        ]);
        
        return redirect()->back()->with('message','Data Successfully Updated.');
    }

    public function updateSchedule(Request $request){
        $id = $request->id;

        $registerSurvey = RegisterSurvey::find($id);
        $user = User::find(Auth::user()->id_user);
        $customer = Customer::find($registerSurvey->id_customer);

        $meetings = Zoom::user()->find($user->email)->meetings()->create([
            'topic' => 'Survey Kendaraan Customer ' . $customer->customer_name,
            'duration' => 15, // In minutes, optional
            'start_time' => new Carbon($request->survey_date),
            'timezone' => 'Asia/Jakarta',
        ]);

        $meetings->settings()->make([
            'join_before_host' => false,
            'enforce_login' => false,
            'waiting_room' => false,
          ]);
      
        Zoom::user()->find($user->email)->meetings()->save($meetings);

        $mailData = [
            'email' => $customer->customer_name,
            'link' => $meetings->join_url
        ];

        Mail::to($customer->email)->send(new JinggaMail($mailData));
      
        $registerSurvey->update([
            'survey_date' =>  $request->survey_date,
            'status' =>  'SCHEDULE',
            'link_zoom' => $meetings->join_url,
            'id_user' => Auth::user()->id_user,
            'surveyor' => $user->name,
        ]);


        return redirect()->back()->with('message','Added Schedule.');
    }

    public function ajaxUploadVideo(Request $request)
    {       
        $validator =  Validator::make($request->all(),[
            'videoUpload' => 'required | max:200048',
        ]);

        $registerSurvey = RegisterSurvey::find($request->id);

        $link_report_zoom = '';
        $file_name = $request['videoUpload']->getClientOriginalName();
        $request['videoUpload']->storeAs('file','link_survey_report_'.$file_name);
        $link_report_zoom = \Storage::url('file/'.'link_survey_report_'.$file_name);    

        $registerSurvey->update([
            'link_report_zoom' =>  $link_report_zoom
        ]); 

        if ($validator->fails())  {
            return \Response::json(array("errors" => $validator->getMessageBag()->toArray()), 422);
        }
    }

    public function reportSchedule(Request $request){
        $obj = $request->photo;
        $temp = [];
        foreach($obj as $item){
            $temp[] = $item;
        }

        for ($i = 0; $i < count($temp); $i++)  {
            $temp[$i]['url'] = '';
            if(isset($temp[$i]['value'])){
                $file_name = $temp[$i]['value']->getClientOriginalName();
                $temp[$i]['value']->storeAs('file','register_survey_'.$file_name);
                $temp[$i]['url'] = \Storage::url('file/'.'register_survey_'.$file_name);       
            }else{
                $temp[$i]['url'] = '';
            }
        }
    
        $file_name_bukti = $request['link_bukti_meeting']->getClientOriginalName();
        $request['link_bukti_meeting']->storeAs('file','link_bukti_meeting_'.$file_name_bukti);
        $link_bukti_meeting = \Storage::url('file/'.'link_bukti_meeting_'.$file_name_bukti);   

        $id = $request->id;

        $registerSurvey = RegisterSurvey::find($id);   

        $registerSurvey->update([
            'descriptionVehicle' =>  $request->description,
            'isStandardVehicle' =>  $request->isStandard,
            'photoVehicle' =>  $temp,
            'status' =>  'DONE',
            'link_bukti_meeting' => $link_bukti_meeting
        ]);

        return redirect()->back()->with('message','Report Schedule Success.');
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
