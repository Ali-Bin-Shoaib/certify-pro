<?php

namespace App\Http\Controllers;

use App\Imports\ParticipantImport;
use App\Imports\ParticipantsImport;
use App\Models\Program;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Imports\UsersImport;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Validators\Failure;
use Symfony\Component\VarDumper\VarDumper;

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
            return back()->withErrors('error', 'أبعاد صورة قالب الشهادة أو التوقيع أكبر من المطلوب. \n يرجي تعديل أبعاد الصورة.');
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
        try {
            $request->validate([
                'file' => 'required|mimes:xlsx, csv, xls, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
            ]);
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }

        try {
            $import = new ParticipantsImport($programId);
            $import->import($request->file);
            // dd($import);
            $failures = $import->failures();
            if ($failures->count() > 0) {
                $errorMsg = $this->getErrorMsg($failures);
                // dd($errorMsg);
                return back()->with('error', $errorMsg);
            }            // Excel::import(new ParticipantsImport($programId), $request->file('file'));
            //    dd($data);
            return redirect()->back()->with('success', 'تم حفظ بيانات المشاركين.');
        } catch (\Throwable $th) {
            // return back()->with('error', 'توجد مشكلة في بعض الصفوف إما الحقول المطلوبة فارغة أو موجودة مسبقا.');
            return back()->with('error', $th->getMessage());
        }
    }
    private function getErrorMsg(Collection|Failure|array $failures)
    {
        $errors = [];
        $errorMsg = 'لم تتم إضافة بعض المشاركين. توجد مشكلة في الصفوف التالية:: ';
        $rows = [];
        foreach ($failures as $failure) {
            $flag = false;
            foreach ($failure->values() as  $value) {
                if ($value != null) {
                    $flag = true;
                    break;
                }
            }
            if ($flag)
                $errors[] = [
                    'row' => $failure->row(), 'attribute' => $failure->attribute()
                ];
        }

        $resultArray = [];

        foreach ($errors as $error) {
            $attribute = $error['attribute'];
            $row = $error['row'];
            if (!isset($resultArray[$attribute])) {
                $resultArray[$attribute] = [];
            }
            $resultArray[$attribute][] = $row;
            $errorMsg .= ' ' . $row . ', ';
        }
        //to show what rows have a problem in what column "name, email, gender, phone"
        // foreach ($resultArray as $key => $value) {
        //     // if ($key)
        //         // $errorMsg .= $key .' ' . implode(', ', $value) . '\n';
        //         $errorMsg .=  implode(', ', $value) . ' ';
        // }
        return $errorMsg;
    }
}
