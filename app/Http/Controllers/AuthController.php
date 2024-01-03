<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Organization;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Symfony\Component\VarDumper\VarDumper;

class AuthController extends Controller
{

    public function signup(Request $request)
    {
        // dd($request->all());
        if ($request->method() == "GET")
            return view("registration.signup");
        else if ($request->method() == "POST") {
            try {
                $request->validate([
                    "name" => "required",
                    "email" => ["required", "email"],
                    "username" => "required",
                    "password" => "required",
                    "phone" => "required",
                    "address" => "required",
                ]);
                $organizationData = $request->only(["name", "email", "phone", "address"]);
                $userData = $request->only(['username', 'password']);
                $user = User::create([...$userData, 'isOrganization' => true]);
                // VarDumper::dump($user);
                $organization = Organization::create([...$organizationData, 'user_id' => $user->id]);
                // VarDumper::dump([$user, $organization, $request->all()]);
                if (Member::where('organization_id', $organization->id)->exists())
                    return redirect()->route('members.index')->with('success', 'You have signed in');
                else
                    return redirect()->route('members.create')->with('success', 'You have signed in');
            } catch (\Throwable $th) {
                throw $th;
            }
        }
    }
    public function login(Request $request)
    {
        if ($request->method() == "GET") {
            if (Auth::user() === null) {
                return view("registration.login");
            } else
                return redirect(route('home'));
        } else if ($request->method() == "POST") {
            try {
                $request->validate([
                    'username' => 'required',
                    'password' => 'required',
                ]);
                $credentials = $request->only("username", "password");
                if (Auth::attempt($credentials)) {
                    return redirect()->intended(route("programs.index"))->with("success", "Logged in");
                }
                return redirect(route('login'))->withe('error', 'Invalid username or password');
            } catch (\Throwable $th) {
                throw $th;
            }
        }
    }
    public function logout()
    {
        //logout 
        Session::flush();
        Auth::logout();
        return redirect('/');
    }
}
