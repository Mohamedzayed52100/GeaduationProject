<?php

namespace App\Http\Controllers;

use App\Events\NewNotification;
use App\Mail\RequestDiseaseMail;
use App\Models\Patient;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;


class PatientController extends Controller
{
    /************************************************** Patient Welcome Page **************************************************/
    public function welcome()
    {  
        return view('patient_pages.Patientwelcome');
    }



    /************************************************** Patient Advices View **************************************************/
    public function HomePatient()
    {
        return view('patient_pages.home_patient');
    }

    /************************************************** Patient Request Lab **************************************************/
    public function PatientRequestLab()
    {
        return view('patient_pages.patient_request');
    }



    /************************************************** Patient Relative List **************************************************/
    //Show relatives list
    public function relative_list_patient()
    {
        $patient_id = session('id');

        $data_of_relatives = DB::table('relatives')
            ->join('patient_relatives', 'relatives.relative_id', '=', 'patient_relatives.relative_id')
            ->where('patient_relatives.MRN', $patient_id)
            ->get([
                'relatives.name',
                'patient_relatives.MRN',
                'patient_relatives.relatively_degree',
                'relatives.email',
                'relatives.phone',
                'relatives.relative_id',
                'relatives.relative_img',
            ]);

        return view('patient_pages.relative_list_patient', get_defined_vars());
    }

    //Remove relative from patient's relative list
    public function removeRelative($id)
    {
        DB::table('patient_relatives')->where('relative_id', $id)->where('MRN', session('id'))->delete();
        return back();
    }



    /************************************************** Choose Disease **************************************************/

    public function choose_disease()
    {
        $disease_data = DB::table('disease')
            ->join('patient-disease', 'patient-disease.disease_id', 'disease.disease_id')
            ->join('patient', 'patient.MRN', 'patient-disease.MRN')
            ->select('disease_name')
            ->where('patient.MRN', session('id'))
            ->get();
        $data = json_decode(json_encode($disease_data), true);

        $sex = DB::table('patient')
        ->select('sex')
        ->where('patient.MRN', session('id'))
        ->get();
        $sexdata = json_decode(json_encode($sex), true);

        if($sexdata[0]['sex'] == "Male"){
            $arr= ["disease_name" => "Gestational Diabetes"];
            $NotRegisteredDiseases = DB::table('disease')
            ->select('disease_name')
            ->whereNotIn('disease_name', $data)
            ->whereNotIn('disease_name', $arr)
            ->get();
        }else{
            $NotRegisteredDiseases = DB::table('disease')
            ->select('disease_name')
            ->whereNotIn('disease_name', $data)
            ->get();
        }
        return view('patient_pages.choose_disease', compact('disease_data', 'NotRegisteredDiseases'));
    }

    public function PatientRequestDisease($disease)
    {

        if (session('disease') == $disease and session('MRN') == session('id')) {
            return back()->with('ErrorsendRequest', "You have already sent a request, wait for a reply.");
        }
        $result = "alaaibrahimmahfoz@gmail.com";
        $date = date('Y-m-d ');
        $MRN = session('id');

        $name = DB::table('patient')->select('name')->where('patient.MRN', session('id'))->get();
        $email = DB::table('patient')->select('email')->where('patient.MRN', session('id'))->get();

        $Namedata = json_decode(json_encode($name), true);
        $Emaildata = json_decode(json_encode($email), true);

        $Name = $Namedata[0]['name'];
        $Email = $Emaildata[0]['email'];



        Mail::to($result)->send(new RequestDiseaseMail($disease, $date, $MRN, $Name, $Email));
        session()->regenerate();
        session([
            'DiseaseRequest' => true,
            'MRN' => $MRN,
            'disease' => $disease
        ]);

        return back()->with('sendRequest', "Your request has been submitted successfully ");
    }

