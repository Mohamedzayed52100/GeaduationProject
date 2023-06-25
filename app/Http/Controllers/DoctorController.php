<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Doctor;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;
use Carbon\Carbon;


//Routes of doctor interface in the doctor.php

class DoctorController extends Controller
{

    public $lop = true;

    /******************************************** Doctor Dashboard ***********************************************/
    public function HomeDoctor()
    {
        //Calculate #cases(stable,unstable,emergency) where the date == today
        $today = Carbon::today();

        $dataTodaystable = DB::table('patient-vital-sign')
        ->join('doctor-patient', 'doctor-patient.MRN', '=', 'patient-vital-sign.MRN')
        ->whereDate('recorded_at', '=', $today)
        ->where('report', 'stable')
        ->where('doctor-patient.doctor_id', session('doctorid'))
        ->distinct()->count('patient-vital-sign.MRN');

        $dataTodayunstable = DB::table('patient-vital-sign')
        ->join('doctor-patient', 'doctor-patient.MRN', '=', 'patient-vital-sign.MRN')
        ->whereDate('recorded_at', '=', $today)
        ->where('report', 'unstable')
        ->where('doctor-patient.doctor_id', session('doctorid'))
        ->distinct()->count('patient-vital-sign.MRN');

        $dataTodayemergency =DB::table('patient-vital-sign')
        ->join('doctor-patient', 'doctor-patient.MRN', '=', 'patient-vital-sign.MRN')
        ->whereDate('recorded_at', '=', $today)
        ->where('report', 'emergency')
        ->where('doctor-patient.doctor_id', session('doctorid'))
        ->distinct()->count('patient-vital-sign.MRN');



        //Calculate #cases(stable,unstable,emergency) where the date == yesterday
        $yesterday = Carbon::yesterday();

        $dataYesterdaystable = DB::table('patient-vital-sign')
        ->join('doctor-patient', 'doctor-patient.MRN', '=', 'patient-vital-sign.MRN')
        ->whereDate('recorded_at', '=', $yesterday)
        ->where('report', 'stable')
        ->where('doctor-patient.doctor_id', session('doctorid'))
        ->distinct()->count('patient-vital-sign.MRN');

        $dataYesterdayunstable = DB::table('patient-vital-sign')
        ->join('doctor-patient', 'doctor-patient.MRN', '=', 'patient-vital-sign.MRN')
        ->whereDate('recorded_at', '=', $yesterday)
        ->where('report', 'unstable')
        ->where('doctor-patient.doctor_id', session('doctorid'))
        ->distinct()->count('patient-vital-sign.MRN');


        $dataYesterdayemergency = DB::table('patient-vital-sign')
        ->join('doctor-patient', 'doctor-patient.MRN', '=', 'patient-vital-sign.MRN')
        ->whereDate('recorded_at', '=', $yesterday)
        ->where('report', 'emergency')
        ->where('doctor-patient.doctor_id', session('doctorid'))
        ->distinct()->count('patient-vital-sign.MRN');


        //Calculate #cases(stable,unstable,emergency) where the date == last week
        $lastWeekStart = Carbon::now()->subWeek()->startOfWeek();
        $lastWeekEnd = Carbon::now()->subWeek()->endOfWeek();

        $dataLastWeekstable = DB::table('patient-vital-sign')
        ->join('doctor-patient', 'doctor-patient.MRN', '=', 'patient-vital-sign.MRN')
        ->whereBetween('recorded_at', [$lastWeekStart, $lastWeekEnd])
        ->where('report', 'stable')
        ->where('doctor-patient.doctor_id', session('doctorid'))
        ->distinct()->count('patient-vital-sign.MRN');

        $dataLastWeekunstable =DB::table('patient-vital-sign')
        ->join('doctor-patient', 'doctor-patient.MRN', '=', 'patient-vital-sign.MRN')
        ->whereBetween('recorded_at', [$lastWeekStart, $lastWeekEnd])
        ->where('report', 'unstable')
        ->where('doctor-patient.doctor_id', session('doctorid'))
        ->distinct()->count('patient-vital-sign.MRN');

        $dataLastWeekemergency = DB::table('patient-vital-sign')
        ->join('doctor-patient', 'doctor-patient.MRN', '=', 'patient-vital-sign.MRN')
        ->whereBetween('recorded_at', [$lastWeekStart, $lastWeekEnd])
        ->where('report', 'emergency')
        ->where('doctor-patient.doctor_id', session('doctorid'))
        ->distinct()->count('patient-vital-sign.MRN');




        $table_show_unstable = DB::table('patient')
        ->join('patient-disease', 'patient.MRN', '=', 'patient-disease.MRN')
        ->join('doctor-patient', 'doctor-patient.MRN', '=', 'patient.MRN')
        ->join('disease', 'disease.disease_id', 'patient-disease.disease_id')
        ->join('patient-vital-sign', 'patient-vital-sign.MRN', 'patient.MRN')
        ->whereDate('recorded_at', '=', $today)
        ->where('doctor-patient.doctor_id', session('doctorid'))
        ->where('patient-vital-sign.report', 'unstable')
        ->distinct()->get();




        //Zoom meeting
        $zoom_data_id =DB::table('zoom')
        ->join('zoompatient' , 'primary_id' , 'zoompatient.zoom_id')
        ->where([
            ['zoompatient.doctor_id' , session('doctorid')],
            ['start_at' , '>=' , now()],
        ])->select('primary_id')->distinct()->get();
        

        return view('doctor_pages.HomeDoctor', get_defined_vars());

    }


