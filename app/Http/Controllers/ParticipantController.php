<?php

namespace App\Http\Controllers;

use App\Models\Participant;
use App\Models\Program;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ParticipantController extends Controller
{

    public function index()
    {
        $participants = Participant::join('members', 'member_id', 'members.id')
            ->where('organization_id', Auth::user()->member->organization_id)
            ->get(['participants.*'])->sortby('participants.created_at');
        return view("participants.index", compact("participants"));
    }


    public function create(string $programId = null)
    {
        if ($programId) {
            $program = Program::join('members', 'member_id', 'members.id')
                ->where('organization_id', Auth::user()->member->organization_id)
                ->where('programs.id', $programId)
                ->get('programs.*')->first();
            if ($program)
                return view('Participants.create', compact('program'));

            return redirect()->back()->with('error', 'الدورة غير موجودة');
        }

        $programs = Program::join('members', 'member_id', 'members.id')
            ->where('organization_id', Auth::user()->member->organization_id)
            ->where('programs.end_date', '>=', now())
            ->get('programs.*');
        if ($programs->count() === 0)
            return back()->with('error', 'لا يوجد أي دورة متاحا حاليا. أضف دورة لإضافة مشاركين فيها..');
        return view("participants.create", compact("programs"));
    }


    public function store(Request $request, string $programId = null)
    {
        // dd($programId);
        try {
            $request->validate([
                "name" => "required",
                "email" => "required",
                'gender' => 'required',
                'phone' => 'required',
                'program_id' => $programId ? 'nullable' : 'required',
            ]);
            // dd($request->all());
            if (!$programId && $request->has('program_id'))
                $programId = $request->input('program_id');
            // $programId = $programId ? $programId : $request->input('program_id');
            if (!$programId)
                return redirect()->back()->with("error", "اختر دورة لإضافة مشارك إليها.");
            $program = Program::find($programId);
            if (!$program)
                return redirect()->back()->with("error", "الدورة غير موجودة.");


            $participant = $request->except(['program_id']);
            $participant['member_id'] = Auth::user()->member->id;
            $participant = Participant::updateOrCreate(['email' => $participant['email']], $participant);
            try {
                // dd();
                $program->participants()->attach($participant->id, ['created_at' => now(), 'updated_at' => now()]);
            } catch (\Throwable $th) {
                // return back()->with('error', $th->getMessage());
                return back()->with('error', ' المشارك مضاف مسبقا لهذه الدورة.');
            }

            return redirect()->route('programs.show', $program->id)->with('success', 'تمت الإضافة بنجاح');
        } catch (\Throwable $th) {
            return back()->with('error', 'بيانات غير صحيحة');
        }
    }


    public function show(string $id)
    {
        $participant = Participant::join('members', 'member_id', 'members.id')
            ->where('organization_id', Auth::user()->member->organization_id)
            ->where('participants.id', $id)
            ->get(['participants.*'])->first();

        // dd($participant);
        if (!$participant)
            return redirect()->back()->with('error', 'لا يمكن إيجاد هذا المشارك.');
        return view('participants.show', compact('participant'));
    }


    public function edit(string $id)
    {
        $participant = Participant::find($id);
        return view('participants.edit', compact('participant'));
    }


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
        return back()->with('error', 'لم تتم عملية تحديث البيانات ');
    }

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
