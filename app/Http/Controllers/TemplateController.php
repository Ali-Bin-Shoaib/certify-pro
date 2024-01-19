<?php

namespace App\Http\Controllers;

use App\Imports\ParticipantImport;
use App\Imports\ParticipantsImport;
use App\Models\Program;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Imports\UsersImport;
use Maatwebsite\Excel\Facades\Excel;

class TemplateController extends Controller
{
    public function create(string $programId)
    {
        $program = Program::join('members', 'member_id', 'members.id')
            ->where('organization_id', Auth::user()->member->organization_id)
            ->where('programs.id', $programId)
            ->get('programs.*')
            ->first();
        if ($program)
            return view('templates.create', compact('programId'));
        return back()->with('error', 'الدورة غير موجودة');
    }


    public function store(Request $request, string $programId)
    {
        try {
            $request->validate([
                'template-image' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:2048|dimensions:max_width=1125,max_height=800',
                'signature-image' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:2048|dimensions:max_width=200,max_height=105',
                'template-text' => 'required'
            ]);
        } catch (\Throwable $th) {
            //throw $th;
            // return back()->with('error', $th->getMessage());
            return back()->with('error', 'أبعاد صورة قالب الشهادة أو التوقيع أكبر من المطلوب. \n يرجي تعديل أبعاد الصورة.');
        }
        $program = Program::find($programId);
        try {
            if ($request->hasFile('template-image')) {
                $template = $request->file('template-image');
                $templateName = 'template.' . $template->extension();
            }
            if ($request->hasFile('signature-image')) {
                $signature = $request->file('signature-image');
                $signatureName = 'signature.' . $template->extension();
            }
            $text = $request->input('template-text');
            $textName = 'text.txt';

            $folderName = 'uploads/' . $program->id . '_' . $program->title;

            if (isset($template) && isset($signature) && is_dir(public_path('storage/' . $folderName)))
                Storage::deleteDirectory('public/' . $folderName);
            if (!Storage::exists(public_path('storage/' . $folderName)))
                Storage::makeDirectory(($folderName));
            if (isset($template))
                $template->storeAs(($folderName), $templateName, 'public');
            if (isset($signature))
                $signature->storeAs(($folderName), $signatureName, 'public');

            Storage::put('public/' . $folderName . '/' . $textName, $text);

            return redirect()->route('programs.show',  $program->id)->with('success', 'تم حفظ الملفات بنجاح');
            // $request->image->move(public_path('images'), $folderName);
        } catch (\Throwable $th) {
            //throw $th;
            return back()->with('error', $th->getMessage());
        }
    }
    public function destroy(Request $request, string $programId)
    {
    }
    public function importParticipantsForm(string $programId)
    {
        $program = Program::find($programId);
        return view('templates.import-participants', compact('program'));
    }
    public function importParticipants(Request $request, $programId)
    {
        // Program::query()->where('id',$programId)->all
        // Program::where('')
        try {
            $request->validate([
                'file' => 'required|mimes:xlsx, csv, xls, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
            ]);
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }

        // $data = Excel::import(new ParticipantsImport, request()->file('file'));
        // try {
        // dd($request->file('file'));
        try {
            Excel::import(new ParticipantsImport($programId), $request->file('file'));
            return redirect()->back()->with('success', 'تم حفظ بيانات المشاركين.');
        } catch (\Throwable $th) {
            //throw $th;
            return back()->with('error', 'توجد مشكلة في الملف . بعض الحقول مفقودة');
        }
        // dd($data);
        // } catch (\Throwable $th) {
        // return back()->with('error', $th->getMessage());
        // }
        // $data = Excel::import(new ParticipantsImport, $request->file('file'));
        // dd($data);

    }
}
