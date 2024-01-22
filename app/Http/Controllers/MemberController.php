<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\VarDumper\VarDumper;

class MemberController extends Controller
{

    public function index()
    {
        try {
            $members = Member::where('members.organization_id', Auth::user()->organization->id)->get('members.*');
            if ($members)
                return view('members.index', compact('members'));
            return back()->with('error', 'لا يوجد أعضاء ');
        } catch (\Throwable $th) {
            return back()->with('error', 'حصل خطأ عند البحث عن معلومات الأعضاء.');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('members.create');
    }


    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required',
                'username' => 'required|unique:users,username',
                'email' => 'required|email|unique:users,email',
                'job_title' => 'required',
                'password' => 'required',
                // 'organization_id' => 'required',
            ]);
        } catch (\Throwable $th) {
            // return back()->with('error', 'خطأ في البيانات المدخلة');
            return back()->with('error', $th->getMessage());
        }
        try {
            $newUser = $request->except('job_title');
            $newUser['role'] = 'member';
            $createdUser = User::create($newUser);
            $newMember = $request->only('job_title');
            $newMember['user_id'] = $createdUser->id;
            $newMember['organization_id'] = Auth::user()->organization->id;
            Member::create($newMember);
            return redirect()->route('members.index')->with('success', 'تم إضافة عضو جديد بنجاح.');
        } catch (\Throwable $th) {
            return back()->with('error', 'حصل خطأ عند إضافة عضو جديد');
            // throw $th;
        }
    }

    public function show(string $id)
    {
        try {
            $member = Member::where('members.organization_id', Auth::user()->organization->id)->where('id', $id)->first();
            if ($member != null)
                return view('members.show', compact('member'));
            return back()->with('error', 'العضو غير موجود.');
        } catch (\Throwable $th) {
            return back()->with('error', 'لا توجد بيانات.');
        }
    }


    public function edit(string $id)
    {
        try {
            $member = Member::where('members.organization_id', Auth::user()->organization->id)->where('members.id', $id)->first();
            if ($member != null) {
                return view('members.edit', compact('member'));
            }
            return back()->with('error', 'حصل خطأ عند تحديث بيانات العضو.');
        } catch (\Throwable $th) {
            return back()->with('error', 'خطأ. العضو غير موجود');
        }
    }

    public function update(Request $request, string $id)
    {
        try {
            $this->validate($request, [
                'name' => 'required',
                'username' => 'required',
                'password' => 'required',
                'email' => 'required',
                'job_title' => 'required',
            ]);
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
            // return back()->with('error', 'خطأ في إدخال البيانات');
        }
        $member = Member::where('members.organization_id', Auth::user()->organization->id)->where('id', $id)->first();
        $user = User::find($member->user_id);
        try {
            if ($member != null && $user != null) {
                $member->update($request->only('job_title'));
                $user->update($request->except('job_title'));
                return redirect()->route('members.index')->with('success', 'تم تحديث العضو بنجاح');
            }
            return back()->with('error', 'لم تتم عملية تحديث البيانات');
        } catch (\Throwable $th) {
            return back()->with('error', 'حصل خطأ في تحديث البيانات');
            //throw $th;
        }
    }


    public function destroy(string $id)
    {
        $member = Member::where('members.organization_id', Auth::user()->organization->id)->where('id', $id)->first();
        if ($member === null)
            return redirect()->route('members.index')->with('error', 'خطأ لم يتم الحذف. العضو غير موجود');
        try {
            $user = User::find($member->user_id);
            $user->delete();
            // $member->delete();
            return redirect()->route('members.index')->with('success', 'تم الحذف بنجاح.');
        } catch (\Throwable $th) {
            return back()->with('error', 'حصل خطأ لم تتم عملية الحذف.');
            //throw $th;
        }
    }
}
