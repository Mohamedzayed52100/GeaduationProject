<?php

namespace App\Http\Controllers;

use App\Mail\RelativeApproval;
// charts library
use ArielMejiaDev\LarapexCharts\Facades\LarapexChart;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rule;

class RelativeSettingsController extends Controller
{
    public function ShowLabResult()
    {
        $relative_data = DB::table('relatives')
        ->select('*')
        ->where('relatives.relative_id', session('relative_id'))
        ->get();
        //Lab Results
        $Lab_result = DB::table('lab_appointment')
            ->join('patient', 'patient.MRN', '=', 'lab_appointment.MRN')
            ->join('lab_result', 'lab_result.appointment_id', '=', 'lab_appointment.appointment_id')
            ->join('disease_test', 'disease_test.test_id', '=', 'lab_result.test_id')
            ->join('patient_relatives', 'patient_relatives.MRN', '=', 'lab_appointment.MRN')
            ->select('*')
            ->where([
                ['lab_appointment.status' , '=' , 'done' ] , 
                ['patient_relatives.relative_id' , '=' , session('relative_id') ] , 
            ])
            ->orderBy('upload_date', 'DESC')
            ->paginate(10);

            $MRN_abnormalCase = DB::table('patient')
            ->join('patient_relatives', 'patient_relatives.MRN', '=', 'patient.MRN')
            ->join('patient-vital-sign', 'patient-vital-sign.MRN', '=', 'patient.MRN')
            ->join('sensordata', 'patient-vital-sign.MRN', 'sensordata.patient_id')
            ->select('patient.MRN')
            ->where('patient_relatives.relative_id', session('relative_id'))
            ->where(function ($q) {
                $q->where('sensordata.oxygen', '<', 95)
                    ->orWhere('sensordata.heart', '>', 100)
                    ->orWhere('sensordata.heart', '<', 60)
                    ->orWhere('patient-vital-sign.systolic', '>', 120)
                    ->orWhere('patient-vital-sign.diastolic', '>', 80);
            })
            ->where('sensordata.oxygen', '<>', -999)
            ->where('sensordata.heart', '<>', -999)
            ->whereDay('patient-vital-sign.recorded_at', '=', now()->day)
            ->get();

            $notification = DB::table('notifications')
            ->select('*')
            ->where('notifications.recipient_id', '=', session('relative_id'))
            ->orderByDesc('notifications.created_at')->get();

            return view('relative_pages.RelativeLabResult', compact('notification','Lab_result' , 'relative_data' , 'MRN_abnormalCase'));

    }
    public function ShowHomeRelative()
    {
        $relative_data = DB::table('relatives')
            ->select('*')
            ->where('relatives.relative_id', session('relative_id'))
            ->get();

        //get the MRN of current selected patient from the choose patient window
        $selected_patient = DB::table('relatives')
            ->select('relatives.selected_patient')
            ->where('relatives.relative_id', session('relative_id'))
            ->get();
        $selected_patient = json_decode(json_encode($selected_patient), true);

        $vitalSign_data_today = DB::table('patient-vital-sign')
        ->select('*')
        ->where('patient-vital-sign.MRN', $selected_patient)
        ->where('patient-vital-sign.created_at',  Carbon::now()->addMinutes(180)->format('y-m-d h'))
        ->get();

        $vitalSign_data_yesterday = DB::table('patient-vital-sign')
            ->select('*')
            ->where('patient-vital-sign.MRN', $selected_patient)
            ->where('patient-vital-sign.created_at', Carbon::yesterday()->addMinutes(180)->format('y-m-d h'))
            ->get();

        
        //charts data of high measurements
        //upload this library composer require arielmejiadev/larapex-charts
        $pressure = DB::table('patient-vital-sign')
            ->select('patient-vital-sign.systolic')
            ->where('patient-vital-sign.MRN', $selected_patient)
            ->where(function ($q) {
                $q->where('patient-vital-sign.systolic', '>', 120)
                    ->orWhere('patient-vital-sign.diastolic', '>', 80);
            })
            ->whereMonth('patient-vital-sign.recorded_at', '=', now()->subMonth()->month)
            ->count();

        $heart_rate = DB::table('patient-vital-sign')
            ->join('sensordata', 'patient-vital-sign.MRN', 'sensordata.patient_id')
            ->select('sensordata.heart')
            ->where('patient-vital-sign.MRN', $selected_patient)
            ->where('sensordata.heart', '>', 100)
            ->where('sensordata.heart', '<>', -999)
            ->whereMonth('patient-vital-sign.recorded_at', '=', now()->subMonth()->month)
            ->count();

        $heart_rate2 = DB::table('patient-vital-sign')
            ->join('sensordata', 'patient-vital-sign.MRN', 'sensordata.patient_id')
            ->select('sensordata.heart')
            ->where('patient-vital-sign.MRN', $selected_patient)
            ->where('sensordata.heart', '<', 60)
            ->where('sensordata.heart', '<>', -999)
            ->whereMonth('patient-vital-sign.recorded_at', '=', now()->subMonth()->month)
            ->count();

        $heart_rate = $heart_rate2 + $heart_rate;

        $oxygen_rate = DB::table('patient-vital-sign')
            ->join('sensordata', 'patient-vital-sign.MRN', 'sensordata.patient_id')
            ->select('sensordata.oxygen')
            ->where('patient-vital-sign.MRN', $selected_patient)
            ->where('sensordata.oxygen', '<', 95)
            ->where('sensordata.oxygen', '<>', -999)
            ->whereMonth('patient-vital-sign.recorded_at', '=', now()->subMonth()->month)
            ->count();

        $oxygen_rate2 = DB::table('patient-vital-sign')
            ->join('sensordata', 'patient-vital-sign.MRN', 'sensordata.patient_id')
            ->select('sensordata.oxygen')
            ->where('patient-vital-sign.MRN', $selected_patient)
            ->where('sensordata.oxygen', '>', 100)
            ->where('sensordata.oxygen', '<>', -999)
            ->whereMonth('patient-vital-sign.recorded_at', '=', now()->subMonth()->month)
            ->count();

        $oxygen_rate = $oxygen_rate2 + $oxygen_rate;
        //dd($oxygen_rate2);

        $pressurenow = DB::table('patient-vital-sign')
            ->select('patient-vital-sign.systolic')
            ->where('patient-vital-sign.MRN', $selected_patient)
            ->where(function ($q) {
                $q->where('patient-vital-sign.systolic', '>', 120)
                    ->orWhere('patient-vital-sign.diastolic', '>', 80);
            })
            ->whereMonth('patient-vital-sign.recorded_at', '=', now()->month)
            ->count();

        $heart_ratenow = DB::table('patient-vital-sign')
            ->join('sensordata', 'patient-vital-sign.MRN', 'sensordata.patient_id')
            ->select('sensordata.heart')
            ->where('patient-vital-sign.MRN', $selected_patient)
            ->whereMonth('patient-vital-sign.recorded_at', '=', now()->month)
            ->where('sensordata.heart', '>', 100)
            ->where('sensordata.heart', '<>', -999)
            ->count();

        $heart_ratenow2 = DB::table('patient-vital-sign')
            ->join('sensordata', 'patient-vital-sign.MRN', 'sensordata.patient_id')
            ->select('sensordata.heart')
            ->where('patient-vital-sign.MRN', $selected_patient)
            ->where('sensordata.heart', '<', 60)
            ->where('sensordata.heart', '<>', -999)
            ->whereMonth('patient-vital-sign.recorded_at', '=', now()->subMonth()->month)
            ->count();

        $heart_ratenow = $heart_ratenow2 + $heart_ratenow;
        //dd($heart_ratenow);

        $oxygen_ratenow = DB::table('patient-vital-sign')
            ->join('sensordata', 'patient-vital-sign.MRN', 'sensordata.patient_id')
            ->select('sensordata.oxygen')->where('patient-vital-sign.MRN', $selected_patient)
            ->whereMonth('patient-vital-sign.recorded_at', '=', now()->month)
            ->where('sensordata.oxygen', '<', 95)
            ->where('sensordata.oxygen', '<>', -999)
            ->count();

        $oxygen_ratenow2 = DB::table('patient-vital-sign')
            ->join('sensordata', 'patient-vital-sign.MRN', 'sensordata.patient_id')
            ->select('sensordata.oxygen')->where('patient-vital-sign.MRN', $selected_patient)
            ->where('sensordata.oxygen', '>', 100)
            ->where('sensordata.oxygen', '<>', -999)
            ->whereMonth('patient-vital-sign.recorded_at', '=', now()->subMonth()->month)
            ->count();

        $oxygen_ratenow = $oxygen_ratenow2 + $oxygen_ratenow;

        $linechart = LarapexChart::setType('line')
            ->setXAxis(['MonthAgo', 'currentMonth'])
            ->setDataset([
                ['data' => [$pressure, $pressurenow]],
                ['data' => [$heart_rate, $heart_ratenow]],
                ['data' => [$oxygen_rate, $oxygen_ratenow]],

            ])
            ->setGrid('#3F51B5', 0.001)
            ->setColors(['#23a3b9', '#70e1f5', '#10517c'])
            ->setMarkers(['#23a3b9', '#10517c'], 7, 10)
            ->setHeight(400)
            ->setWidth(600)
            ->setFontColor(0000)
            ->setToolbar(1, 0);

        $piechart = LarapexChart::setType('pie')
            ->setLabels(['Pressure', 'Heart_rate', 'Oxygen_rate'])
            ->setDataset([$pressure, $heart_rate, $oxygen_rate])
            ->setColors(['#23a3b9', '#70e1f5', '#10517c'])
            ->setHeight(400)
            ->setWidth(400)
            ->setFontColor(0000)
            ->setToolbar(1, 0);

        $barchart = LarapexChart::setType('bar')
            ->setLabels(['Pressure', 'Heart_rate', 'Oxygen_rate'])
            ->setDataset([
                ['data' => [$pressure, $heart_rate, $oxygen_rate]],
            ])
            ->setHeight(400)
            ->setWidth(500)
            ->setFontFamily(0)
            ->setColors(['#66b3ff'])
            ->setToolbar(1, 0);

        $MRN_abnormalCase = DB::table('patient')
            ->join('patient_relatives', 'patient_relatives.MRN', '=', 'patient.MRN')
            ->join('patient-vital-sign', 'patient-vital-sign.MRN', '=', 'patient.MRN')
            ->join('sensordata', 'patient-vital-sign.MRN', 'sensordata.patient_id')
            ->select('patient.MRN')
            ->where('patient_relatives.relative_id', session('relative_id'))
            ->where(function ($q) {
                $q->where('sensordata.oxygen', '<', 95)
                    ->orWhere('sensordata.heart', '>', 100)
                    ->orWhere('sensordata.heart', '<', 60)
                    ->orWhere('patient-vital-sign.systolic', '>', 120)
                    ->orWhere('patient-vital-sign.diastolic', '>', 80);
            })
            ->where('sensordata.oxygen', '<>', -999)
            ->where('sensordata.heart', '<>', -999)
            ->whereDay('patient-vital-sign.recorded_at', '=', now()->day)
            ->get();

        $Name_abnormalCase = DB::table('patient')
            ->select('patient.name')
            ->join('patient_relatives', 'patient_relatives.MRN', '=', 'patient.MRN')
            ->where('patient_relatives.relative_id', session('relative_id'))
            ->join('patient-vital-sign', 'patient.MRN', '=', 'patient-vital-sign.MRN')
            ->join('sensordata', 'patient-vital-sign.MRN', 'sensordata.patient_id')
            ->where(function ($q) {
                $q->where('sensordata.oxygen', '<', 95)
                    ->orWhere('sensordata.heart', '>', 100)
                    ->orWhere('sensordata.heart', '<', 60)
                    ->orWhere('patient-vital-sign.systolic', '>', 120)
                    ->orWhere('patient-vital-sign.diastolic', '>', 80);
            })
            ->where('sensordata.oxygen', '<>', -999)
            ->where('sensordata.heart', '<>', -999)
            ->whereDay('patient-vital-sign.recorded_at', '=', now()->day)
            ->get();

        //Notification call must be in another place while recording measures
        $data_emergency = [
            'MRN' => $MRN_abnormalCase,
            'name' => $Name_abnormalCase,
        ];
       
        $notification = DB::table('notifications')
            ->select('*')
            ->where('notifications.recipient_id', '=', session('relative_id'))
            ->orderByDesc('notifications.created_at')->get();


        return view('relative_pages.HomeRelative', compact('notification', 'MRN_abnormalCase', 'relative_data', 'vitalSign_data_today', 'vitalSign_data_yesterday', 'piechart', 'linechart', 'barchart'));
    }