    /******************************************** Medical Report ***********************************************/
    public function medicalrecord_Doctor($id)
    {
        $PatientData = DB::table('patient')
        ->where('patient.MRN' , $id)->first();

        $VitalData = DB::table('patient')
        ->join('patient-vital-sign', 'patient.MRN', '=', 'patient-vital-sign.MRN')
        ->where('patient.MRN' , $id)->orderBy('recorded_at' ,'desc')->first();

        $patient_age = Carbon::parse($PatientData->birth_of_date)->age;


        $dataforhealthstatus = DB::table('patient')
        ->join('patient-disease', 'patient.MRN', '=', 'patient-disease.MRN')
        ->where('patient.MRN', $id)->get();

        $diseasenum = count( $dataforhealthstatus);
        $alldiseases='';
        foreach($dataforhealthstatus as $key =>$value){
            $alldiseases .= DB::table('disease')->where('disease_id' , $value->disease_id)->first()->disease_name ;
            if($diseasenum > 1){
                $alldiseases .= ',';
            }
            $diseasenum --;
        }
        $d = DB::table('patient')
        ->join('patient-disease', 'patient.MRN', '=', 'patient-disease.MRN')
        ->join('disease', 'disease.disease_id', '=', 'patient-disease.disease_id')
        ->where('patient.MRN', $id)
        ->select('disease_name')
        ->get();
       
        $data_complaint =  DB::table('patient_complaint')->where('MRN', $id)->orderBy('created_at', 'desc')->first(); //modern

        //Lab Results
        $Lab_result = DB::table('lab_appointment')
            ->join('patient', 'patient.MRN', '=', 'lab_appointment.MRN')
            ->join('lab_result', 'lab_result.appointment_id', '=', 'lab_appointment.appointment_id')
            ->join('disease_test', 'disease_test.test_id', '=', 'lab_result.test_id')
            ->select('*')
            ->where([
                ['lab_appointment.MRN' , '=' , $id ] , 
                ['lab_appointment.status' , '=' , 'done' ] , 
            ])
            ->orderBy('upload_date', 'DESC')
            ->paginate(5);
  
        //Sensor Data
        $readings = DB::table('sensordata')->where([
            ['heart' , '<>' , -999 ] , 
            ['oxygen' , '<>' , -999 ] , 
            ['patient_id' , $id],
            ])->orderBy('created_at', 'asc')
            ->get();
  

        // Format the data for a Google Chart
        $chartData = array();
        $chartData[] = array('Date', 'heart', 'oxygen');
        foreach ($readings as $reading) {
            $date = date('Y-m-d H:i:s', strtotime($reading->created_at));
            $heart = intval($reading->heart);
            $oxygen = intval($reading->oxygen);
            $chartData[] = array($date, $heart, $oxygen);
        }

        $chartDataJson = json_encode($chartData);
        $patient_id = $id;

        return view('doctor_pages.medicalrecord_Doctor', get_defined_vars());
    }

    //Send Doctor Notes in the medical report view
    public function medicalrecord_Doctor_submit(Request $request)
    {

        $request->validate([
            'newnotes' => 'required',
        ]);


        DB::table('patient_complaint')->where('MRN', $request->patient_id)->update([
            'notes' => $request->newnotes,
        ]);
        return back()->with('newnotes', 'Your notes have been submitted');
    }




