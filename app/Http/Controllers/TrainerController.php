<?php

namespace App\Http\Controllers;

use App\Models\Trainer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TrainerController extends Controller
{

    public function index()
    {
        $trainers = Trainer::join("members", "member_id", "members.id")
            ->where("members.organization_id", Auth::user()->member->organization_id)
            ->get('trainers.*');
        return view("trainers.index", compact("trainers"));
    }


    public function create()
    {
        return view("trainers.create");
    }


    public function store(Request $request)
    {
        $request->validate([
            "name" => "required",
            'gender' => 'required', "phone" => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:9',
        ]);

        $trainer = $request->all();
        $trainer['member_id'] = Auth::user()->member->id;;
        Trainer::create($trainer);
        return redirect()->route('trainers.index')->with('success', 'تمت الإضافة بنجاح');
    }


    public function show(string $id)
    {

        $trainer = Trainer::find($id);
        return view('trainers.show', compact('trainer'));
    }


    public function edit(string $id)
    {
        $trainer = Trainer::find($id);
        return view('trainers.edit', compact('trainer'));
    }


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