    public function ShowRelativeSettings()
    {
        $relative_data = DB::table('relatives')
            ->select('*')
            ->where('relatives.relative_id', session('relative_id'))
            ->get();

        $relative_img = DB::table('relatives')
            ->select('relatives.relative_img')
            ->where('relatives.relative_id', session('relative_id'))
            ->get();

        $notification = DB::table('notifications')
            ->select('*')
            ->where('notifications.recipient_id', '=', session('relative_id'))
            ->orderByDesc('notifications.created_at')->get();

        $MRN_abnormalCase = DB::table('patient')
            ->join('patient_relatives', 'patient_relatives.MRN', '=', 'patient.MRN')
            ->join('patient-vital-sign', 'patient-vital-sign.MRN', '=', 'patient.MRN')
            ->join('sensordata', 'patient-vital-sign.MRN', 'sensordata.patient_id')
            ->select('patient.MRN')
            ->where('patient_relatives.relative_id', session('relative_id'))
            ->where(function ($q) {
                $q->where('sensordata.oxygen', '<', 95)
                    ->orWhere('sensordata.heart', '>', 100)
                    ->orWhere('sensordata.heart', '<', 60)
                    ->orWhere('patient-vital-sign.systolic', '>', 120)
                    ->orWhere('patient-vital-sign.diastolic', '>', 80);
            })
            ->where('sensordata.oxygen', '<>', -999)
            ->where('sensordata.heart', '<>', -999)
            ->whereDay('patient-vital-sign.recorded_at', '=', now()->day)
            ->get();


        return view('relative_pages.settingsRelative', compact('notification', 'MRN_abnormalCase', 'relative_data', 'relative_img'));
    }