    /******************************************** Emergency List ***********************************************/
    //Show emergency cases
    public function emergencyList()
    {

        $today = Carbon::today();

        $data = DB::table('patient')
            ->join('patient-vital-sign', 'patient.MRN', 'patient-vital-sign.MRN')
            ->join('doctor-patient', 'doctor-patient.MRN', '=', 'patient.MRN')
            ->where('patient-vital-sign.report', 'emergency')
            ->whereDate('recorded_at', '=', $today)
            ->where('doctor-patient.doctor_id', session('doctorid'))
            ->orderBy('recorded_at', 'desc')
            ->pluck('patient-vital-sign.MRN')->toArray();
        $numbers = collect($data);
        $uniqueNumbers = $numbers->unique()->values()->all();

        $final_res = DB::table('patient')
        ->whereIn('patient.MRN', $uniqueNumbers)->get();

        return view('doctor_pages.emergencyList', get_defined_vars());

    }


    /******************************************** Doctor Profile ***********************************************/
    //show doctor profile
    public function DoctorProfile()
    {

        $doctor = Doctor::where('doctor_id', session('doctorid'))->first();

        $paient_count = DB::table('doctor-patient')->where('doctor_id', session('doctorid'))->count();

        return view('doctor_pages.DoctorProfile', get_defined_vars());

    }



    //Edit doctor password in the doctor dashboard 
    public function changeDoctorPassword(Request $request)
    {
        $request->validate([
            'old' => 'required',
            'password' => 'required',
            'password_comfirmation' => 'required',

        ]);

        DB::table('doctor')->where('doctor_id', $request->doctor_id)->update([
            'password' => $request->password,

        ]);
       
        DB::table('users')->where('id' , session('userLogin')->id)->update([
            'password'=>Hash::make($request->password),

        ]);

        $data =DB::table('doctor')->where('doctor_id' , $request->doctor_id)->first();
        $d =DB::table('users')->where('id' , session('userLogin')->id)->first();

        session([
            'doctor_login' => $data,
            'userLogin'=>$d,   
        ]);
        return back()->with('password_updated', 'Password has been updated');

    }


    //Edit doctor profile in the doctor dashboard 
    public function editDoctorPersonalInfo(Request $request)
    {

        DB::table('doctor')->where('doctor_id', $request->doctor_id)->update([
            'name' => $request->name,
            'speciality' => $request->speciality,
            'date_of_birthday' => $request->date_of_birthday,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'country' => $request->country,
        ]);

        DB::table('users')->where('id' , session('userLogin')->id)->update([
            'name'=> $request->name,
            'email'=>$request->email,
    
        ]);
        $data =DB::table('doctor')->where('doctor_id' , $request->doctor_id)->first();
        $d =DB::table('users')->where('id' , session('userLogin')->id)->first();
        session([
            'doctor_login' => $data,
            'userLogin'=>$d,
        ]);
    

        return back()->with('Doctor_personal_info', 'Doctor Personal Information Has been Updated');

    }
    
    




    /******************************************** Doctor Patients List ***********************************************/

    public function showPatientList()
    {
        return view('doctor_pages.doctor_patientList');
    }


    //Show patient's list in doctor dashboard
    public function getPatientList(Request $request)
    {
        if ($request->ajax()) {
            $data = DB::table('patient')
                ->join('doctor-patient', 'patient.MRN', '=', 'doctor-patient.MRN')
                ->where([['doctor-patient.doctor_id', '=', session('doctorid')]])
                ->get();


            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $actionBtn = '<a  href="/medicalrecord_Doctor/' . $row->MRN . ' " class="delete btn btn-sm bg-red">Show Record</a>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }
    /******************************************** Zoom Meeting ***********************************************/
    public function zoomDoctor(){
        $patientdata =DB::table('patient')
        ->join('doctor-patient', 'patient.MRN', 'doctor-patient.MRN')
        ->where('doctor-patient.doctor_id' , session('doctorid'))
        ->get();
        
        return view('doctor_pages.zoomDoctor' , get_defined_vars());
    }


    /******************************************** Lock screen ***********************************************/

    public function lockscreensubmit(Request $request)
    {

        $request->validate([
            'password' => 'required',
        ]);

        $data = DB::table('doctor')->where('doctor_id', $request->doctor_id)->where('password', $request->password)->first();

        if ($data) {
            return redirect('DoctorProfile');
        } else
            return back()->with('invaild_password', 'Invaild Passowrd ');
    }
    public function RelativeRequestLab($id)
    {
        DB::delete('DELETE FROM notifications WHERE notification_id = ?', [$id]);

        return back()->with(['success' => ' Notification deleted successfully.'])->withInput();
    }

}