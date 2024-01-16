<?php

namespace App\Http\Controllers;

use App\Models\Program;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
// use Intervention\Image\Facades\Image;

class TemplateController extends Controller
{

    // public function resizeImage($image, $folderName, $fileName, $width = 1116, $height = 793)
    // {
    //     $newImage = Image::make($image->getRealPath());
    //     if ($newImage != null) {

    //         $newImage->resize($width, $height, function ($constraint) {
    //             $constraint->aspectRatio();
    //         });
    //         // $newImage->storeAs(($folderName), $fileName, 'public');
    //     }
    //     return $newImage;
    // }


    public function create(string $programId)
    {
        return view('templates.create', compact('programId'));
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

            // $image=::make($template->getRealPath());
            $templateName = 'template.' . $template->extension();
            $signature = $request->file('signature-image');
            $signatureName = 'signature.' . $template->extension();

            $text = $request->input('template-text');
            $textName = 'text.txt';

            $folderName = 'uploads/' . $program->id . '_' . $program->title;
            // $template=$this->resizeImage($template,$folderName,$templateName);
            // $signature=$this->resizeImage($signature,$folderName,$signatureName,200,103);
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


    public function show(string $programId)
    {
        //
    }


    public function edit(string $programId)
    {
        //
    }


    public function update(Request $request, string $programId)
    {
        //
    }


    public function destroy(string $programId)
    {
        //
    }
}
