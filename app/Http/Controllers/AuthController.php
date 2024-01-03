<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{

    public function signup(Request $request)
    {
        return view("registration.signup");
    }
    public function login(Request $request)
    {
        if ($request->method() == "GET")
            return view("registration.login");
        else if ($request->method() == "POST")
        {

        }
    }
    public function logout()
    {
        //logout 
        return redirect('/');
    }
}
