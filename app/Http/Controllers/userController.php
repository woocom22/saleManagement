<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
}
