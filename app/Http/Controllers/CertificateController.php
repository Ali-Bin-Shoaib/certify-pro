<?php

namespace App\Http\Controllers;

use App\Models\Organization;
use App\Models\Participant;
use App\Models\Program;
use App\Models\ProgramParticipant;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\Unique;
use Mpdf\Mpdf;
use SimpleSoftwareIO\QrCode\Facades\QrCode;



class CertificateController extends Controller
{
    public function certificateGenerate(Request $request, string $programId, string $participantId)
    {
        $program = Program::find($programId);
        $organization = Organization::find(Auth::user()->member->organization_id);
        $participant = Participant::find($participantId);
        if (!$program || !$organization || !$participant)
            return redirect()->back()->with('error', 'خطأ. الدورة غير موجودة.');

        $document = new Mpdf([
            'mode' => 'utf-8',
            'format' => 'A4-L',
            'margin_left' => 20,
            'margin_right' => 20,
            'margin_top' => 40,
            'margin_bottom' => -100,
        ]);

        $url = "http://127.0.0.1:8000/certificate-verify/";

        try {
            $certificate = ProgramParticipant::where("program_id", $program->id)
                ->where('participant_id', $participant->id)
                ->first();

            $certificateId = $certificate->certificate_id;

            if ($certificateId != null) {
                $certificate->update(['updated_at' => now()]);

                // $request->session()->put('success', 'تم إصدار الشهادة مرة أخرى');
            } else {
                $certificate->update([
                    'certificate_id' => uniqid(),
                    'created_by' => Auth::user()->member->id,
                    'created_at' => now(),
                ]);

                $certificateId = $certificate->certificate_id;
            }
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
        try {
            $storage = 'public/uploads/';
            $images = Storage::files($storage . $program->id . '_' . $program->title);
            $templateImages = [];
            foreach ($images as $key => $image) {
                $templateImages[] = str_replace('public', 'storage', $image);
            }
        } catch (\Throwable $th) {
            //throw $th;
            return back()->with('error', $th->getMessage());
        }
        $qrCode = $this->qrGenerate($url, $certificateId);
        $content = Storage::get($storage . $program->id . '_' . $program->title . '/text.txt');
        $content = $this->replaceTokensWithValues($content, [
            '{اسم_المشارك}', '{اسم_المنظمة}', '{اسم_الدورة}', '{الموقع}', '{تاريخ_البدايةوالنهاية}', '{التوقيع}', '{QR}'
        ], [
            $participant->name,
            $organization->user->name,
            $program->title, $program->location,
            date('Y/m/d ', strtotime($program->start_date)) . 'إلى' . date('Y/m/d ', strtotime($program->end_date)),'', ''

        ]);
        $document->WriteHTML(view('certificates.template', compact(
            ['program', 'organization', 'qrCode', 'participantId', 'certificateId', 'templateImages', 'content']
        )));
        return $document->Output();
    }
    // public function certificatePreview(string $programId, string $participantId)
    // {
    //     $program = Program::find($programId);
    //     $organization = Organization::find(Auth::user()->member->organization_id);
    //     $participant = Participant::find($participantId);

    //     if (!$program || !$organization || !$participant)
    //         return redirect()->back()->with('error', 'خطأ. الدورة غير موجودة.');
    //     $url = "http://127.0.0.1:8000/verify/";
    //     $certificateId = uniqid();
    //     $qrCode = $this->qrGenerate($url, $certificateId);
    //     return view("certificates.preview", compact(["qrCode", "program", "organization", 'participantId']));
    // }
    public function qrGenerate(string $url, string $certificateId)
    {
        // dd($certificateId);
        $qrValue = $url . $certificateId;
        // QrCode::format('png');
        $generatedQrCode = (string) QrCode::size(100)->color(51, 51, 51)->generate($qrValue);
        $generatedQrCode = str_replace(
            "<?xml version=\"1.0\" encoding=\"UTF-8\"?>",
            "<xml version=\"1.0\" encoding=\"UTF-8\">",
            $generatedQrCode
        );
        return $generatedQrCode;
    }
    public function certificateVerify(Request $request, string $certificateId = null)
    {
        if ($certificateId === null)
            if ($request->input("certificate_id") === null)
                return view("certificates.verify");
            else
                try {
                    $certificateId = $request->validate(["certificate_id" => 'required|string']);
                    $certificate = ProgramParticipant::where('certificate_id', $certificateId)->first();
                    // dd($certificateId);
                    $participant = Participant::find($certificate->participant->id);
                    $program = Program::find($certificate->program->id);
                    if ($certificate && $program && $program)
                        return view('certificates.certified', compact(['program', 'participant', 'certificate']));
                    else
                        return view('certificates.uncertified');
                } catch (\Throwable $th) {
                    //throw $th;
                    return back()->with('error', 'حصل خطأ في جلب بيانات الشهادة .');

                    // return redirect()->back()->with('error', $th->getMessage());
                    // return redirect()->back()->with('error', 'error : ' . $th->getMessage());
                }
    }

    public function replaceTokensWithValues(string $content, array $tokens, array $values): string
    {
        foreach ($tokens as $key => $token) {
            $content = str_replace($token, $values[$key], $content);
        }
        return $content;
    }
}
