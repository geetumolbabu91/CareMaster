<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{
    public function checkLogin(Request $request){

        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
               ]);
               if (Auth::attempt($credentials)) 
               {
                
                  return response()->json([ 'status'  => true ,
                                            'message' => "Logged in",
                                            'token'   => auth()->user()->createToken("API_TOKEN")->plainTextToken
               ]);
               }
                   return response()->json(['status' => false ,
                                            'message' => "Invalid Credentials"
               
               ]);
    }

    public function logOut(){
        auth()->guard('web')->logout();
        auth()->user()->tokens()->delete();
    }
}