    public function RelativeSettings(Request $request)
    {
        //Validation
        $request->validate([
            'username' => 'required|max:100',
            'phone' => 'required|regex:/(1)[0-9]{9}/|max:11',
            'image' => 'image|mimes:jpeg,png,jpg|max:3000',
            'city' => 'required|max:255',
            'country' => 'required|max:255'

        ]);

        ///Store Data In database
        $username = $request->username;
        $city = $request->city;
        $country = $request->country;
        $phone = $request->phone;
        if ($request->image) {
            $imageName = time() . '.' . request()->image->extension();
            request()->image->move(public_path('relative_image'), $imageName);
        }

        DB::table('relatives')
            ->where('relatives.relative_id', session('relative_id'))
            ->update(['relatives.name' => $username]);

        DB::table('relatives')
            ->where('relatives.relative_id', session('relative_id'))
            ->update(['relatives.phone' => $phone]);

        DB::table('relatives')
            ->where('relatives.relative_id', session('relative_id'))
            ->update(['relatives.city' => $city]);

        DB::table('relatives')
            ->where('relatives.relative_id', session('relative_id'))
            ->update(['relatives.country' => $country]);
        if ($request->image) {

            DB::table('relatives')
                ->where('relatives.relative_id', session('relative_id'))
                ->update(['relatives.relative_img' => $imageName]);
        }
        return back()->with(['success' => 'Your account was updated successfully.'])->withInput();
    }

