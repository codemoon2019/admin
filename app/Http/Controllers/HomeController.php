<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;

class HomeController extends Controller
{

    /**
    * Show the application dashboard.
    *
    * @return \Illuminate\Contracts\Support\Renderable
    */
    public function index()
    {
        return view('home');
    }

    /**
    * Show the application dashboard.
    *
    * @return \Illuminate\Contracts\Support\Renderable
    */
    public static function login()
    {
        
        $settingUpAnAccount = User::get()->count();
        if($settingUpAnAccount != 0){
            return view('auth.login');
        }else{
            return view('auth.register');
        }

    }

    /**
    * Authenticate user account
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public static function authenticateUser(Request $request){

        if (Auth::attempt(['email' => $request->input('email'), 'password' => $request->input('password') ])) {
            return Array(
                'success' => true,
                'internalMessage' => 'User logged in successfully!',
                'userMessage' => 'User logged in successfully!'
            );
        } else {
            return Array(
                'success' => false,
                'internalMessage' => 'Please check your credentials!',
                'userMessage' => 'Please check your credentials!'
            );
        }

    }



}
