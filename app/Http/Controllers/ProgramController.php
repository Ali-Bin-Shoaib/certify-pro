<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Member;
use App\Models\Program;
use App\Models\Trainer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProgramController extends Controller
{

    public function index()
    {
        $programs = Program::join('members', 'programs.member_id', 'members.id')
            ->where('members.organization_id', Auth::user()->member->organization_id)
            ->select('programs.*')
            ->paginate(10);
        return view('programs.index', compact('programs'));
    }


    public function create()
    {
        $categories = Category::join('members', 'categories.member_id', 'members.id')
            ->where('members.organization_id', Auth::user()->member->organization_id)
            ->get('categories.*');
        $trainers = Trainer::join('members', 'members.id', 'trainers.member_id')
            ->where('members.organization_id', Auth::user()->member->organization_id)
            ->get('trainers.*');

        return view('programs.create', compact('categories', 'trainers'));
    }


    public function store(Request $request)
    {
        $trainer = null;
        try {
            if (!$request->has('selectedTrainer')) {
                $this->validate($request, [
                    //program data
                    'title' => 'required',
                    'category_id' => 'nullable',
                    'location' => 'required',
                    'start_date' => 'required',
                    'end_date' => 'required',
                    //trainer data
                    'name' => 'required',
                    'gender' => 'required',
                    'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:9',
                ]);
            } else {
                $this->validate($request, [
                    'title' => 'required',
                    'category_id' => 'nullable',
                    'location' => 'required',
                    'start_date' => 'required',
                    'end_date' => 'required',
                    'selectedTrainer' => 'required',
                ]);
                $trainer = Trainer::join('members', 'trainers.member_id', 'members.id')
                    ->where('members.organization_id', Auth::user()->member->organization_id)
                    ->get('trainers.*')
                    ->first();
            }
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }

        $newProgram = $request->only(['title', 'category_id', 'location', 'start_date', 'end_date']);
        $newProgram['member_id'] = Auth::user()->member->id;
        $program = Program::create($newProgram);
        // dd($trainer);
        if (!$trainer) {
            $newTrainer = $request->only(['name', 'gender', 'phone']);
            $newTrainer['member_id'] = Auth::user()->member->id;
            $trainer = Trainer::create($newTrainer);
        }        // dd($request->all(), $newTrainer);
        if ($program && $trainer) {
            $program->trainers()->attach($trainer);
            return redirect()->route('programs.index')->with('success', 'تم إضافة معلومات الدورة بنجاح');
        } else
            return back()->with('error', 'حصل خطأ. فشلت العملية');
    }


    public function show(string $id)
    {
        //
        $program = Program::join('members', 'member_id', 'members.id')
            ->where('organization_id', Auth::user()->member->organization_id)
            ->where('programs.id', $id)
            ->get('programs.*')
            ->first();

        if (!$program) {
            return back()->with('error', 'الدورة غير موجودة.');
        }
        $participants = $program->participants()->paginate(10);
        return view('programs.show', compact('program', 'participants'));
    }


    public function edit(string $id)
    {
        $program = Program::join('members', 'member_id', 'members.id')
            ->where('organization_id', Auth::user()->member->organization_id)
            ->where('programs.id', $id)
            ->get('programs.*')
            ->first();
        $categories = Category::join('members', 'categories.member_id', 'members.id')
            ->where('members.organization_id', Auth::user()->member->organization_id)
            ->get('categories.*');

        return view('programs.edit', compact('program', 'categories'));
    }


    public function update(Request $request, string $id)
    {
        try {
            $this->validate($request, [
                'title' => 'required',
                'category_id' => 'nullable',
                'location' => 'required',
                'start_date' => 'required',
                'end_date' => 'required',
            ]);
        } catch (\Throwable $th) {
            //throw $th;
            return back()->with('error', $th->getMessage());
        }
        try {
            $program = Program::join('members', 'member_id', 'members.id')
                ->where('organization_id', Auth::user()->member->organization_id)
                ->where('programs.id', $id)
                ->get('programs.*')
                ->first();
            // $toUpdate['member_id'] = Auth::user()->id ?? $program->member_id;;
            $program->update($request->all());
            return redirect()->route('programs.index')->with('success', 'تم تحديث البيانات بنجاح');
        } catch (\Throwable $th) {
            //throw $th;
            return back()->with('error', 'حصل خطأ عند تعديل البيانات.');
        }
    }


    public function destroy(string $id)
    {
        $program = Program::join('members', 'member_id', 'members.id')
            ->where('organization_id', Auth::user()->member->organization_id)
            ->where('programs.id', $id)
            ->get('programs.*')
            ->first();
        if ($program != null) {
            if ($program->delete()) {
                return redirect()->route('programs.index')->with('success', 'تم الحذف بنجاح.');
            } else {
                return redirect()->route('programs.index')->with('error', 'لم تتم عملية الحذف.');
            }
        } else {
            return redirect()->route('programs.index')->with('error', 'لم تتم عملية الحذف الدورة غير موجودة');
        }
    }
}
