<?php

namespace App\Http\Controllers;

use App\Models\Program;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TemplateController extends Controller
{

    public function index()
    {
        //
    }


    public function create(string $programId)
    {
        return view('templates.create', compact('programId'));
    }


    public function store(Request $request, string $programId)
    {
        // dd($request->all(),$request->file('template-image'));

        try {
            $request->validate([
                'template-image' => 'required|image|mimes:jpeg,png,jpg,svg|max:2048',
                'signature-image' => 'required|image|mimes:jpeg,png,jpg,svg|max:2048',
            ]);
        } catch (\Throwable $th) {
            //throw $th;
            return back()->with('error', $th->getMessage());
        }
        $program = Program::find($programId);
        try {
            $template = $request->file('template-image');
            $templateName = 'template.' . $template->extension();

            $signature = $request->file('signature-image');
            $signatureName = 'signature.' . $template->extension();

            $folderName = 'uploads/' . $program->id . '_' . $program->title;
            if (is_dir(public_path('storage/' . $folderName)))
                Storage::deleteDirectory('public/' . $folderName);

            Storage::makeDirectory(($folderName));
            $template->storeAs(($folderName), $templateName, 'public');
            $signature->storeAs(($folderName), $signatureName, 'public');
            return redirect()->route('programs.show',  $program->id)->with('success', 'تم حفظ الملفات بنجاح');
            // $request->image->move(public_path('images'), $folderName);
        } catch (\Throwable $th) {
            //throw $th;
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
