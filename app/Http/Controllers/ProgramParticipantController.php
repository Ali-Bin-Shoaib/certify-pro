<?php

namespace App\Http\Controllers;

use App\Models\Program;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProgramParticipantController extends Controller
{

    // public function index()
    // {
    // }

    public function create(Request $request, $id)
    {
        // $categories = Category::join('members', 'member_id', '=', 'members.id')
        // ->where('organization_id', '=', Auth::user()->member->organization_id)
        //     ->get(['categories.id', 'categories.title'])
        //     ->sortby('categories.created_at');

        $program = Program::join('members', 'member_id', 'members.id')
            ->where('organization_id', Auth::user()->member->organization_id)->first();
        if (!$program)
            return redirect()->back()->with('error', 'الدورة غير موجودة');
        return view('programParticipants.create');
    }


    public function store(Request $request)
    {
    }


    public function show(string $id)
    {
    }


    public function edit(string $id)
    {
    }


    public function update(Request $request, string $id)
    {
    }


    public function destroy(string $id)
    {
    }
}
