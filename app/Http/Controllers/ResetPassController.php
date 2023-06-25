<?php

namespace App\Http\Controllers;
use App\Mail\ResetPasswordMail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;

class ResetPassController extends Controller
{
/**********************************                 forget Password                 **********************************/

    public function ShowForgetPass(){
        return view('lab_pages.forgetPass');
    }

    public function ForgetPass(Request $request){
          // validation
          $request->validate([
            'email' => 'required|email'
        ]);
                
         // Check if Email is in our DB
         $email = $request->email;
         $result = DB::select('select * from labunit where email = ?', [$email]);
         if(!$result){
            return back()->with(['error' => 'We do not find a user with this email address'])->withInput();
         }


        //Generate token
         $token = base64_encode(Str::random(64));
         DB::table('password_reset_tokens')->insert([
             'email'=>$request->email,
             'token'=>$token,
             'created_at'=>Carbon::now(),
         ]);
         
        $link = route('password.reset' , ['token'=> $token , 'email' => $email]);
        $date = date('Y-m-d ');

        //Sending reset link by email
        Mail::to($result)->send(new ResetPasswordMail($date , $link));

        return redirect('/forgetPass')->with(['success'=>'Thank you for submitting , We have e-mailed your password reset link']);



         
       /* $status = Password::sendResetLink(
            $request->only('email')
        );  
        return $status === Password::RESET_LINK_SENT
                    ? back()->with(['status' => __($status)])
                    : back()->withErrors(['email' => __($status)]);*/ 
    }






/**********************************                  Reset Password                 **********************************/

    public function showResetPass (string $token ) {
        $email = DB::table('password_reset_tokens') ->where('token','=', $token)->select('email')->get();
        if( count($email) == 0){
            Alert::error('Error!','This reset link is invalid , It has been already used once');
            return redirect('/LabLogin');
        }
        return view('lab_pages.resetPass', ['token' => $token] , compact('email'));
    }


    public function ResetPass (Request $request) {
        //validation
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);
        
        $checkToken = DB::table('password_reset_tokens')->where([
            'email'=>$request->email,
            'token'=>$request->token,
        ])->first();
        if(! $checkToken){
            return back()->with(['error' => 'Something went wrong , Please try again']);
        }else{
            $passwordEnc = Hash::make($request->password);
            //Update table with new password
            DB::update('update labunit set password = ? where email = ?',[$passwordEnc , $request->email]);
        }


        //Delete token
        DB::table('password_reset_tokens')->where([
            'email'=>$request->email,
            'token'=>$request->token,
        ])->delete();
        
    
        return redirect('/LabLogin')->with(['success'=>'Your password has been updated successfully.']);




    
        /*$status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (User $user, string $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));
     
                $user->save();
     
                event(new PasswordReset($user));
            }
        );
        return $status === Password::PASSWORD_RESET
        ? redirect('LabLogin')->with('status', __($status))
        : back()->withErrors(['email' => [__($status)]]); */ 
    }

}

