<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;
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
        $this->validate($request, [
            'username' => 'required',
            'password' => 'required',
        ]);
        $newMember = $request->all();
        $newMember['organization_id'] = 1;
        Member::create($newMember);
        return redirect()->route('members.index')->with('success', 'Member is created successfully');
        // }
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
            'username' => 'required',
            'password' => 'required',
        ]);
        $member = Member::find($id);
        if ($member != null) {
            $toUpdate = $request->all();
            $member->update($toUpdate);
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
