<?php

namespace App\Http\Controllers;

use App\Events\LabNotification_result;
use Carbon\Carbon;
use \Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use RealRashid\SweetAlert\Facades\Alert;


class LabRequestController extends Controller
{
    /**********************************                 DashBoard->New Requests                 **********************************/

    public function ShowDash()
    {
        $new_request = DB::table('lab_appointment')
            ->join('patient', 'patient.MRN', '=', 'lab_appointment.MRN')
            ->where('lab_appointment.status', '=', 'request')
            ->where('lab_appointment.lab_id', '=', session('labId'))
            ->select('*')
            ->orderBy('appointment_date', 'ASC')
            ->paginate(10);

        $guest_new_request = DB::table('lab_appointment')
            ->where('lab_appointment.status', '=', 'request')
            ->where('lab_appointment.lab_id', '=', session('labId'))
            ->select('*')
            ->orderBy('appointment_date', 'ASC')
            ->paginate(10);

        //Get Today Date
        $date = Carbon::now()->addMinutes(180)->format('y-m-d');

        //Number of Today's booked appointments
        $appointments = DB::select('select * from lab_appointment where status = "booked" and  appointment_date = ? and lab_id=? ', [$date, session('labId')]);
        //Number of Today's required uploads
        $uploads = DB::select('select * from lab_appointment where status = "upload" and  due_date = ? and lab_id=?', [$date, session('labId')]);
        //Total revenue -> when status is either uploaded or done
        $uploadsCost = DB::select('select * from lab_appointment where status != "request" and  status != "booked" and lab_id=?', [session('labId')]);

        return view('lab_pages.LabDash', compact('new_request','guest_new_request', 'appointments', 'uploads', 'uploadsCost'));
    }



    /* Chat function -> modal appear when click on chat icon*/
    public function ChatPopUp(Request $request)
    {
        // validation
        $request->validate([
            'message' => 'required',
            'user_id' => 'required'
        ]);
        $message = $request->input('message');
        $id = $request->input('user_id');


        $date = Carbon::now()->addMinutes(180);
        DB::insert('insert into chat(date , message , send_from , send_to) values(?, ?, ?, ?)', [$date, $message, session('labId'), $id]);

        $messageId = DB::getPdo()->lastInsertId();
        $result = DB::select('select * from chat where message_id = ?', [$messageId]);
        if (!$result) {
            return back()->with(['error_alert' => 'Unexpected error happened during sending the message']);
        }

        $patientName = DB::select('select name from patient where MRN = ? ', [$id]);
        $object_encoded = json_encode($patientName);
        $object_decoded = json_decode($object_encoded, true);

        return back()->with(['success_alert' => 'Your message has been sent to " ' . $object_decoded[0]['name'] . ' " ']);
    }




    /* Delete Request function -> when click on reject icon*/
    public function DashReject($id)
    {
        DB::delete('delete from lab_result where appointment_id = ?', [$id]);
        DB::delete('delete from lab_appointment where appointment_id = ?', [$id]);
        $result = DB::select('select * from lab_appointment where appointment_id = ?', [$id]);
        if ($result) {
            return back()->with(['error_alert' => 'Unexpected error happened during deleting this request']);
        }
        //Disabled patient session
        Session::forget('PatientSendRequest');

        Alert::success('Deleted!', 'This request has been successfully deleted!');
        return back();
    }




    /**********************************                 DashBoard->Required Uploads                 **********************************/

    public function ShowUploads()
    {
        $TodayUploads = DB::table('lab_appointment')
            ->join('patient', 'patient.MRN', '=', 'lab_appointment.MRN')
            ->where('lab_appointment.status', '=', 'upload')
            ->where('lab_appointment.due_date', '=', Carbon::now()->addMinutes(180)->format('Y-m-d'))
            ->where('lab_appointment.lab_id', '=', session('labId'))
            ->select('*')
            ->orderBy('due_date', 'ASC')
            ->get();
        $NextUploads = DB::table('lab_appointment')
            ->join('patient', 'patient.MRN', '=', 'lab_appointment.MRN')
            ->where('lab_appointment.status', '=', 'upload')
            ->where('lab_appointment.due_date', '>', Carbon::now()->addMinutes(180)->format('Y-m-d'))
            ->where('lab_appointment.lab_id', '=', session('labId'))
            ->select('*')
            ->orderBy('due_date', 'ASC')
            //get first 3 rows
            ->skip(0)->take(3)->get();

        return view('lab_pages.LabUploads', compact('TodayUploads', 'NextUploads'));
    }





