<?php

namespace App\Http\Controllers;

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
        //show all programs
        $programs = Program::all();
        // foreach ($programs as $program) {
        //     $program->
        // }
        // dd($programs);
        return view('programs.index', compact('programs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('programs.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // try {
        $this->validate($request, [
            'title' => 'required',
            'category_id' => 'required',
            'location' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
        ]);
        $newProgram = $request->all();
        $newProgram['member_id'] = 1;
        Program::create($newProgram);
        return redirect()->route('programs.index')->with('success', 'program is created successfully');
        // } catch (\Throwable $th) {
        //     // throw $th;
        //      return 'error';
        // }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        // $program = Program::find($id);
        // return view('programs.show')->with('id', $id);
        return view('programs.show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        return view('programs.edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
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