    //Accept Request
    public function DiseaseApproval()
    {
        //Get disease id from session
        $diseaseID = DB::table('disease')
            ->select('disease_id')
            ->where([
                ['disease_name', '=', session('disease')],
            ])->get();
        $IDdata = json_decode(json_encode($diseaseID), true);
        $ID = $IDdata[0]['disease_id'];

        //insert into patient-disease to register new disease to that patient after admin approval
        DB::table('patient-disease')->insert([
            'MRN' => session('id'),
            'disease_id' => $ID
        ]);

        //insure that process has been done successfully
        $result = DB::table('patient-disease')
            ->select('MRN')
            ->where([
                ['disease_id', '=', $ID],
            ])->get();
        if ($result) {
            Session::forget('DiseaseRequest');
            //send Notification
            return redirect('/RequestConfirmation');
        }

    }
    //Decline adding new disease request
    public function DiseaseDecline()
    {
        Session::forget('DiseaseRequest');
        //send Notification
        return redirect('/RequestConfirmation');
    }
    public function RequestConfirmation()
    {
        return view('patient_pages.DiseaseConfirmation');
    }


    /************************************************** Patient Charts **************************************************/
    //Show Patient Report
    public function patient_reports()
    {
         //Lab Results
         $Lab_result = DB::table('lab_appointment')
         ->join('patient', 'patient.MRN', '=', 'lab_appointment.MRN')
         ->join('lab_result', 'lab_result.appointment_id', '=', 'lab_appointment.appointment_id')
         ->join('disease_test', 'disease_test.test_id', '=', 'lab_result.test_id')
         ->select('*')
         ->where([
             ['lab_appointment.MRN' , '=' , session('id') ] , 
             ['lab_appointment.status' , '=' , 'done' ] , 
         ])
         ->orderBy('upload_date', 'DESC')
         ->paginate(5);


        //Get patient's total data from the moment he joins our system

        //for Pie --> count all cases
        $stable = DB::table('patient-vital-sign')->where([
            ['report', 'stable'],
            ['MRN', session('id')],
        ])->count();
        $unstable = DB::table('patient-vital-sign')->where([
            ['report', 'unstable'],
            ['MRN', session('id')],
        ])->count();
        $emergency = DB::table('patient-vital-sign')->where([
            ['report', 'emergency'],
            ['MRN', session('id')],
        ])->count();

        //For Sensor Data Chart
        $readings = DB::table('sensordata')
            ->where([
                ['heart', '<>', -999],
                ['oxygen', '<>', -999],
                ['patient_id', session('id')],
            ])
            ->orderBy('created_at', 'asc')
            ->get();

        // Format the data for a Google Chart
        $chartData = array();
        $chartData[] = array('Date', 'Heart', 'Oxygen');
        foreach ($readings as $reading) {
            $date = date('Y-m-d H:i:s', strtotime($reading->created_at));
            $heart = intval($reading->heart);
            $oxygen = intval($reading->oxygen);
            $chartData[] = array($date, $heart, $oxygen);
        }

        $chartDataJson = json_encode($chartData);


        //For pressure chart
        $readings2 = DB::table('patient-vital-sign')
            ->where([['MRN', '=', session('id')]])
            ->orderBy('recorded_at', 'asc')
            ->get();

        // Format the data for a Google Chart
        $chartData = array();
        $chartData[] = array('Date', 'Systolic', 'Diastolic');
        foreach ($readings2 as $reading) {
            $date = date('Y-m-d H:i:s', strtotime($reading->recorded_at));
            $systolic = intval($reading->systolic);
            $diastolic = intval($reading->diastolic);
            $chartData[] = array($date, $systolic, $diastolic);
        }

        $chartDataJson2 = json_encode($chartData);


        //For glucose chart
        $readings3 = DB::table('patient-vital-sign')
            ->where([['MRN', '=', session('id')]])
            ->orderBy('recorded_at', 'asc')
            ->get();

        // Format the data for a Google Chart
        $chartData = array();
        $chartData[] = array('Date', 'Glucose');
        foreach ($readings3 as $reading) {
            $date = date('Y-m-d H:i:s', strtotime($reading->recorded_at));
            $glucose = intval($reading->glucose);
            $chartData[] = array($date, $glucose);
        }
        $chartDataJson3 = json_encode($chartData);

        return view('patient_pages.patient_reports', get_defined_vars());
    }




