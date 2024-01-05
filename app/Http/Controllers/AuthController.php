<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Organization;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Symfony\Component\VarDumper\VarDumper;

class AuthController extends Controller
{

    public function signup(Request $request)
    {
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
                $organizationData = $request->only(["phone", "address"]);
                $userData = $request->only(['name', 'email', 'username', 'password']);
                $userData['role'] = 'organization';
                try {
                    $user = User::create($userData);
                    if ($user) {
                        $organizationData['user_id'] = $user->id;
                        $organization = Organization::create($organizationData);
                        if ($organization) {
                            Auth::login($user);
                            return redirect()->route('members.index')->with('success', 'تم إنشاء الحساب بنجاح');
                        }
                    }
                    throw new \Exception('error at creating an organization account.');
                } catch (\Throwable $th) {
                    if ($user) $user->delete();
                    if ($organization) $organization->delete();
                    back()->with('error', 'حصل خطأ عند عملية إنشاء الحساب .');
                }
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
                $credentials = $request->validate([
                    'username' => 'required',
                    'password' => 'required',
                ]);

                $user = User::where('username', '=', $credentials['username'])->first();
                if (!$user && !Hash::check($credentials['password'], $user['password'])) {
                    return back()->with('error', 'خطأ في اسم المستخدم أو كلمة المرور');
                }
                $request->session()->regenerate();
                Auth::login($user, true);
                if (Auth::user()->role === ('organization'))
                    return redirect()->intended(route("members.index"))->with("success", "تسم تسجيل الدخول بنجاح");
                elseif (Auth::user()->role === 'member')
                    return redirect()->intended(route("programs.index"))->with("success", "تم تسجيل الدخول بنجاح");
                elseif (Auth::user()->role === "admin")
                    return redirect()->intended(route("home"))->with("success", 'welcome admin');
                return back()->with('error', 'خطأ في اسم المستخدم أو كلمة المرور');
                // return redirect(route('login'))->withe('error', 'Invalid username or password');
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
        return redirect('/')->with('success', 'تم تسجيل الخروج بنجاح');
    }
    public function unAuthorized(Request $request)
    {
        return view('registration.unAuthorized');
    }
}
