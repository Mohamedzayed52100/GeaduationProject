<?php

namespace App\Http\Controllers;

use App\Events\LabNotification;
use App\Events\LabNotification_onlinePay;
use App\Http\Services\FatoorahServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use RealRashid\SweetAlert\Facades\Alert;

class PaymentController extends Controller
{
    private $fatoorahServices;
    //construct -> used for "class injection" which means call a class in laravel inside other class
    public function __construct(FatoorahServices $fatoorahServices)
    {

        $this->fatoorahServices = $fatoorahServices;
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

        //Get last appointment id
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
            return back()->with(['failRequest' => 'Your patient "'.$patientName.'" has already booked appointment in this date']);
        }
        
        

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

    public function maps($latiude, $longitude)
    {
        return view('lab_pages.LabMapView', compact('latiude', 'longitude'));
    }


    /* Accept Request function -> when click on accept icon*/
    public function DashAccept($id)
    {
        //Calculate end date
        $end_date = DB::select('select DATE_ADD(appointment_date, INTERVAL 1 DAY) as DATE from lab_appointment where appointment_id = ?', [$id]);
        $object_encoded = json_encode($end_date);
        $object_decoded = json_decode($object_encoded, true);
        DB::update('update lab_appointment set status = ? , end_date =? where appointment_id = ?', ['booked', $object_decoded[0]['DATE'], $id]);

        $result =  DB::table('lab_appointment')
            ->join('patient', 'patient.MRN', '=', 'lab_appointment.MRN')
            ->where('lab_appointment.status', '=', 'booked')
            ->where('lab_appointment.appointment_id', '=', $id)
            ->select('*')
            ->get();
        if (!$result) {
            return back()->with(['error_alert' => 'Unexpected error happened during accepting this request']);
        }

        //Disabled patient session
        Session::forget('PatientSendRequest');

        $result_encoded = json_encode($result);
        $result_decoded = json_decode($result_encoded, true);
        if ($result_decoded[0]['payment_way'] == 'Cache') {
            Alert::success('Success', 'This request has been successfully booked!');
            if(session('relative_id')){
                $patient_MRN =  DB::table('lab_appointment')
                ->join('patient', 'patient.MRN', '=', 'lab_appointment.MRN')
                ->where('lab_appointment.status', '=', 'booked')
                ->where('lab_appointment.appointment_id', '=', $id)
                ->join('patient_relatives', 'patient_relatives.MRN', '=', 'patient.MRN')
                ->where('patient_relatives.relative_id', session('relative_id'))
                ->select('patient.MRN')
                ->get();
            }else{
                $patient_MRN =  DB::table('lab_appointment')
                ->join('patient', 'patient.MRN', '=', 'lab_appointment.MRN')
                ->where('lab_appointment.status', '=', 'booked')
                ->where('lab_appointment.appointment_id', '=', $id)
                ->where('patient.MRN', session('id'))
                ->select('patient.MRN')
                ->get();  
            }
           
            $data = [
                'MRN' => $patient_MRN,
            ];
            event(new LabNotification($data));

            return redirect('/LabDash');
        }

        //Generate payment link
        //Online Payment
        $data = [
            'NotificationOption' => 'ALL', //'SMS', 'EML', or 'ALL'
            'InvoiceValue' => $result_decoded[0]['payment'],
            'CustomerName' => $result_decoded[0]['name'],
            'DisplayCurrencyIso' => 'EGP',
            'MobileCountryCode'  => '+20',
            'CustomerMobile'     => $result_decoded[0]['phone'],
            'CustomerEmail'      => $result_decoded[0]['email'],
            //callback -> if payment process is successfully done
            'CallBackUrl'        => 'http://127.0.0.1:8000/LabPayment/Success',
            'ErrorUrl'           => 'http://127.0.0.1:8000/LabPayment/Error',
            'Language'           => 'en'
        ];
        $paymentData = $this->fatoorahServices->sendPayment($data);
        $invoiceID = $paymentData['Data']['InvoiceId'];
        $invoiceURL = $paymentData['Data']['InvoiceURL'];
        if(session('relative_id')){
            $patient_MRN =  DB::table('lab_appointment')
            ->join('patient', 'patient.MRN', '=', 'lab_appointment.MRN')
            ->where('lab_appointment.status', '=', 'booked')
            ->where('lab_appointment.appointment_id', '=', $id)
            ->join('patient_relatives', 'patient_relatives.MRN', '=', 'patient.MRN')
            ->where('patient_relatives.relative_id', session('relative_id'))
            ->select('patient.MRN')
            ->get();
        }else{
            $patient_MRN =  DB::table('lab_appointment')
            ->join('patient', 'patient.MRN', '=', 'lab_appointment.MRN')
            ->where('lab_appointment.status', '=', 'booked')
            ->where('lab_appointment.appointment_id', '=', $id)
            ->where('patient.MRN', session('id'))
            ->select('patient.MRN')
            ->get();  
        }
        $data = [
            'MRN' => $patient_MRN,
        ];
        event(new LabNotification_onlinePay($data));


        DB::update('update lab_appointment set invoice_id = ? , payment_link=? where appointment_id = ?', [$invoiceID, $invoiceURL, $id]);
        // Mark patient as has payment link
        session()->regenerate();
        session([
            'hasPayment' => true,
        ]);

        Alert::success('Success', 'This request has been successfully booked!');
        return redirect('/LabDash');
    }

    public function PaymentCallBack(Request $request)
    {
        /*Get payment status from my fatoorah server which contains data about payment proccess 
           which include invoice id to enable search about that user in DB and update the payment status*/
        $data = [];
        $paymentID = $request->paymentId;
        $data['Key'] = $paymentID;
        $data['KeyType'] = 'paymentId';
        $paymentData = $this->fatoorahServices->getPaymentStatus($data);
        $invoiceID = $paymentData['Data']['InvoiceId'];

        DB::update('update lab_appointment set payment_status = ? where invoice_id = ?', ['Paid', $invoiceID]);

        $result = DB::table('lab_appointment')
            ->join('patient', 'patient.MRN', '=', 'lab_appointment.MRN')
            ->where('lab_appointment.invoice_id', '=', $invoiceID)
            ->select('*')
            ->get();
        if (!$result) {
            return redirect('/PaymentError');
        }

        //Disabled payment session
        Session::forget('hasPayment');
        return view('lab_pages.PaymentSuccess', compact('result'));
    }
    public function PaymentError()
    {
        //Disabled payment session
        Session::forget('hasPayment');
        return view('lab_pages.PaymentError');
    }
}