    /************************************************** Patient Profile **************************************************/

    //show patient profile
    public function Patientprofile()
    {
        //Get all doctors who follow up this patient
        $data = DB::table('doctor')
            ->join('doctor-patient', 'doctor-patient.doctor_id', 'doctor.doctor_id')
            ->where('doctor-patient.MRN', session('id'))
            ->get();

        $patient_image = DB::table('patient')->where('MRN', session('id'))->pluck('patient_image')->first();

        return view('patient_pages.patient_profile', get_defined_vars());

    }


    //Update patient info 
    public function change_g_info(Request $request)
    {
        $id = session('id');
        $patient = Patient::where('MRN', $id)->first();

        $image = $request->file('file');
        if ($image) {
            $imageName = time() . '.' . $image->extension();
            $image->move(public_path('PatientImages'), $imageName);
            $patient->patient_image = $imageName;
        }
        $patient->phone = $request->phone;
        $patient->name = $request->name;
        $patient->email = $request->email;
        
        $patient->save();
   
        DB::table('users')->where('id' , session('userLogin')->id)->update([
            'name'=> $request->name,
            'email'=>$request->email,
        ]);

        $data = DB::table('patient')->where('MRN', $id)->first();
        $d =DB::table('users')->where('id' , session('userLogin')->id)->first();
        session([
            'userLogin'=>$d,
            'patient_login' => $data,
        ]);
  

        return back()->with('change_g_info', "Your info has been updated");
    }

    //Update Patient Password
    public function change_patient_password(Request $request)
    {
        $request->validate([
            'oldpassword' => 'required',
            'newpassword1' => 'required',
            'newpassword2' => 'required',

        ]);
        
        $data=DB::table('patient')->where('MRN', session('id'))->first();
        if ($request->oldpassword != $data->password) {
            return back()->with('wrong_password', 'Invalid Password');
        }

        if ($request->newpassword1 != $request->newpassword2) {
            return back()->with('not_match_password', 'New Password and Confirmed are not matched');
        }

        DB::table('patient')->where('MRN', session('id'))->update([
            'password' => $request->newpassword1,
        ]);
        
        DB::table('users')->where('id' , session('userLogin')->id)->update([
            'password'=>Hash::make($request->newpassword1),

        ]);

        $data =DB::table('patient')->where('MRN' , session('id'))->first();
        $d =DB::table('users')->where('id' , session('userLogin')->id)->first();

        session([  
            'id' => $data->MRN,
            'patient_login' => $data,
            'userLogin'=>$d, 
        ]);
        return back()->with('password_ok', 'Password has been updated successfully');     

    }

    /************************************************** Patient Measurements **************************************************/

    //Show vital signs form
   
    public function Sensormeasurement()
    {
        return view('patient_pages.PatientMeasureSensor');
    }
    public function Sensor()
    {
        $sensorData = DB::table('sensordata')
        ->where([
            ['patient_id', '=', null],
        ])
        ->select('*')
        ->get();
        $data = json_decode(json_encode($sensorData), true);
        if($data == null){
            return response()->json('No data is entered');
        }else{
            foreach($sensorData as $sensor){
                if($sensor->oxygen == -999 || $sensor->heart == -999){
                    DB::delete('delete from sensordata where id =?', [$sensor->id]);
                }else{
                    DB::update('update sensordata set patient_id = ? where id =?', [session('id'),$sensor->id]);
                }
            }
            return response()->json('Data is Updated');
        }
    }
    public function measurement()
    {
        return view('patient_pages.vital_signs');
    }
    //Get pulse result
    public function heart_Rate_Condition($sensor_data)
    {
        $counter = 0;
        $heart_Result = "stable";

        foreach ($sensor_data as $key => $value) {
            if ($value->heart >= 60 and $value->heart <= 100) { //[60-100]
                $counter = 0;
            } else { //<60 or >100
                $counter++;
                if ($counter == 5) {
                    $heart_Result = "emergency";
                    break;
                }
            }
        }
        return $heart_Result;
    }

