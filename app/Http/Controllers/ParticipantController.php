<?php

namespace App\Http\Controllers;

use App\Models\Participant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $request->validate([
            "name" => "required",
            "email" => "required",
            'gender' => 'required',
            'phone' => 'required',
        ]);
        $participant = $request->all();
        $participant['member_id'] = Auth::user()->member->id;;
        Participant::create($participant);
        return redirect()->route('participants.index')->with('success', 'تمت الإضافة بنجاح');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

        $participant = Participant::find($id);
        return view('participants.show', compact('participant'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $participant = Participant::find($id);
        return view('participants.edit', compact('participant'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            "name" => "required",
            "email" => "required",
            'gender' => 'required',
            'phone' => 'required',
        ]);
        $participant = Participant::find($id);
        if ($participant) {
            $participant->update($request->all());
            return redirect()->route('participants.index')->with('success', 'تم تحديث البيانات بنجاح');
        }
        return back()->with('error', 'لم تتم علمية تحديث بيانات المشارك ');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $participant = Participant::find($id);
        if ($participant) {
            $participant->delete();
            return redirect()->route('participants.index')->with('success', 'تم حذف البيانات بنجاح');
        }
        return back()->with('error', 'عملية الحذف فشلت. لا يمكن العثور على بيانات المشارك ');
    }
}
