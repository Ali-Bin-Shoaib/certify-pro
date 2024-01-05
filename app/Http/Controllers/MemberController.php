<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\VarDumper\VarDumper;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $members = Member::all();
        return view('members.index', compact('members'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('members.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $check = $this->validate($request, [
                'name' => 'required',
                'username' => 'required|unique:users,username',
                'email' => 'required|email|unique:users,email',
                'job_title' => 'required',
                'password' => 'required',
                // 'organization_id' => 'required',
            ]);
            // dd($check);
            $newUser = $request->except('job_title');
            $newUser['role'] = 'member';
            $createdUser = User::create($newUser);
            $newMember = $request->only('job_title');
            $newMember['organization_id'] = Auth::user()->id ?? 1;
            $newMember['user_id'] = $createdUser->id;
            Member::create($newMember);
            return redirect()->route('members.index')->with('success', 'Member is created successfully');
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $member = Member::find($id);
        if ($member != null)
            return view('members.show', compact('member'));
        return 'not found';
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $member = Member::find($id);
        if ($member != null) {
            return view('members.edit', compact('member'));
        }
        return 'not found';
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $this->validate($request, [
            'name' => 'required',
            'username' => 'required',
            'password' => 'required',
            'email' => 'required',
            'job_title' => 'required',
        ]);
        $member = Member::find($id);
        $user = User::find($member->user_id);
        // VarDumper::dump([$user, $member]);
        if ($member != null && $user != null) {

            $member->update($request->only('job_title'));
            $user->update($request->except('job_title'));
            return redirect()->route('members.index')->with('success', 'Member is updated successfully');
        }
        return 'member not found';
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $toDelete = Member::find($id);
        if ($toDelete != null) {
            if ($toDelete->delete()) {
                return redirect()->route('members.index')->with('success', 'Member deleted successfully.');
            } else {
                return redirect()->route('members.index')->with('error', 'Can\'t delete program with id ' . $id);
            }
        }
        return redirect()->route('members.index')->with('error', 'program with id ' . $id . 'dose not exist.');
        // return 'error';
    }
}