    //Get Oxygen result
    public function oxygen_Condition($sensor_data)
    {
        $counter = 0;
        $oxygen_Result = "stable";

        foreach ($sensor_data as $key => $value) {
            if ($value->oxygen >= 95 and $value->oxygen <= 100) { // 95% to 100% or >80mmHg
                $counter = 0;
            } else { //<95% or < 80mmHg
                $counter++;
                if ($counter == 5) {
                    $oxygen_Result = "emergency";
                    break;
                }
            }
        }
        return $oxygen_Result;
    }


    public function measurementResult(Request $request)
    {
        $request->validate([
            'systolic' => ['required', 'min:2', 'numeric'],
            'diastolic' => ['required', 'min:2', 'numeric'],
            'glucose' => ['required', 'min:2', 'numeric'],
            'latiude' => ['required'],
            'longitude' => ['required']
        ]);

        //Read input data
        $systolic = $request->systolic;
        $diastolic = $request->diastolic;
        $glucose = $request->glucose;
        $latiude = $request->latiude;
        $longitude = $request->longitude;



        //Condition of date == today
        $sensor_data = DB::table('sensordata')
            ->select('oxygen', 'heart', 'patient_id', 'id')
            ->where([
                ['patient_id', '=', session('id')],
            ])
            ->get();

        $doctor_id = DB::table('doctor-patient')->where('MRN', session('id'))->first();
        $patient_data = DB::table('patient')->where('MRN', session('id'))->first();



        //Get Pulse Result
        $heart_Result = $this->heart_Rate_Condition($sensor_data);

        //Get Oxygen Result
        $oxygen_Result = $this->oxygen_Condition($sensor_data);

        //Get Pressure Result
        if (($systolic <= 120) and ($diastolic <= 80)) { // stable <=120 and <=80
            $pressure_Result = "stable";
        } else { // >120 and >80
            $pressure_Result = "emergency";
        }

        //Get Glucose Result
        if ($glucose >= 70 and $glucose <= 200) { //[70-200]
            $glucose_Result = "stable";
        } else { //<70 or >200
            $glucose_Result = "emergency";
        }


        if ($glucose_Result == 'emergency' or $pressure_Result == 'emergency' or $heart_Result == 'emergency' or $oxygen_Result == 'emergency') {
            $report_Result = 'emergency';
            //Send Notification
            if (session('relative_id')) {
                $patient_MRN = DB::table('patient')
                    ->join('patient_relatives', 'patient_relatives.MRN', '=', 'patient.MRN')
                    ->where('patient_relatives.relative_id', session('relative_id'))
                    ->where('patient_relatives.MRN', session('id'))
                    ->select('patient.MRN')
                    ->get();
                $patient_name = DB::table('patient')
                    ->join('patient_relatives', 'patient_relatives.MRN', '=', 'patient.MRN')
                    ->where('patient_relatives.relative_id', session('relative_id'))
                    ->where('patient_relatives.MRN', session('id'))
                    ->select('patient.name')
                    ->get();
            } else {
                $patient_MRN = DB::table('patient')
                    ->join('doctor-patient', 'doctor-patient.MRN', '=', 'patient.MRN')
                    ->where('doctor-patient.doctor_id', session('doctorid'))
                    ->where('doctor-patient.MRN', session('id'))
                    ->select('patient.MRN', 'patient.name')
                    ->get();
                $patient_name = DB::table('patient')
                    ->join('doctor-patient', 'doctor-patient.MRN', '=', 'patient.MRN')
                    ->where('doctor-patient.doctor_id', session('doctorid'))
                    ->where('doctor-patient.MRN', session('id'))
                    ->select('patient.name')
                    ->get();
            }
            $data_emergency = [
                'MRN' => $patient_MRN,
                'name' => $patient_name,
            ];
            if (count($data_emergency['MRN']) > 0) {

                event(new NewNotification($data_emergency , $latiude ,$longitude));
            }

        } else {
            $report_Result = 'stable';
        }


        session([
            'systolic' => $systolic,
            'diastolic' => $diastolic,
            'glucose' => $glucose,
            'report_Result' => $report_Result,
            'glucose_Result' => $glucose_Result,
            'pressure_Result' => $pressure_Result,
            'oxygen_Result' => $oxygen_Result,
            'heart_Result' => $heart_Result,
            'sensor_data' => $sensor_data,
            'patient_data' => $patient_data,
        ]);

        $checkboxValuesString = null;
        $effects = null;
        if ($request->has('symptoms')) {
            $checkboxValues = $request->input('symptoms');
            $checkboxValuesString = implode(',', $checkboxValues);
        }
        if ($request->has('effects')) {
            $effectsval = $request->input('effects');
            $effects = implode(',', $effectsval);
        }

        DB::table('patient-vital-sign')->insert([
            'MRN' => session('id'),
            'systolic' => $request->systolic,
            'diastolic' => $request->diastolic,
            'measureTextArea' => $request->measureTextArea,
            'symptoms' => $checkboxValuesString,
            'effects' => $effects,
            'glucose' => $request->glucose,
            'report' => $report_Result,
            'glucose_result' => $glucose_Result,
            'pressure_result' => $pressure_Result,
            'heart_result' => $heart_Result,
            'oxygen_Result' => $oxygen_Result,
            'created_at'=>Carbon::now()->addMinutes(180)->format('y-m-d h'),
        ]);

        return redirect('/PatientResult');
    }

