<?php

namespace App\Http\Controllers;

use App\Mail\RelativeApproval;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rule;
use RealRashid\SweetAlert\Facades\Alert;

class RelativeController extends Controller
{

    public function ViewImages($file)
    {
        $result = DB::select('select * from lab_result where image_name = ? ', [$file]);
        if (!$result) {
            Alert::error('Error!', 'Unexpected error happened during viewing this file , Please try again');
            return back();
        }
        return view('lab_pages.LabImageView', compact('result'));
    }

    
    public function index()
    {
        $Doctor_data = DB::table('doctor')->select('*')->skip(0)->take(3)->get();;
        return view('index', compact('Doctor_data'));
    }
    public function ShowPatientOrRelative()
    {
        return view('relative_pages.PatientOrRelative');
    }
    public function PatientOrRelative(Request $request)
    {
         //Validation
         $request->validate([
            'option' => 'required',
        ]);

        //Store Data In database
        $option_selected = $request->option;
        if (strpos($option_selected, 'Relative') !== false) {
            return redirect('/loginRelative');
        }else{
            return redirect('/login');

        }

    }

    public function showRegister()
    {
        return view('relative_pages.RegisterRelative');
    }

    public function Register(Request $request)
    {
        //Validation
        $request->validate([
            'username' => 'required|max:100',
            'email' => 'required|email|unique:relatives',
            'password' => 'required|confirmed|min:6',
            'city' => 'required|max:255',
            'country' => 'required|max:255',
            'phone' => 'required|regex:/(01)[0-9]{9}/|max:11'

        ]);

        //Store Data In database
        $username = $request->username;
        $city = $request->city;
        $country = $request->country;
        $email = $request->email;
        $password = $request->password;
        $passwordEnc = Hash::make($password);
        $phone = $request->phone;


        DB::insert('insert into relatives(name,city,country,email,password,phone) values(?,?,?,?,?,?)', [$username, $city, $country, $email, $passwordEnc, $phone]);

        //Mark User As Registered in IF info is valid
        $relativeID = DB::getPdo()->lastInsertId();
        $result = DB::select('select relative_id,name,email,city,country,phone from relatives where relative_id= ?', [$relativeID]);
        $relative = null;
        if ($result) {
            $relative = $result[0];
        }
        if ($relative == null) {
            return back()->with(['error' => 'unexpected error happened during registration'])->withInput();
        }
        session()->regenerate();
        session([
            'Registered' => true,
            'relative_id' => $relativeID,
            'relative' => $relative

        ]);

        return redirect('/patient_Approval')->with(['success' => ' Your Account created successfully!'])->withInput();
    }

    public function ShowPatientApproval()
    {
        return view('relative_pages.patient_Approval');
    }
    public function PatientApproval(Request $request)
    {
        //Validation
        $request->validate([
            'relativity_degree' => 'required',

            // THIS validation to prevent relative enter the same MRN more than once but he can enter a new one
            'MRN' => [
                'required',
                Rule::unique('patient_relatives')->where(function ($query) {
                    return $query->where('relative_id', session('relative_id'));
                })
            ]

        ]);

        //Store Data In database
        $MRN = $request->MRN;
        $relativity_degree = $request->relativity_degree;

        //check if the entered MRN exist or not in database
        $status = DB::table('patient')
            ->where('MRN', $request->MRN)
            ->first();


        if (isset($status->MRN)) {

            DB::insert('insert into patient_relatives(MRN,relatively_degree,relative_id) values(?,?,?)', [$MRN, $relativity_degree, session('relative_id')]);
        } else {
            return back()->with(['error' => 'MRN Not found please type a valid MRN'])->withInput();
        }

        // Get the email,name of the requested patient
        $relativeID = session('relative_id');
        $result = DB::select('select * from  relatives where relative_id= ?', [$relativeID]);

        $degree = DB::table('relatives')
            ->select('*')
            ->join('patient_relatives', 'patient_relatives.relative_id', '=', 'relatives.relative_id')
            ->select('patient_relatives.relatively_degree')
            ->where('relatives.relative_id', '=', [$relativeID])
            ->get();

        $patient_email = DB::table('patient')
            ->select('patient.email')
            ->where('patient.MRN',  [$MRN])
            ->get();

        $relative = null;
        $relative_degree = null;

        if ($result) {
            $relative = $result[0];
            $relative_degree = $degree[0];
        }
        if ($relative == null) {
            return back()->with(['error' => 'unexpected error happened during Approval proceeding'])->withInput();
        }

        $name = $relative->name;
        $relatively_degree = $relative_degree->relatively_degree;
        Mail::to($patient_email)->send(new RelativeApproval($name, $relatively_degree));

        //  Recepient_MRN is column that store the MRN that relative sent mail to and it's updated after each email is sended
        DB::table('relatives')
            ->where('relative_id', session('relative_id'))
            ->update(['Recepient_MRN' => $MRN]);

        return redirect('/loginRelative')->with(['success' => ' Your Request has been sent successfully!'])->withInput();
    }


