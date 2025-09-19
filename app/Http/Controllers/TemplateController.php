<?php

namespace App\Http\Controllers;

use App\Imports\ParticipantImport;
use App\Imports\ParticipantsImport;
use App\Models\Program;
use App\Services\ImageService;
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
                'template-image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
                'signature-image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
                'template-text' => 'required'
            ]);
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }

        $program = Program::find($programId);
        $imageService = new ImageService();

        try {
            $folderName = 'uploads/' . $program->id . '_' . $program->title;
            // Clean up existing directory if it exists
            if (Storage::exists('public/' . $folderName)) {
                Storage::deleteDirectory('public/' . $folderName);
            }

            // Create the directory
            Storage::makeDirectory('public/' . $folderName);

            // Handle template image upload and resize
            if ($request->hasFile('template-image')) {
                $template = $request->file('template-image');
                $templateExtension = $template->getClientOriginalExtension();
                $templateName = 'template.' . $templateExtension;

                // Resize and save template image
                $imageService->resizeTemplateImage($template, $folderName, $templateName);
            }

            // Handle signature image upload and resize
            if ($request->hasFile('signature-image')) {
                $signature = $request->file('signature-image');
                $signatureExtension = $signature->getClientOriginalExtension();
                $signatureName = 'signature.' . $signatureExtension;

                // Resize and save signature image
                $imageService->resizeSignatureImage($signature, $folderName, $signatureName);
            }

            // Save template text
            $text = $request->input('template-text');
            $textName = 'text.txt';
            Storage::put('public/' . $folderName . '/' . $textName, $text);

            return redirect()->route('programs.show', $program->id)->with('success', 'تم حفظ الملفات بنجاح');

        } catch (\Throwable $th) {
            return back()->with('error', 'حدث خطأ أثناء حفظ الملفات: ' . $th->getMessage());
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
                'file' => 'required|mimes:xlsx,csv,xls,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet|max:2048'
            ]);
        } catch (\Throwable $th) {
            return back()->with('error', 'خطأ في التحقق من الملف: ' . $th->getMessage());
        }

        try {
            $import = new ParticipantsImport($programId);
            $import->import($request->file);

            $failures = $import->failures();
            $importedCount = $import->getImportedCount();

            \Log::info('Import completed. Imported count: ' . $importedCount . ', Failures: ' . $failures->count());

            if ($failures->count() > 0) {
                $errorMsg = $this->getErrorMsg($failures);
                return back()->with('error', 'تم استيراد ' . $importedCount . ' مشارك بنجاح، ولكن حدثت أخطاء في بعض الصفوف: ' . $errorMsg);
            }

            if ($importedCount > 0) {
                return redirect(route('programs.show', $programId))->with('success', 'تم استيراد ' . $importedCount . ' مشارك بنجاح.');
            } else {
                return back()->with('warning', 'لم يتم استيراد أي مشاركين. قد تكون جميع المشاركين موجودين مسبقاً في هذا البرنامج.');
            }
        } catch (\Throwable $th) {
            \Log::error('Import participants error: ' . $th->getMessage());
            return back()->with('error', 'حدث خطأ أثناء استيراد المشاركين: ' . $th->getMessage());
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
