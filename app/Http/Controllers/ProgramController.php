<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Member;
use App\Models\Program;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProgramController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $programs = Program::all()->sortDesc();

        $programs = Program::join('members', 'member_id', 'members.id')
            ->where('organization_id', Auth::user()->member->organization_id)
            ->get(['programs.*']);
        // $programs = Program::all()->orderBy('created_at', 'desc');

        // dd($programs[0]->member->user);
        return view('programs.index', compact('programs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('programs.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $this->validate($request, [
                'title' => 'required',
                'category_id' => 'required',
                'location' => 'required',
                'start_date' => 'required',
                'end_date' => 'required',
            ]);
            $newProgram = $request->all();
            $newProgram['member_id'] = Auth::user()->member->id;
            Program::create($newProgram);
            return redirect()->route('programs.index')->with('success', 'program is created successfully');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        // $program = Program::join('members', 'member_id', 'members.id')
        //     ->where('organization_id', Auth::user()->member->organization_id)
        //     ->where('programs.id', $id)->with('participants')->first(); //->get('programs.*');
        $program = Program::find($id);
        // dd($program->participants);
        if (!$program)
            return back()->with('error', 'الدورة غير موجودة.');
        return view('programs.show', compact('program'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $program = Program::find($id);
        $categories = Category::all();
        return view('programs.edit', compact('program', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'title' => 'required',
            'category_id' => 'required',
            'location' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
        ]);
        $program = Program::find($id);
        // $toUpdate['member_id'] = Auth::user()->id ?? $program->member_id;;
        $program->update($request->all());
        return redirect()->route('programs.index')->with('success', 'program is updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $toDelete = Program::find($id);
        if ($toDelete != null) {
            if ($toDelete->delete()) {
                return redirect()->route('programs.index')->with('success', 'program deleted successfully.');
            } else {
                return redirect()->route('programs.index')->with('error', 'can\'t delete program with id ' . $id);
            }
        } else {
            return redirect()->route('programs.index')->with('error', 'program with id ' . $id . 'dose not exist.');
        }
    }
}