    public function show_approval_form_after_mail()
    {
        return view('relative_pages.approval_form_after_mail');
    }
    public function approval_form_after_mail(Request $request)
    {
        //Validation
        $request->validate([
            'MRN' => 'required'
        ]);
        //request MRN from patient
        $patient_MRN = $request->MRN;
        $result = DB::table('relatives')
            ->select('relatives.Recepient_MRN')
            ->where('relatives.relative_id', session('relative_id'))
            ->get();
        //dd($result);
        if (!$result) {
            return back()->with(['error' => 'This MRN is not found'])->withInput();
        }

        if (strpos($result, $patient_MRN) == false) {
            return back()->with(['error' => 'Incorrect MRN or the email of the request is outdated wait until the relative send new email'])->withInput();
        }

        // change the state of the relative request to Approved after patient click approve
        DB::table('patient_relatives')
            ->where('relative_id', session('relative_id'))
            ->where('MRN', $patient_MRN)
            ->update(['Approved' => 'Yes']);


        return back()->with(['success' => 'The relative can now follow-up your case successfully.'])->withInput();
    }
    public function showLogin()
    {
        return view('relative_pages.loginRelative');
    }

    public function Login(Request $request)
    {
        //Validation
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'

        ]);
        //Store Data In database
        $email = $request->email;
        $password = $request->password;

        //Mark User As logged in IF info is valid
        $result = DB::select('select * from relatives where email= ?', [$email]);
        if (!$result) {
            return back()->with(['error' => 'This email is not found'])->withInput();
        }
        $relative = $result[0];

        // check password
        if (!Hash::check($password, $relative->password)) {
            return back()->with(['error' => 'Incorrect password'])->withInput();
        }

        session()->regenerate();
        session([
            'loggedIn' => true,
            'relative_id' => $relative->relative_id,
            'username' => $relative->name,
            'email' => $relative->email,
            'relative' => $relative

        ]);


        return redirect('/Choose-Patient-Relative');
    }


    public function ShowChoosePatient()
    {
        // get the list of the relative added or requested patients
        $patient_data = DB::table('patient')
            ->select('*');
        $patients = DB::table('patient')
            ->select('*')
            ->join('patient_relatives', 'patient_relatives.MRN', '=', 'patient.MRN')
            ->where('patient_relatives.relative_id', session('relative_id'))
            ->get();

        $relatives = DB::table('patient_relatives')
            ->select('patient_relatives.Approved')
            ->join('relatives', 'patient_relatives.relative_id', '=', 'relatives.relative_id')
            ->where('patient_relatives.relative_id', session('relative_id'))
            ->get();

        return view('relative_pages.Choose-Patient-Relative', compact('patients', 'patient_data', 'relatives'));
    }

    public function ChoosePatient(Request $request)
    {
        $selected_MRN = $request->patient_MRN;

        DB::update('update relatives set selected_patient=? where relative_id=?', [$selected_MRN, session('relative_id')]);
        //Check if the choosed user gived the relative Approval to follow him
        $Approval = DB::table('patient_relatives')
            ->select('patient_relatives.Approved')
            ->join('relatives', 'patient_relatives.relative_id', '=', 'relatives.relative_id')
            ->where('relatives.selected_patient', $selected_MRN)
            ->where('patient_relatives.MRN', $selected_MRN)
            ->where('patient_relatives.relative_id', session('relative_id'))
            ->get();
        //dd($Approval);
        // this is a condition to check if the selected patient has already approve relative or not 
        if (strpos($Approval, 'No') !== false) {
            return back()->with(['error' => 'Your request to follow this patient is not approved yet! please wait until patient approve it']);
        } else {
            session()->regenerate();
            session([
                'loggedIn' => true,
            ]);
        }
        $result = DB::select('select * from relatives where relative_id= ?', [session('relative_id')]);
        if (!$result) {
            return back()->with(['error' => 'This email is not found'])->withInput();
        }
        $relative = $result[0];

        session()->regenerate();
        session([
            'PatientSelected' => true,
            'relative_id' => $relative->relative_id,
            'username' => $relative->name,
            'email' => $relative->email,
            'relative' => $relative

        ]);
        return redirect('/HomeRelative');
    }

    public function logoutRelative()
    {
        session()->invalidate();
        return redirect('/loginRelative');
    }
}
return redirect('/HomeRelative');
