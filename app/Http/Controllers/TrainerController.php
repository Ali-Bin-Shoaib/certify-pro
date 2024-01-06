<?php

namespace App\Http\Controllers;

use App\Models\Trainer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TrainerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $trainers = Trainer::all();
        return view("trainers.index", compact("trainers"));
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("trainers.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "name" => "required",
            'gender' => 'required',
            'phone' => 'required',
        ]);

        $trainer = $request->all();
        $trainer['member_id'] = Auth::user()->member->id;;
        Trainer::create($trainer);
        return redirect()->route('trainers.index')->with('success', 'تمت الإضافة بنجاح');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

        $trainer = Trainer::find($id);
        return view('trainers.show', compact('trainer'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $trainer = Trainer::find($id);
        return view('trainers.edit', compact('trainer'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            "name" => "required",
            'gender' => 'required',
            'phone' => 'required',
        ]);
        $trainer = Trainer::find($id);
        if ($trainer) {
            $trainer->update($request->all());
            return redirect()->route('trainers.index')->with('success', 'تم تحديث البيانات بنجاح');
        }
        return back()->with('error', 'لم تتم علمية تحديث بيانات المدرب ');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $trainer = Trainer::find($id);
        if ($trainer) {
            $trainer->delete();
            return redirect()->route('trainers.index')->with('success', 'تم حذف البيانات بنجاح');
        }
        return back()->with('error', 'عملية الحذف فشلت. لا يمكن العثور على بيانات المدرب ');
    }
}
