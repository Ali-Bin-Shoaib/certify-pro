<?php

namespace App\Http\Controllers;

use App\Models\Participant;
use Illuminate\Http\Request;

class ParticipantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $participants = Participant::all();
        return view("participants.index", compact("participants"));
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("participants.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        // try {
        $request->validate([
            "name" => "required",
            "email" => "required",
            'gender' => 'required',
            'phone' => 'required',
            // 'member_id' => 'required'
        ]);
        $participant=$request->all();
        $participant['member_id']=1;;
        Participant::create($participant);

        //     return 'ok';
        return redirect()->route('participants.index')->with('success', 'participant created successfully');
        // } catch (\Throwable $th) {
        //     throw $th;
        // }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
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
        //
    }
}
