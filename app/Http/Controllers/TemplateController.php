<?php

namespace App\Http\Controllers;

use App\Models\Program;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
// use Intervention\Image\Facades\Image;

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
                'template-image' => 'required|image|mimes:jpeg,png,jpg,svg|max:2048|dimensions:max_width=1125,max_height=800',
                'signature-image' => 'required|image|mimes:jpeg,png,jpg,svg|max:2048|dimensions:max_width=200,max_height=105',
                'template-text' => 'nullable'
            ]);
        } catch (\Throwable $th) {
            //throw $th;
            // return back()->with('error', $th->getMessage());
            return back()->with('error', 'أبعاد صورة قالب الشهادة أو التوقيع أكبر من المطلوب. \n يرجي تعديل أبعاد الصورة.');
        }
        $program = Program::find($programId);
        try {
            $template = $request->file('template-image');

            $templateName = 'template.' . $template->extension();
            $signature = $request->file('signature-image');
            $signatureName = 'signature.' . $template->extension();

            $text = $request->input('template-text');
            $textName = 'text.txt';

            $folderName = 'uploads/' . $program->id . '_' . $program->title;

            if (is_dir(public_path('storage/' . $folderName)))
                Storage::deleteDirectory('public/' . $folderName);

            Storage::makeDirectory(($folderName));
            $template->storeAs(($folderName), $templateName, 'public');
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
}