    public function patient_profile_Relative()
    {
        //get the MRN of current selected patient from the choose patient window
        $selected_patient = DB::table('relatives')
            ->select('relatives.selected_patient')
            ->where('relatives.relative_id', session('relative_id'))
            ->get();
        $selected_patient = json_decode(json_encode($selected_patient), true);

        //get the all data of the selected patient by his name
        $patient_data = DB::table('patient')
            ->select('*')
            ->join('patient_relatives', 'patient_relatives.MRN', '=', 'patient.MRN')
            ->where('patient_relatives.relative_id', session('relative_id'))
            ->where('patient.MRN', $selected_patient)
            ->get();

        //get the diseases the selected patient
        $patient_disease = DB::table('disease')
            ->select('disease.disease_name')
            ->join('patient-disease', 'patient-disease.disease_id', '=', 'disease.disease_id')
            ->where('patient-disease.MRN', $selected_patient)
            ->get();

        $relative_data = DB::table('relatives')
            ->select('*')
            ->where('relatives.relative_id', session('relative_id'))
            ->get();

        $notification = DB::table('notifications')
            ->select('*')
            ->where('notifications.recipient_id', '=', session('relative_id'))
            ->orderByDesc('notifications.created_at')->get();

        $MRN_abnormalCase = DB::table('patient')
            ->join('patient_relatives', 'patient_relatives.MRN', '=', 'patient.MRN')
            ->join('patient-vital-sign', 'patient-vital-sign.MRN', '=', 'patient.MRN')
            ->join('sensordata', 'patient-vital-sign.MRN', 'sensordata.patient_id')
            ->select('patient.MRN')
            ->where('patient_relatives.relative_id', session('relative_id'))
            ->where(function ($q) {
                $q->where('sensordata.oxygen', '<', 95)
                    ->orWhere('sensordata.heart', '>', 100)
                    ->orWhere('sensordata.heart', '<', 60)
                    ->orWhere('patient-vital-sign.systolic', '>', 120)
                    ->orWhere('patient-vital-sign.diastolic', '>', 80);
            })
            ->where('sensordata.oxygen', '<>', -999)
            ->where('sensordata.heart', '<>', -999)
            ->whereDay('patient-vital-sign.recorded_at', '=', now()->day)
            ->get();

        return view('relative_pages.patient_profile_Relative', compact('notification', 'MRN_abnormalCase', 'patient_data', 'patient_disease', 'relative_data'));
    }
    public function Doctor_profile_Relative()
    {
        //get the MRN of current selected patient from the choose patient window
        $selected_patient = DB::table('relatives')
            ->select('relatives.selected_patient')
            ->where('relatives.relative_id', session('relative_id'))
            ->get();

        //Object of class stdClass could not be converted to string ده عشان بيجيلي ايرور ان 
        $selected_patient = json_decode(json_encode($selected_patient), true);
        //get the all data of the doctor that follow-up the selected patient by patient name
        $Doctor_data = DB::table('doctor')
            ->select('*')
            ->join('doctor-patient', 'doctor-patient.doctor_id', '=', 'doctor.doctor_id')
            ->where('doctor-patient.MRN', $selected_patient)
            ->orderBy('doctor-patient.created_at', 'DESC')->simplePaginate(1);

        $relative_data = DB::table('relatives')
            ->select('*')
            ->where('relatives.relative_id', session('relative_id'))
            ->get();

        $paginator = DB::table('doctor')
            ->select('*')
            ->join('doctor-patient', 'doctor-patient.doctor_id', '=', 'doctor.doctor_id')
            ->where('doctor-patient.MRN', $selected_patient)
            ->orderBy('doctor-patient.created_at', 'DESC')->simplePaginate(1);

        $notification = DB::table('notifications')
            ->select('*')
            ->where('notifications.recipient_id', '=', session('relative_id'))
            ->orderByDesc('notifications.created_at')->get();

        $MRN_abnormalCase = DB::table('patient')
            ->join('patient_relatives', 'patient_relatives.MRN', '=', 'patient.MRN')
            ->join('patient-vital-sign', 'patient-vital-sign.MRN', '=', 'patient.MRN')
            ->join('sensordata', 'patient-vital-sign.MRN', 'sensordata.patient_id')
            ->select('patient.MRN')
            ->where('patient_relatives.relative_id', session('relative_id'))
            ->where(function ($q) {
                $q->where('sensordata.oxygen', '<', 95)
                    ->orWhere('sensordata.heart', '>', 100)
                    ->orWhere('sensordata.heart', '<', 60)
                    ->orWhere('patient-vital-sign.systolic', '>', 120)
                    ->orWhere('patient-vital-sign.diastolic', '>', 80);
            })
            ->where('sensordata.oxygen', '<>', -999)
            ->where('sensordata.heart', '<>', -999)
            ->whereDay('patient-vital-sign.recorded_at', '=', now()->day)
            ->get();

        return view('relative_pages.Doctor_profile_Relative', compact('notification', 'MRN_abnormalCase', 'Doctor_data', 'relative_data', 'paginator'));
    }

