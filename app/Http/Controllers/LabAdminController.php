<?php

namespace App\Http\Controllers;


use Carbon\Carbon;
use \Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use \Illuminate\Support\Facades\Cookie;
use RealRashid\SweetAlert\Facades\Alert;

class LabAdminController extends Controller
{

/**********************************                 Survey                 **********************************/
    public function ShowSurvey()
    {
        return view('lab_pages.MachineSurvey');
    }

    public function Survey(Request $request){

        // Store data entered by user
        $name = $request->name;
        $race = $request->race; 
        $age = $request->age;
        $BMI = $request->BMI;
        $physical =0;
        $mental = 0;   
        $smoke = $request->smoke;
        $sex = $request->sex;    
        $cancer = $request->cancer;
        $walk = $request->walk;
        $stroke = $request->stroke;
        $diabetic = $request->diabetic;
        $kideny = $request->kidney;    
        $asthma = $request->asthma;
   
        $url = 'http://127.0.0.1:7000/predict';
        $data =["BMI" => $BMI, "smoke"=> $smoke, "stroke"=> $stroke ,"physical"=>$physical, "mental"=>$mental,"walk"=>$walk, "sex"=>$sex, "age"=>$age,"race"=>$race ,"diabetic"=>$diabetic, "asthma"=>$asthma,"kidney"=>$kideny,"cancer"=>$cancer];
        $options = ['http'=> ['header' => "Content-type: application/x-www-form-urlencoded\r\n",
                'method' => 'POST','content' => http_build_query($data)]
         ] ;
        $context = stream_context_create($options);
        $result = file_get_contents($url,false,$context);
        $result = json_decode($result , true);
        session()->regenerate();
        session([
            'SurveyResult' => true,
            'result' => $result['pred_result']
                
         ]);
        return redirect('/SurveyResult');
        
    }

    public function ShowSurveyResult(){
        return view('lab_pages.MachineSurveyResult');
    }


    
    /**********************************                 Login                 **********************************/

    public function ShowLogin()
    {
        return view('lab_pages.LabLogin');
    }

    public function Login(Request $request)
    {


        // validation
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // Store data entered by user
        $email = $request->email;
        $password = $request->password;

        // Check Email && Password
        $result = DB::select('select * from labunit where email = ?', [$email]);
        if (!$result) {
            return back()->with(['error' => 'This email is not found'])->withInput();
        }
        $lab = $result[0];


        if (!Hash::check($password, $lab->password)) {
            return back()->with(['error' => 'Incorrect password'])->withInput();
        }

        // Mark lab admin as logged in
        session()->regenerate();
        session([
            'LabAdminloggedIn' => true,
            'labId' => $lab->lab_id,
            'labName' => $lab->lab_name
        ]);

        //Remember user's email & password if he loged out (just for 1440 min == 24 hours)
        if ($request->has('remember-me')) {
            Cookie::queue('LabAdminEmail', $email, 1440);
            Cookie::queue('LabAdminPassword', $password, 1440);
        }
        //if checkbox isn't checked so we delete the cookie data
        else {
            Cookie::queue('LabAdminEmail', $email, -1440);
            Cookie::queue('LabAdminPassword', $password, -1440);
        }
        // Go to Dash
        return redirect('/LabDash')->with(['success_message' => 'Welcome Back Admin!']);
    }






    /**********************************                 Logout                 **********************************/

    public function LabLogout()
    {
        session()->invalidate();
        return redirect('/LabLogin');
    }









    /**********************************                Dashboard --> Search                 **********************************/

    public function ShowSearch()
    {
        //Get data from DB tables
        $Lab_user = DB::table('lab_appointment')
            ->join('patient', 'patient.MRN', '=', 'lab_appointment.MRN')
            ->join('lab_result', 'lab_result.appointment_id', '=', 'lab_appointment.appointment_id')
            ->join('disease_test', 'disease_test.test_id', '=', 'lab_result.test_id')
            ->select('*')
            ->where('lab_appointment.lab_id', '=', session('labId'))
            ->orderBy('upload_date', 'DESC')
            ->paginate(10);
       
        return view('lab_pages.LabSearch', compact('Lab_user'));
    }

    public function Search(Request $request)
    {
        //Validation
        $request->validate([
            'search' => 'required'
        ]);
        $query = $request->search;
        //search by using name in DB and return user data
        $Lab_user = DB::table('lab_appointment')
            ->join('patient', 'patient.MRN', '=', 'lab_appointment.MRN')
            ->join('lab_result', 'lab_result.appointment_id', '=', 'lab_appointment.appointment_id')
            ->join('disease_test', 'disease_test.test_id', '=', 'lab_result.test_id')
            ->select('*')
            ->where('lab_appointment.lab_id', '=', session('labId'))
            //condition patients name or MRN = query name or ID
            ->where('patient.name', 'LIKE', '%' . $query . '%')
            ->orwhere('patient.MRN', '=', $query)
            ->orderBy('due_date', 'DESC')
            ->paginate(10);
        if (count($Lab_user) == 0) {
            return redirect('/LabSearch')->with(['error_alert' => 'No Data Found with this search query! Please be sure that you follow the instructions'])->withInput();
        }
    
        return view('lab_pages.LabSearch', compact('Lab_user'));
    }

    public function SearchAutoComplete(Request $request)
    {
        $result =  DB::table('patient')
            ->select('name')
            ->where('name', 'LIKE', "%{$request->input('query')}%")
            ->orwhere('MRN', '=', $request->input('query'))
            ->get();

        $dataModified = array();
        foreach ($result as $data) {
            $dataModified[] = $data->name;
        }

        return response()->json($dataModified);
    }

    public function updateSearch(Request $request)
    {
        //Validation
        $request->validate([
            'uploadfile' => 'required',
            'id' => 'required',
            'test_name' => 'required',
            'appointment_id' => 'required'
        ]);
        //Get uploaded file
        if (!$request->hasFile('uploadfile')) {
            return response()->json(['message' => 'Missing file'], 422);
        }
        $image = $request->file('uploadfile');
        $imageName = time() . '.' . $image->extension();
        $image->move(public_path('Lab_images/Uploads'), $imageName);
        $newimgName = "E:/TeleMed/TeleMedProject/public/Lab_images/Uploads/{$imageName}";

        //Get Laboratory Physician ID and test name
        $labId = $request->input('id');
        $TestName = $request->input('test_name');
        $testId = DB::select('select test_id from disease_test where test_name = ?', [$TestName]);
        $object_encoded = json_encode($testId);
        $object_decoded = json_decode($object_encoded, true);

        $appointment_id = $request->input('appointment_id');

        //Store lab result 'uploaded file' in db
        DB::update('update lab_result set image_name=? , result_file =? , physician_id=? , upload_date=? where appointment_id = ? and test_id = ?', [$imageName, $newimgName, $labId, Carbon::now()->addMinutes(180), $appointment_id, $object_decoded[0]['test_id']]);

        $result = DB::select('select * from lab_result where result_file = ?', [$newimgName]);
        if (!$result) {
            File::delete(public_path('/Lab_images/Uploads/' . $imageName));
            Alert::error('Error!', 'Unexpected error happened during uploading this file , Please try again');
            return back();
        }

        Alert::success('Success', 'This file has been successfully uploaded!');
        return redirect('/LabSearch');
    }

    public function ViewImage($file)
    {

        $result = DB::select('select * from lab_result where image_name = ? ', [$file]);
        if (!$result) {
            Alert::error('Error!', 'Unexpected error happened during viewing this file , Please try again');
            return back();
        }
        return view('lab_pages.LabImageView', compact('result'));
    }
}
