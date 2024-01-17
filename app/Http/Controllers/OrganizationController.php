<?php

namespace App\Http\Controllers;

use App\Models\Organization;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrganizationController extends Controller
{


    public function edit()
    {
        try {
            $organization = Organization::where('id', Auth::user()->organization->id)->first();

            if ($organization) {
                return view('organizations.edit', compact('organization'));
            }
            return back()->with('error', 'لا يوجد حساب منظمة');
        } catch (\Throwable $th) {
            return back()->with('error', 'حصل خطأ عند محاولة عرض صفحة تعديل البيانات');
        }
    }


    public function update(Request $request)
    {
        try {
            $request->validate([
                "name" => "required",
                "email" => ["required", "email"],
                "username" => "required",
                "password" => "required",
                "phone" => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:9',
                "address" => "required",
            ]);
        } catch (\Throwable $th) {
            return back()->with("error", "خطأ في إدخال البيانات");
        }
        $organization = Organization::where('id', Auth::user()->organization->id)->first();
        $user = User::find(Auth::user()->id);
        if ($organization && $user) {
            try {
                $organization->update($request->only('phone', 'address'));
                $user->update($request->except('phone', 'address'));
                return redirect()->route('members.index')->with('success', 'تم تحديث البيانات بنجاح');
            } catch (\Throwable $th) {
                return back()->with('error', 'حصل خطأ عند تحديث البيانات');
            }
        }
        return back()->with('error', 'خطأ لا نستطيع إيجاد بيانات الحساب');
    }
}