    public function show_RelativeRequestLab()
    {
        //get the MRN of current selected patient from the choose patient window
        $selected_patient = DB::table('relatives')
            ->select('relatives.selected_patient')
            ->where('relatives.relative_id', session('relative_id'))
            ->get();

        //Object of class stdClass could not be converted to string ده عشان بيجيلي ايرور ان 
        $selected_patient = json_decode(json_encode($selected_patient), true);
        $selected_patient = DB::table('patient')
            ->select('name')
            ->join('patient_relatives', 'patient_relatives.MRN', '=', 'patient.MRN')
            ->where('patient_relatives.relative_id', session('relative_id'))
            ->where('patient.MRN', $selected_patient)
            ->get();


        $relative_data = DB::table('relatives')
            ->select('*')
            ->where('relatives.relative_id', session('relative_id'))
            ->get();

        $notification = DB::table('notifications')
            ->select('*')
            ->where('notifications.recipient_id', '=', session('relative_id'))
            ->orderByDesc('notifications.created_at')->get();

        $MRN_abnormalCase = DB::table('patient')
            ->join('patient_relatives', 'patient_relatives.MRN', '=', 'patient.MRN')
            ->join('patient-vital-sign', 'patient-vital-sign.MRN', '=', 'patient.MRN')
            ->join('sensordata', 'patient-vital-sign.MRN', 'sensordata.patient_id')
            ->select('patient.MRN')
            ->where('patient_relatives.relative_id', session('relative_id'))
            ->where(function ($q) {
                $q->where('sensordata.oxygen', '<', 95)
                    ->orWhere('sensordata.heart', '>', 100)
                    ->orWhere('sensordata.heart', '<', 60)
                    ->orWhere('patient-vital-sign.systolic', '>', 120)
                    ->orWhere('patient-vital-sign.diastolic', '>', 80);
            })
            ->where('sensordata.oxygen', '<>', -999)
            ->where('sensordata.heart', '<>', -999)
            ->whereDay('patient-vital-sign.recorded_at', '=', now()->day)
            ->get();

        return view('relative_pages.RelativeRequestLab', compact('notification', 'MRN_abnormalCase', 'selected_patient', 'relative_data'));
    }
    public function RelativeRequestLab($id)
    {
        DB::delete('DELETE FROM notifications WHERE notification_id = ?', [$id]);

        return back()->with(['success' => ' Notification deleted successfully.'])->withInput();
    }

