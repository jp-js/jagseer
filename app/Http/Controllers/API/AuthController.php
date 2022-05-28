<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\View\Factory;
use Illuminate\Support\Carbon;
use App\Models\User as MyModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class AuthController extends ApiController {

    public function userRegister(Request $request) {

        $rules = ['name' => 'required', 'email' => 'required|unique:users,email', 'mobile' => 'required|unique:users,mobile', 'password' => 'required|min:6|max:15'];
        $validateAttributes = parent::validateAttributes($request, 'POST', $rules, array_keys($rules), false);
        if ($validateAttributes):
            return $validateAttributes;
        endif;
        try {
            $input = $request->all();
            // dd($input);
            $otp = mt_rand(1000, 9999);
            $input['password'] = Hash::make($request->password);   
            $input['otp']  = $otp;
            $user = MyModel::create($input);
            $dataM = ['subject' => 'Your Otp Verification Code', 'name' => 'LBM', 'to' => $request->email, 'otp' => $otp]; 
            Mail::send('emails.send_email', $dataM, function($message) use ($dataM) {
                $message->to($dataM['to']);
                $message->subject($dataM['subject']);
            });
            parent::sendOTP($request->mobile,$otp);
            return parent::successCreated(['message' => 'User Register Successfully',]);
        } catch (\Exception $ex) {
            return parent::error($ex->getMessage());
        }
    }
    
    public function verityOTP(Request $request) {
        $rules = ['email' => 'required|exists:users,email', 'otp' => 'required'];
        $validateAttributes = parent::validateAttributes($request, 'POST', $rules, array_keys($rules), true);
        if ($validateAttributes):
            return $validateAttributes;
        endif;
        try {
                $user = MyModel::where(['email' => $request->email,'otp' => $request->otp]);
                if($user->count() > 0){
                    $user->update(['is_verify' => '1']);
                }else{
                    return parent::error('User not verify');    
                }
                return parent::success(['message' => 'User Verify Successfully']);
            
        } catch (\Exception $ex) {
            return parent::error($ex->getMessage());
        }
    }

    public function resendOtp(Request $request) {
        $rules = ['email' => 'required|exists:users,email'];
        $validateAttributes = parent::validateAttributes($request, 'POST', $rules, array_keys($rules), true);
        if ($validateAttributes):
            return $validateAttributes;
        endif;
        try {
            $timestamp =  $_SERVER["REQUEST_TIME"];  // record the current time stamp 
            if(($timestamp - session('time')) > 120)  // 300 refers to 300 seconds
            {
                    session()->forget(['session_otp','time']);
                    session()->flush();

                    $otp = mt_rand(1000, 9999);
                    session(['session_otp' =>  $otp]); 
                    $timestamp =  $_SERVER["REQUEST_TIME"];  // generate the timestamp when otp is forwarded to user email/mobile.
                    session(['time' =>  $timestamp]); 
                    $dataM = ['subject' => 'Your Login Otp Verification Code', 'name' => 'LBM', 'to' => $request->email, 'otp' => $otp];  
                    Mail::send('emails.send_email', $dataM, function($message) use ($dataM) {
                        $message->to($dataM['to']);
                        $message->subject($dataM['subject']);
                    });
                    return parent::success(["message" => "Otp send on your email.."]);           
            }else{
                return parent::error("Send OTP After 2 min");           
            }
            
        } catch (\Exception $ex) {
            return parent::error($ex->getMessage());
        }
    }
    
    public function userlogin(Request $request) {
        $rules = ['email' => 'required|email', 'password' => 'required', 'otp' => ''];
        $validateAttributes = parent::validateAttributes($request, 'POST', $rules, array_keys($rules), true);
        if ($validateAttributes):
            return $validateAttributes;
        endif;
        try {
        
                if(!session('session_otp')){
                    $otp = mt_rand(1000, 9999);
                    session(['session_otp' =>  $otp]); 
                    $timestamp =  $_SERVER["REQUEST_TIME"];  // generate the timestamp when otp is forwarded to user email/mobile.
                    session(['time' =>  $timestamp]); 
                    $dataM = ['subject' => 'Your Login Otp Verification Code', 'name' => 'LBM', 'to' => $request->email, 'otp' => $otp];  
                    Mail::send('emails.send_email', $dataM, function($message) use ($dataM) {
                        $message->to($dataM['to']);
                        $message->subject($dataM['subject']);
                    });
                    return parent::success(["message" => "Please Verify otp send on your email.."]);
                }else{
                    // dd(session('session_otp'),$request->otp);
                    if(!empty(session('session_otp'))){
                    
                    $otp = $request->otp;  //receives the otp entered by the user
                    $timestamp =  $_SERVER["REQUEST_TIME"];  // record the current time stamp 
                    // dd($timestamp);
                    if(($timestamp - session('time')) < 120)  // 300 refers to 300 seconds
                    {
                            if(session('session_otp') == $otp){

                            if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
                                session()->forget(['session_otp','time']);
                                session()->flush();
                                $model = MyModel::where(['email' => $request->email, 'is_verify' => '1'])->first();
                                if($model != null){
                //                    dd(Auth::id());
                                $token = $model->createToken('mytoken')->accessToken;
                                return parent::success(['message' => 'Login Successfully', 'token' => $token]);
                              }else{
                                return parent::error("User not verify");  
                              }
                            } else {
                                return parent::error("User credentials doesn't matched");
                            }
                        }else{
                            return parent::error("OTP not match");
                        }

                    }else{
                        if(($timestamp - session('time')) > 120){
                            session()->forget(['session_otp','time']);
                            session()->flush();
                        }
                        return parent::error("OTP Expire, Please resend OTP");
                    }   
                    // return parent::error("OTP Expire, Please resend OTP after 2 min.");
                }else{
                    return parent::error("OTP not match, try again");  
                }
            }
   
        } catch (\Exception $ex) {
            return parent::error($ex->getMessage());
        }
    }

    public function resetPassword(Request $request, Factory $view) {
        $rules = ['email' => 'required'];
        $validateAttributes = parent::validateAttributes($request, 'POST', $rules, array_keys($rules), true);
        if ($validateAttributes):
            return $validateAttributes;
        endif;
      
            $email_exist = MyModel::where('email', $request->email)->count() > 0;
            if ($email_exist) {
                $otp = mt_rand(1000, 9999);
                if(!session('password_otp')){
                    session(['password_otp' =>  $otp]); 
                    $timestamp =  $_SERVER["REQUEST_TIME"];  // generate the timestamp when otp is forwarded to user email/mobile.
                    session(['password_time' =>  $timestamp]); 
                    // dd();
                $dataM = ['subject' => 'Your Password Verification code', 'to' => $request->email, 'otp' => $otp];
                //dd(env('SENDINBLUE_KEY'),env('MAIL_DRIVER'),$dataM);
                //send mail to user as a feedback    
                Mail::send('emails.send_email', $dataM, function($message) use ($dataM) {
                    $message->to($dataM['to']);
                    $message->subject($dataM['subject']);
                });
            }else{
                    $timestamp =  $_SERVER["REQUEST_TIME"];  // record the current time stamp 
                    // dd($timestamp);
                    if(($timestamp - session('time')) > 120)  // 300 refers to 300 seconds
                    {
                        return parent::error("Please resend OTP after 2 min.");
                    }
            }
                //ENDS
                return parent::successCreated(['message' => 'Otp sent Successfully', 'otp' => $otp]);
            } else {
                return parent::error("Email does not exists");
            }

    }


    public function changePassword(Request $request) {
        // dd(\Auth::id());
        $rules = ['old_password' => 'required', 'new_password' => 'required', 'otp' => 'required'];
        $validateAttributes = parent::validateAttributes($request, 'POST', $rules, array_keys($rules), false);
        if ($validateAttributes):
            return $validateAttributes;
        endif;
        try {
            if(!empty(session('password_otp')) && !empty($request->otp) && session('password_otp') == $request->otp){
                if (Hash::check($request->old_password, Auth::User()->password)):
                    $model = MyModel::find(Auth::id());
                    $model->password = Hash::make($request->new_password);
                    $model->save();
                    session()->forget(['password_otp','password_time']);
                    session()->flush();
                    return parent::success(['message' => 'Password Changed Successfully']);
                else:
                    return parent::error('Please use valid old password');
                endif;   
            }else{
                return parent::error("OTP not match, try again");  
            }
        } catch (\Exception $ex) {
            return parent::error($ex->getMessage());
        }
    }
}