    public function upload(Request $request)
    {
        $request->validate([
            'uploadfile' => 'required',
            'labID' => 'required',
            'testType' => 'required',
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
        $labId = $request->input('labID');
        $TestName = $request->input('testType');
        $testId = DB::select('select test_id from disease_test where test_name = ?', [$TestName]);
        $object_encoded = json_encode($testId);
        $object_decoded = json_decode($object_encoded, true);


        $appointment_id = $request->input('appointment_id');

        //Check if the test name the physician have chosen is matched with database or not
        $Test = DB::table('lab_result')
            ->where('appointment_id', '=', $appointment_id)
            ->select('*')
            ->get();
        $Test_encoded = json_encode($Test);
        $Test_decoded = json_decode($Test_encoded, true);
        $testValidation = null;

        for ($i = 0; $i < count($Test); $i++) {
            if ($object_decoded[0]['test_id'] ==  $Test_decoded[$i]['test_id']) {
                $testValidation = true;
                break;
            }
        }
        if (!$testValidation) {
            File::delete(public_path('/Lab_images/Uploads/' . $imageName));
            Alert::error('Error!', 'The test you have chosen is not available for this user , Check The Required Tests');
            return back();
        }

        $numFiles = DB::table('lab_result')->where('appointment_id', '=', $appointment_id)->where('result_file', '=', null)->count();

        //Store lab result 'uploaded file' in db
        DB::update('update lab_result set image_name=? , result_file =? , physician_id=? , upload_date=? where appointment_id = ? and test_id = ?', [$imageName, $newimgName, $labId, Carbon::now()->addMinutes(180), $appointment_id, $object_decoded[0]['test_id']]);

        //Check if update process went wrong and in this case will delete the image from image's folder
        $result = DB::select('select result_file from lab_result where appointment_id = ? and test_id = ?', [$appointment_id, $object_decoded[0]['test_id']]);
        if (!$result) {
            File::delete(public_path('/Lab_images/Uploads/' . $imageName));
            Alert::error('Error!', 'Unexpected error happened during uploading this file , Please try again');
            return back();
        }



        //Change this request status to done
        if ($numFiles > 0) {
            $numFiles--;
            if ($numFiles == 0) {
                DB::update('update lab_appointment set status =? where appointment_id = ?', ['done', $appointment_id]);
            }
        }
        Alert::success('Success', 'This file has been successfully uploaded!');
        
        if (session('relative_id')) {
            $patient_MRN =  DB::table('lab_appointment')
            ->join('patient', 'patient.MRN', '=', 'lab_appointment.MRN')
            ->join('patient_relatives', 'patient_relatives.MRN', '=', 'patient.MRN')
            ->where('lab_appointment.appointment_id', '=', $appointment_id)
            ->where('patient_relatives.relative_id', session('relative_id'))
            ->select('patient.MRN')
            ->get();        
        }elseif(session('doctorid')){
            $patient_MRN =  DB::table('lab_appointment')
            ->join('patient', 'patient.MRN', '=', 'lab_appointment.MRN')
            ->join('doctor-patient', 'doctor-patient.MRN', '=', 'patient.MRN')
            ->where('lab_appointment.appointment_id', '=', $appointment_id)
            ->where('doctor-patient.doctor_id', session('doctorid'))
            ->select('patient.MRN')
            ->get();      
        }else{
            $patient_MRN =  DB::table('lab_appointment')
            ->join('patient', 'patient.MRN', '=', 'lab_appointment.MRN')
            ->where('lab_appointment.appointment_id', '=', $appointment_id)
            ->where('patient.MRN', session('id'))
            ->select('patient.MRN')
            ->get();      
        }
        
        $data = [
            'MRN' => $patient_MRN,
        ];
        event(new LabNotification_result($data, $imageName));

        return redirect('/LabUploads');
    }








    /**********************************                 DashBoard->Booked Appointments                 **********************************/


    public function ShowCalendar()
    {
        $booked = DB::table('lab_appointment')
            ->join('patient', 'patient.MRN', '=', 'lab_appointment.MRN')
            ->where('lab_appointment.status', '=', 'booked')
            ->where('lab_appointment.lab_id', '=', session('labId'))
            ->select('*')
            ->get();
        $events = [];
        foreach ($booked as $book) {
            $events[] = [
                'id' => $book->appointment_id,
                'title' => $book->name,
                'start' => $book->appointment_date,
                'end' => $book->end_date,
            ];
        }

        $todayBooked = DB::table('lab_appointment')
            ->join('patient', 'patient.MRN', '=', 'lab_appointment.MRN')
            ->where('lab_appointment.status', '=', 'booked')
            ->where('lab_appointment.lab_id', '=', session('labId'))
            ->where('lab_appointment.appointment_date', '=', Carbon::now()->addMinutes(180)->format('Y-m-d'))
            ->select('*')
            ->paginate(1);

        return view('lab_pages.LabBookedAppointment', compact('events', 'todayBooked'));
    }








    /*Add new appointment function -> in the calendar*/
    public function AddNewAppointment(Request $request)
    {

        $request->validate([
            'patient' => 'required',
            'start_date' => 'required|after_or_equal:today',
            'end_date' => 'required',
            'Test' => 'required',
            'test_name' => 'required'
        ]);

        //Store patient name then get his MRN
        $patientName = $request->get('patient');
        $UserId = DB::select('select MRN from patient where name = ?', [$patientName]);
        $object_encoded = json_encode($UserId);
        $object_decoded = json_decode($object_encoded, true);


        $appointment_date = $request->start_date;
        $end_date = $request->end_date;

        $tests = $request->Test;
        $testName = $request->test_name;



        //Get last appointment id
        $appointment = DB::table('lab_appointment')->latest('appointment_id')->first();
        $appointment_id = $appointment->appointment_id + 1;

        DB::insert('insert into lab_appointment (lab_id ,appointment_id, MRN, appointment_date , end_date, status , payment_way ) values(?,?,?,?,?,?,?)', [session('labId'), $appointment_id, $object_decoded[0]['MRN'], $appointment_date, $end_date, 'booked', 'Cache']);

        //Check that appointment has been successfully added in DB
        $result = DB::table('lab_appointment')
            ->join('patient', 'patient.MRN', '=', 'lab_appointment.MRN')
            ->where('lab_appointment.appointment_id', '=', $appointment_id)
            ->select('*')->get();

        if (!$result) {
            return back()->with(['error_alert' => 'Unexpected error happened during registration']);
        }

        //Store New Tests in DB in lab_result table
        foreach ($tests as $test) {
            if ($test != 'No test') {
                $TestId = DB::select('select test_id from disease_test where test_name = ?', [$test]);
                $objectEncoded = json_encode($TestId);
                $objectDecoded = json_decode($objectEncoded, true);
                DB::insert('insert into lab_result(appointment_id , test_id ) values(?, ?)', [$appointment_id, $objectDecoded[0]['test_id']]);
            }
        }

        if ($testName != 'No test') {
            $TestId = DB::select('select test_id from disease_test where test_name = ?', [$testName]);
            $TestIdEncoded = json_encode($TestId);
            $TestIdDecoded = json_decode($TestIdEncoded, true);
            DB::insert('insert into lab_result(appointment_id , test_id ) values(?, ?)', [$appointment_id, $TestIdDecoded[0]['test_id']]);
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

        return response()->json($result);
    }









    /*Update appointment date function -> in the calendar*/
    public function UpdateAppointment(Request $request, $id)
    {
        $result = DB::select('select * from lab_appointment where appointment_id = ?', [$id]);
        if (!$result) {
            return response()->json(['error' => 'Unexpected error happened, Please try again'], 404);
        }
        //update DB with new dates
        $appointment_date = $request->start_date;
        $end_date = $request->end_date;
        DB::update('update lab_appointment set appointment_date =? , end_date=? where appointment_id = ?', [$appointment_date, $end_date, $id]);

        return response()->json('Event Updated');
    }






    /*Delete appointment function -> in the calendar*/
    public function DeleteAppointment(Request $request, $id)
    {
        $result = DB::select('select * from lab_appointment where appointment_id = ?', [$id]);
        if (!$result) {
            return response()->json(['error' => 'Unexpected error happened, Please try again'], 404);
        }

        //delete appointment from DB
        DB::delete('delete from lab_result where appointment_id = ?', [$id]);
        DB::delete('delete from lab_appointment where appointment_id = ?', [$id]);
        $result = DB::select('select * from lab_appointment where appointment_id = ?', [$id]);
        if ($result) {
            return back()->with(['error_alert' => 'Unexpected error happened during deleting this request']);
        }

        return $id;
    }









    /*Accept function -> submit button in the today's booked appointments form*/
    public function AcceptAppointment(Request $request)
    {
        // validation
        $request->validate([
            'id' => 'required',
            'date' => 'required',
            'appointment_id' => 'required'
        ]);
        $recipient_id = $request->input('id');
        $due_date = $request->input('date');
        $appointment_id = $request->input('appointment_id');
        //If it was checked you get true, 1, if it wasn't checked you get false, 0.
        $checked = $request->has('checked');
        if (!$checked) {
            Alert::warning('Warning', 'The payment is not completed yet! Registration process is canceled ');
            return back()->with(['info_alert' => 'To complete the registration ,"Successful Payment Completed" must be checked first']);
        }

        DB::update('update lab_appointment set status = ? , recipient_id = ? , due_date = ? , payment_status = ? where appointment_id = ?', ['upload', $recipient_id, $due_date, 'Paid', $appointment_id]);


        //Check update process has been successfully done
        $result = DB::select('select * from lab_appointment where appointment_id = ? and status=?', [$appointment_id, 'upload']);
        if (!$result) {
            Alert::error('Error!', 'Unexpected error happened during this process , Please try again');
            return back();
        }


        Alert::success('Success', 'This process has been successfully done!');
        return redirect('/LabBookedAppointment');
    }








    /*Edit function -> edit button in the today's booked appointments form*/
    public function EditAppointment(Request $request)
    {
        // validation
        $request->validate([
            'appointment_id' => 'required'
        ]);

        $tests = $request->input('tests');
        $testName = $request->input('test');
        $appointment_id = $request->input('appointment_id');

        if (!$tests && !$testName) {
            Alert::error('Error!', 'You must choose test first');
            return back();
        }

        //if user write a test name in search box or choose from list
        if ($testName || $tests) {
            //Check that admin does not choose test that has already been booked for this user
            $bookedTests = DB::select('select test_id from lab_result where appointment_id = ?', [$appointment_id]);
            $TestEncoded = json_encode($bookedTests);
            $TestDecoded = json_decode($TestEncoded, true);

            if ($tests) {
                foreach ($tests as $test) {
                    $TestId = DB::select('select test_id from disease_test where test_name = ?', [$test]);
                    $objectEncoded = json_encode($TestId);
                    $objectDecoded = json_decode($objectEncoded, true);
                    for ($i = 0; $i < count($bookedTests); $i++) {
                        if ($objectDecoded[0]['test_id'] ==  $TestDecoded[$i]['test_id']) {
                            Alert::error('Error!', 'Repeated Test! The test/s has already been chosen');
                            return back()->with(['warning_alert' => ' The " ' . $test . ' " is already booked ']);
                        }
                    }
                    //Store New Tests in DB
                    DB::insert('insert into lab_result(appointment_id , test_id ) values(?, ?)', [$appointment_id, $objectDecoded[0]['test_id']]);
                }
            }


            if ($testName) {
                $TestId = DB::select('select test_id from disease_test where test_name = ?', [$testName]);
                $TestIdEncoded = json_encode($TestId);
                $TestIdDecoded = json_decode($TestIdEncoded, true);
                for ($i = 0; $i < count($bookedTests); $i++) {
                    if ($TestIdDecoded[0]['test_id'] ==  $TestDecoded[$i]['test_id']) {
                        Alert::error('Error!', 'Repeated Test! The test/s has already been chosen');
                        return back()->with(['warning_alert' => ' The " ' . $testName . ' " is already booked ']);
                    }
                }
                //Store New Tests in DB
                DB::insert('insert into lab_result(appointment_id , test_id ) values(?, ?)', [$appointment_id, $TestIdDecoded[0]['test_id']]);
            }
            //Update new total cost
            $testCosts = DB::table('lab_result')
                ->join('disease_test', 'disease_test.test_id', '=', 'lab_result.test_id')
                ->where('lab_result.appointment_id', '=', $appointment_id)
                ->select('cost')->get();
            $totalCost = 0;
            foreach ($testCosts as $testCost) {
                $totalCost += $testCost->cost;
            }

            DB::update('update lab_appointment set payment = ? where appointment_id = ?', [$totalCost, $appointment_id]);


            Alert::success('Success', 'This appointment has been successfully edited!');
            return redirect('/LabBookedAppointment');
        }
    }





    /**************************************                 DashBoard->Chat                 **************************************/
    public function ShowChat()
    {
        return view('lab_pages.LabChat');
    }
}