    public function show_patient_list_Relative()
    {
        $patient_details = DB::table('patient')
            ->select('*')
            ->join('patient_relatives', 'patient_relatives.MRN', '=', 'patient.MRN')
            ->where('patient_relatives.relative_id', session('relative_id'))
            ->get();
        DB::table('patient_relatives')
            ->select('*')
            ->where('patient_relatives.relative_id', session('relative_id'))
            ->get();

        $patients = DB::table('patient_relatives')
            ->select('*')
            ->where('patient_relatives.relative_id', session('relative_id'))
            ->get();

        $relative_data = DB::table('relatives')
            ->select('*')
            ->where('relatives.relative_id', session('relative_id'))
            ->get();
        $notification = DB::table('notifications')
            ->select('*')
            ->where('notifications.recipient_id', '=', session('relative_id'))
            ->orderByDesc('notifications.created_at')->get();

        $MRN_abnormalCase = DB::table('patient')
            ->join('patient_relatives', 'patient_relatives.MRN', '=', 'patient.MRN')
            ->join('patient-vital-sign', 'patient-vital-sign.MRN', '=', 'patient.MRN')
            ->join('sensordata', 'patient-vital-sign.MRN', 'sensordata.patient_id')
            ->select('patient.MRN')
            ->where('patient_relatives.relative_id', session('relative_id'))
            ->where(function ($q) {
                $q->where('sensordata.oxygen', '<', 95)
                    ->orWhere('sensordata.heart', '>', 100)
                    ->orWhere('sensordata.heart', '<', 60)
                    ->orWhere('patient-vital-sign.systolic', '>', 120)
                    ->orWhere('patient-vital-sign.diastolic', '>', 80);
            })
            ->where('sensordata.oxygen', '<>', -999)
            ->where('sensordata.heart', '<>', -999)
            ->whereDay('patient-vital-sign.recorded_at', '=', now()->day)
            ->get();


        return view('relative_pages.show_patient_list_Relative', compact('notification', 'MRN_abnormalCase', 'patient_details', 'relative_data'));
    }
    public function patient_list_Relative($id)
    {
        DB::delete('DELETE FROM patient_relatives WHERE id = ?', [$id]);

        return back()->with(['success' => ' Patient deleted successfully.'])->withInput();
    }

