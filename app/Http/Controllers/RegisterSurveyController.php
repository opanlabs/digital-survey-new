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
use Auth;
use Mail;
use App\Mail\JinggaMail;

use Datatables;
use Redirect,Response,DB,Config;

use App\Exports\RegisterSurveyExport;
use Maatwebsite\Excel\Facades\Excel;

use Carbon\Carbon;
use \MacsiDigital\Zoom\Facades\Zoom;

use PDF;

class RegisterSurveyController extends Controller
{

    public function export_excel($id)
	{   
        $query = RegisterSurvey::where('id_register_survey',$id)->with(['vehicle','customer','branch'])->get();

		return Excel::download(new RegisterSurveyExport($query), 'RegisterSurveyExport_'. $query[0]->register_no .'_.xlsx');
	}

    public function export_pdf($id){
        $query = RegisterSurvey::where('id_register_survey',$id)->with(['vehicle','customer','branch'])->get();
        $pdf = PDF::loadView('exports.survey_export_pdf', compact('query'));
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

        foreach ($allCategories as $rootCategory) {
            $rootCategory->children = Part::where('id_typepart' , $rootCategory->id_typepart)->get();

            foreach ($rootCategory->children as $data) {
                $data->isStandard = false;
                $data->description = '';
            }
        }
        
        return $dataTable->render('dashboard.register-survey.index',['branch' => $branch , 'vehicle' => $vehicle , 'part' => $allCategories]);
    }

    public function report(RegisterSurveyReportDataTable $dataTable)
    {
        $branch = Branch::all();
        $vehicle = Vehicle::all();
        $allCategories = TypePart::get();

        foreach ($allCategories as $rootCategory) {
            $rootCategory->children = Part::where('id_typepart' , $rootCategory->id_typepart)->get();

            foreach ($rootCategory->children as $data) {
                $data->isStandard = false;
                $data->description = '';
            }
        }
        
        return $dataTable->render('dashboard.risk-report.index',['branch' => $branch , 'vehicle' => $vehicle , 'part' => $allCategories]);
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
        $list = RegisterSurvey::with('customer','vehicle','branch')->find($id);
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
        // return $request->type;
        $request->validate([
            'email' => 'unique:customer,email,'.$request->email.',email',
            'year' => 'required',
            'customer_name' => 'required',
            'phone_number' => 'required',
            'id_vehicle' => 'required',
            'plat_no' => 'required',
            'type' => 'required',
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

    public function reportSchedule(Request $request){
        $request->validate([
            'videoUpload' => 'required',
        ]);

        $obj = $request->photo;
        $temp = [];
        foreach($obj as $item){
            $temp[] = $item;
        }

        for ($i = 0; $i < count($temp); $i++)  {
            $temp[$i]['url'] = '';
            if(isset($temp[$i]['value'])){
                $file_name = $temp[$i]['value']->getClientOriginalName();
                $temp[$i]['value']->storeAs('public/images','register-survey-'.$file_name);
                $temp[$i]['url'] = \Storage::url('public/images/'.'register-survey-'.$file_name);       
            }else{
                $temp[$i]['url'] = '';
            }
        }
        $id = $request->id;

        $registerSurvey = RegisterSurvey::find($id);

        $link_report_zoom = '';
        $file_name = $request['videoUpload']->getClientOriginalName();
        $request['videoUpload']->storeAs('public/video','link-survey-report-'.$file_name);
        $link_report_zoom = \Storage::url('public/video/'.'link-survey-report-'.$file_name);     

        $registerSurvey->update([
            'descriptionVehicle' =>  $request->description,
            'isStandardVehicle' =>  $request->isStandard,
            'photoVehicle' =>  $temp,
            'status' =>  'DONE',
            'link_report_zoom' =>  $link_report_zoom
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