    //Show Measurement Result
    public function PatientResult()
    {
        return view('patient_pages.resultmeasurements');
    }
    public function RelativeRequestLab($id)
    {
        DB::delete('DELETE FROM notifications WHERE notification_id = ?', [$id]);

        return back()->with(['success' => ' Notification deleted successfully.'])->withInput();
    }


    /************************************************** Zoom Meetings **************************************************/

    public function zoomMeetingpatient(){
        $zoomdata=   DB::table('zoom')
       ->join('zoompatient' , 'zoompatient.zoom_id' , 'zoom.primary_id' )
       ->where([
            ['start_at' , '>=' , now()->subMinutes(60)], 
            ['zoompatient.patient_id' , session('id')],
        ])->get();
        return view('patient_pages.zoommeeting' , get_defined_vars());
    }





    /************************************************** Additional Function **************************************************/

    public function maps($latiude, $longitude)
    {
        return view('lab_pages.LabMapView', compact('latiude', 'longitude'));
    }
    public function autocomplete(Request $request)
    {
        $result = DB::table('disease_test')->select('test_name')
            ->where('test_name', 'LIKE', "%{$request->input('query')}%")
            ->get();
        $dataModified = array();
        foreach ($result as $data) {
            $dataModified[] = $data->test_name;
        }

        return response()->json($dataModified);
    }
    public function SendRequestLab(Request $request)
    {
        if (session('PatientSendRequest')) {
            return back()->with(['failRequest' => 'You can not send another request until the previous one is answered']);
        }
        //validation
        $request->validate([
            'adr' => 'required',
            'paymentWay' => 'required',
            'date' => 'required|after_or_equal:today',
            'lab' => 'required',
            'latiude' => 'required',
            'longitude' => 'required'
        ]);
        $tests = $request->input('tests');
        $testName = $request->input('test');
        $address = $request->input('adr');
        $paymentWay = $request->get('paymentWay');
        $labName = $request->get('lab');
        $appointment_date = $request->input('date');
        $medication = $request->get('medication');
        $latiude = $request->input('latiude');
        $longitude = $request->input('longitude');

        if (!$tests && !$testName) {
            return back()->with(['failRequest' => 'You must choose the test first.']);
        }

        if (!$medication) {
            $medication = '----';
        }



        //Store patient name then get his MRN
        $patientName = $request->input('fname');
        $UserId = DB::select('select MRN from patient where name = ?', [$patientName]);
        $object_encoded = json_encode($UserId);
        $object_decoded = json_decode($object_encoded, true);

        //Get lab ID
        $LabId = DB::select('select lab_id from labunit where lab_name = ?', [$labName]);
        $lab_encoded = json_encode($LabId);
        $lab_decoded = json_decode($lab_encoded, true);

        
        $checkAppointment = DB::table('lab_appointment')
        ->where([
            ['lab_appointment.MRN','=',$object_decoded[0]['MRN']],
            ['appointment_date','=', $appointment_date],
            ['lab_id', '=' ,$lab_decoded[0]['lab_id']],
            ['status', '=' ,'booked'],
        ])
        ->select('*')->get();
        $checkAppointment_decoded = json_decode(json_encode($checkAppointment), true);

        if($checkAppointment_decoded != null){
            return back()->with(['failRequest' => 'You have already booked appointment in this date']);
        }
        
        
        //Get last appointment id
        $appointment = DB::table('lab_appointment')->latest('appointment_id')->first();
        $appointment_id = $appointment->appointment_id + 1;

        DB::insert('insert into lab_appointment (appointment_id, MRN, appointment_date , status , payment_way , medicine ,live_location , lab_id , latiude , longitude ) values(?,?,?,?,?,?,?,?,?,?)', [$appointment_id, $object_decoded[0]['MRN'], $appointment_date, 'request', $paymentWay, $medication, $address, $lab_decoded[0]['lab_id'], $latiude, $longitude]);

        //Check that appointment has been successfully added in DB
        $result = DB::table('lab_appointment')
            ->join('patient', 'patient.MRN', '=', 'lab_appointment.MRN')
            ->where('lab_appointment.appointment_id', '=', $appointment_id)
            ->select('*')->get();

        if (!$result) {
            return back()->with(['failRequest' => 'Unexpected error happened during registration']);
        }

        //if user choose test name from check box
        if ($tests) {
            //Store New Tests in DB in lab_result table
            foreach ($tests as $test) {
                $TestId = DB::select('select test_id from disease_test where test_name = ?', [$test]);
                $objectEncoded = json_encode($TestId);
                $objectDecoded = json_decode($objectEncoded, true);
                DB::insert('insert into lab_result(appointment_id , test_id ) values(?, ?)', [$appointment_id, $objectDecoded[0]['test_id']]);
            }
        }

        //if user write a test name in search box
        if ($testName) {
            $TestId = DB::select('select test_id from disease_test where test_name = ?', [$testName]);
            $objectEncoded = json_encode($TestId);
            $objectDecoded = json_decode($objectEncoded, true);
            DB::insert('insert into lab_result(appointment_id , test_id ) values(?, ?)', [$appointment_id, $objectDecoded[0]['test_id']]);
        }

        //Calculate new total cost
        $testCosts = DB::table('lab_result')
            ->join('disease_test', 'disease_test.test_id', '=', 'lab_result.test_id')
            ->where('lab_result.appointment_id', '=', $appointment_id)
            ->select('cost')->get();
        $totalCost = 0;
        foreach ($testCosts as $testCost) {
            $totalCost += $testCost->cost;
        }
        DB::update('update lab_appointment set payment = ? where appointment_id = ?', [$totalCost, $appointment_id]);


        // Mark patient as has request
        session()->regenerate();
        session([
            'PatientSendRequest' => true,
            'MRN' => $object_decoded[0]['MRN']
        ]);
        return back()->with(['successRequest' => 'Your appointment request has been successfully sent']);
    }

}