    public function Show_Add_Patient_Relative()
    {
        // تظهر في كل البيدجز لانها في الناف بار relativeالجزء ده لازم احطه في كله عشان صورة ال  
        $relative_data = DB::table('relatives')
            ->select('*')
            ->where('relatives.relative_id', session('relative_id'))
            ->get();

        $notification = DB::table('notifications')
            ->select('*')
            ->where('notifications.recipient_id', '=', session('relative_id'))
            ->orderByDesc('notifications.created_at')->get();

        $MRN_abnormalCase = DB::table('patient')
            ->join('patient_relatives', 'patient_relatives.MRN', '=', 'patient.MRN')
            ->join('patient-vital-sign', 'patient-vital-sign.MRN', '=', 'patient.MRN')
            ->join('sensordata', 'patient-vital-sign.MRN', 'sensordata.patient_id')
            ->select('patient.MRN')
            ->where('patient_relatives.relative_id', session('relative_id'))
            ->where(function ($q) {
                $q->where('sensordata.oxygen', '<', 95)
                    ->orWhere('sensordata.heart', '>', 100)
                    ->orWhere('sensordata.heart', '<', 60)
                    ->orWhere('patient-vital-sign.systolic', '>', 120)
                    ->orWhere('patient-vital-sign.diastolic', '>', 80);
            })
            ->where('sensordata.oxygen', '<>', -999)
            ->where('sensordata.heart', '<>', -999)
            ->whereDay('patient-vital-sign.recorded_at', '=', now()->day)
            ->get();


        return view('relative_pages.add-patient-Relative', compact('notification', 'MRN_abnormalCase', 'relative_data'));
    }
    public function Add_Patient_Relative(Request $request)
    {

        //Validation
        $request->validate([
            'relativity_degree' => 'required',

            // THIS validation to prevent relative enter the same MRN more than once for the same relative in patient-relative table but he can enter a new one
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
            ->where('patient.MRN', [$MRN])
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

        // send email to the patiant
        Mail::to($patient_email)->send(new RelativeApproval($name, $relatively_degree));
        //  Recepient_MRN is column that store the MRN that relative sent mail to and it's updated after each email is sended
        DB::table('relatives')
            ->where('relatives.relative_id', session('relative_id'))
            ->update(['relatives.Recepient_MRN' => $MRN]);

        return back()->with(['success' => ' Your Request has been sent successfully!'])->withInput();
    }
}