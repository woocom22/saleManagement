<?php

namespace App\Http\Controllers;

use App\helper\jwtToken;
use App\Mail\OTPMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class userController extends Controller
{
    function  UserRegistration(Request $request)
    {
        user::create([
            'firstName'=> $request->input('firstName'),
            'lastName'=> $request->input('lastName'),
            'email'=> $request->input('email'),
            'mobile'=> $request->input('mobile'),
            'password'=> $request->input('password')
        ]);
        return response()->json([
            'status' => 'success',
            'success'=>'You have successfully registered'
        ], 200);
    }
    function UserLogin(Request $request)
    {
        $count = user::where('email', '=', $request->input('email'))
            ->where('password', '=', $request->input('password'))
            ->count();
        if ($count==1){
            $token=jwtToken::createToken($request->input('email'));
            return response()->json([
               'status' => 'success',
               'message'=>'You have successfully logged in',
                'token'=>$token
            ], 200);
        }else{
            return response()->json([
                'status' => 'failed',
                'message'=>'Unauthorized'
            ],200);
        }
    }
    function SendOTPCode(Request $request)
    {
       $email=$request->input('email');
       $otp=rand(1000,9999);
       $count=User::where('email','=',$email)->count();

       if ($count==1){
           // Send OTP to email
            Mail::to($email)->send(new OTPMail($otp));
            // store otp code in db
           User::where('email','=',$email)->update(['otp'=>$otp]);
           return response()->json([
               'status' => 'success',
               'message'=>'4 digit code sent to your email'
           ],200);

       }else{
           return response()->json([
               'status' => 'failed',
               'message'=>'Unauthorized'
           ],200);
       }



    }
}
