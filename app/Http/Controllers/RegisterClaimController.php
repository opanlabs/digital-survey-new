<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DataTables\RegisterClaimDataTable;
use App\DataTables\RegisterClaimReportDataTable;
use App\Models\Branch;
use App\Models\Vehicle;
use App\Models\RegisterClaim;
use App\Models\RegisterSurvey;
use App\Models\Customer;
use App\Models\User;
use App\Models\Part;
use App\Models\TypePart;
use Auth;
use Mail;
use App\Mail\JinggaMail;
use Validator;

use App\Exports\RegisterClaimExport;
use Maatwebsite\Excel\Facades\Excel;

use Carbon\Carbon;
use \MacsiDigital\Zoom\Facades\Zoom;

use PDF;

class RegisterClaimController extends Controller
{

	public function export_excel($id)
	{   
        $query = RegisterClaim::where('id_register_claim',$id)->with(['vehicle','customer','user','branch','register_survey'])->get();

		return Excel::download(new RegisterClaimExport($query), 'RegisterClaimExport_'. $query[0]->register_survey->register_no .'_.xlsx');
	}

    public function export_pdf($id){
        $query = RegisterClaim::where('id_register_claim',$id)->with(['vehicle','customer','user','branch','register_survey'])->get();
        $pdf = PDF::loadView('exports.claim_export_pdf', compact('query'));
        return $pdf->download('RegisterClaimExport_'.$query[0]->register_survey->register_no.'_.pdf');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(RegisterClaimDataTable $dataTable)
    {
        $branch = Branch::all();
        $vehicle = Vehicle::all();
        $allCategories = TypePart::get();
        $registerSurvey = Auth::user()->id_role === 1 ? RegisterSurvey::where([
            ['status', 'DONE'],
        ])->get() : RegisterSurvey::where([
            ['id_branch', Auth::user()->id_branch],
            ['status', 'DONE'],
        ])->get();

        foreach ($allCategories as $rootCategory) {
            $rootCategory->children = Part::where('id_typepart' , $rootCategory->id_typepart)->get();

            foreach ($rootCategory->children as $data) {
                $data->isStandard = false;
                $data->description = '';
            }
        }
        
        return $dataTable->render('dashboard.register-claim.index',['branch' => $branch , 'vehicle' => $vehicle , 'part' => $allCategories ,'registerSurvey' => $registerSurvey ]);
    }

    public function report(RegisterClaimReportDataTable $dataTable)
    {
        $branch = Branch::all();
        $vehicle = Vehicle::all();
        $allCategories = TypePart::get();
        $registerSurvey = RegisterSurvey::where([
            ['id_branch', Auth::user()->id_branch],
            ['status', 'DONE'],
        ])->get();

        foreach ($allCategories as $rootCategory) {
            $rootCategory->children = Part::where('id_typepart' , $rootCategory->id_typepart)->get();

            foreach ($rootCategory->children as $data) {
                $data->isStandard = false;
                $data->description = '';
            }
        }
        
        return $dataTable->render('dashboard.claim-report.index',['branch' => $branch , 'vehicle' => $vehicle , 'part' => $allCategories ,'registerSurvey' => $registerSurvey ]);
    }
    
    //dipakai untuk return json nama,jadwal,link zoom meeting
    public function meetSchedule(Request $request)
    {
        $meetSchedule = [];

        $meetSchedule = RegisterClaim::with("customer:id_customer,customer_name")
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    public function detailClaim(Request $request){
        $id = $request->id;
        $list = RegisterClaim::with('customer','vehicle','branch','register_survey')->find($id);
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
            $request->validate([
                'no_polis' => 'required',
                'id_register_survey' => 'required',
                'email' => 'unique:customer,email,'.$request->email.',email',
                'year' => 'required',
                'customer_name' => 'required',
                'phone_number' => 'required',
                'id_vehicle' => 'required',
                'type' => 'required',
                'plat_no' => 'required'
            ]);

            $cus = Customer::create([
                'customer_name' => $request->customer_name,
                'phone_number' => $request->phone_number,
                'email' => $request->email
            ]);


            RegisterClaim::create([
                'no_polis' => $request->no_polis,
                'id_register_survey' => $request->id_register_survey,
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

    public function send_email(Request $request){
        $data = RegisterClaim::where('id_register_claim', $request->id)->with(['customer'])->first();
        $mailData = [
            'email' => $data->customer->email,
            'link' => $data->link_zoom
        ];

        Mail::to($data->customer->email)->send(new JinggaMail($mailData));

        return redirect()->back()->with('message','Data Successfully Resend Email to '. $data->customer->email );
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
            'no_polis' => 'required',
            'id_register_survey' => 'required',
            'email' => 'unique:customer,email,'.$request->email.',email',
            'year' => 'required',
            'customer_name' => 'required',
            'phone_number' => 'required',
            'id_vehicle' => 'required',
            'type' => 'required',
            'plat_no' => 'required',
        ]);
        
        $cus = Customer::find($request->id_customer)->update([
            'customer_name' => $request->customer_name,
            'phone_number' => $request->phone_number,
            'email' => $request->email
        ]);

        RegisterClaim::find($id)->update([
            'no_polis' => $request->no_polis,
            'id_register_survey' => $request->id_register_survey,
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

        $registerSurvey = RegisterClaim::find($id);
        $user = User::find(Auth::user()->id_user);
        $customer = Customer::find($registerSurvey->id_customer);

        $meetings = Zoom::user()->find($user->email)->meetings()->create([
            'topic' => 'Claim Kendaraan Customer ' . $customer->customer_name,
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

        $registerSurvey = RegisterClaim::find($request->id);

        $link_report_zoom = '';
        $file_name = $request['videoUpload']->getClientOriginalName();
        $request['videoUpload']->storeAs('public/video','link-claim-report-'.$file_name);
        $link_report_zoom = \Storage::url('public/video/'.'link-claim-report-'.$file_name);    

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
                $temp[$i]['value']->storeAs('public/images','register-claim-'.$file_name);
                $temp[$i]['url'] = \Storage::url('public/images/'.'register-claim-'.$file_name);       
            }else{
                $temp[$i]['url'] = '';
            }
        }

        $file_name_bukti = $request['link_bukti_meeting']->getClientOriginalName();
        $request['link_bukti_meeting']->storeAs('public/image','link-bukti-meeting-'.$file_name_bukti);
        $link_bukti_meeting = \Storage::url('public/image/'.'link-bukti-meeting-'.$file_name_bukti);   

        $id = $request->id;
        $registerSurvey = RegisterClaim::find($id);

        // $link_report_zoom = '';
        // $file_name = $request['videoUpload']->getClientOriginalName();
        // $request['videoUpload']->storeAs('public/video','link-claim-report-'.$file_name);
        // $link_report_zoom = \Storage::url('public/video/'.'link-claim-report-'.$file_name);     

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
    public function deleteClaim(Request $request)
    {
        RegisterClaim::destroy($request->id);

        return redirect()->back()->with('message','Delete Survey.');
    }
}
