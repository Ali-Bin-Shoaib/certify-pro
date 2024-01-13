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
        if ($request->method() == "GET") {
            if (Auth::check()) {
                return back()->with("info", "تمت علمية تسجيل الدخول مسبقا.");
            } else {
                return view("registration.signup");
            }
        } else if ($request->method() == "POST") {
            if (Auth::check())
                return back()->with("info", "لقد تم إنشاء حساب مسقا.");

            try {
                $request->validate([
                    "name" => "required",
                    "email" => ["required", "email"],
                    "username" => "required",
                    "password" => "required",
                    "phone" => "required",
                    "address" => "required",
                ]);
            } catch (\Throwable $th) {
                return back()->with("error", "خطأ في إدخال البيانات");
            }

            $organizationData = $request->only(["phone", "address"]);
            $userData = $request->only(['name', 'email', 'username', 'password']);
            $userData['role'] = 'organization';
            try {
                $user = User::create($userData);
                $organizationData['user_id'] = $user->id;
                $organization = Organization::create($organizationData);
                Auth::login($user);
                return redirect()->route('members.index')->with('success', 'تم إنشاء الحساب بنجاح');
            } catch (\Throwable $th) {
                try {
                    $user->delete();
                    $organization->delete();
                    return  back()->with('error', ' حصل خطأ عند عملية إنشاء حساب. تم حذف البانات السابقة. ');
                } catch (\Throwable $th) {
                    return  back()->with('error', 'حصل خطأ عند عملية إنشاء الحساب .');
                }
            }
        }
    }
    public function login(Request $request)
    {
        if ($request->method() == "GET") {
            if (Auth::user() === null) {
                return view("registration.login");
            } else
                return redirect(route('home'))->with('info', 'لقد تم تسجيل الدخول مسبقا.');
        } else if ($request->method() == "POST") {
            try {
                $request->validate([
                    'username' => 'required',
                    'password' => 'required',
                    'rememberMe' => 'nullable'
                ]);
            } catch (\Throwable $th) {
                return back()->with('error', 'خطأ في إدخال البيانات.');
            }
            $credentials = $request->only('username', 'password');

            $user = User::where('username', $credentials['username'])->first();
            if (!$user || !Hash::check($credentials['password'], $user['password']))
                return back()->with('error', 'خطأ في اسم المستخدم أو كلمة المرور');

            try {
                $request->session()->regenerate();
                Auth::login($user, $request->rememberMe == "on");
                $role = Auth::user()->role;
                if ($role === ('organization'))
                    return redirect()->intended(route("members.index"))->with("success", "تم تسجيل الدخول بنجاح");

                elseif ($role === 'member')
                    return redirect()->intended(route("programs.index"))->with("success", "تم تسجيل الدخول بنجاح");

                elseif ($role === "admin")
                    return redirect()->intended(route("home"))->with("success", 'welcome admin');
            } catch (\Throwable $th) {
                return back()->with("error", "حصل خطأ عند عملية تسجيل الدخول.");
                // throw $th;
            }
        }
    }
    public function logout()
    {
        //logout
        Session::flush();
        Auth::logout();
        return redirect(route('home'))->with('success', 'تم تسجيل الخروج بنجاح');
    }
}
