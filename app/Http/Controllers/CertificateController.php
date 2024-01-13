<?php

namespace App\Http\Controllers;

use App\Models\Organization;
use App\Models\Participant;
use App\Models\Program;
use App\Models\ProgramParticipant;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
            'margin_left' => 0,
            'margin_right' => 0,
            'margin_top' => 20,
            'margin_bottom' => 0,
        ]);
        $url = "http://127.0.0.1:8000/certificate-verify/";
        try {
            $certificate = ProgramParticipant::where("program_id", $programId)
                ->where('participant_id', $participantId)
                ->first();
            $certificateId = $certificate->certificate_id;
            if ($certificateId !== null) {
                $certificate->update(['updated_at' => now()]);
                // $request->session()->put('success', 'تم إصدار الشهادة مرة أخرى');
            } else {
                $certificate->update([
                    'certificate_id' => uniqid(),
                    'created_by' => Auth::user()->member->id,
                    'created_at' => now(),
                ]);
            }
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
        $qrCode = $this->qrGenerate($url, $certificateId);
        $document->WriteHTML(view('certificates.template', compact(
            ['program', 'organization', 'qrCode', 'participantId','certificateId']
        )));
        return $document->Output();
    }
    public function certificatePreview(string $programId, string $participantId)
    {
        $program = Program::find($programId);
        $organization = Organization::find(Auth::user()->member->organization_id);
        $participant = Participant::find($participantId);

        if (!$program || !$organization || !$participant)
            return redirect()->back()->with('error', 'خطأ. الدورة غير موجودة.');
        $url = "http://127.0.0.1:8000/verify/";
        $certificateId = uniqid();
        $qrCode = $this->qrGenerate($url, $certificateId);
        return view("certificates.preview", compact(["qrCode", "program", "organization", 'participantId']));
    }
    public function qrGenerate(string $url, string $certificateId)
    {
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
                    // dd($certificate);
                    $participant = Participant::find($certificate->participant->id);
                    $program = Program::find($certificate->program->id);
                    if ($certificate && $program && $program)
                        return view('certificates.certified', compact(['program', 'participant', 'certificate']));
                    else
                        return view('certificates.uncertified');
                } catch (\Throwable $th) {
                    //throw $th;
                    return view('certificates.uncertified')->with('error', 'حصل خطأ في جلب بيانات الشهادة .');

                    // return redirect()->back()->with('error', $th->getMessage());
                    // return redirect()->back()->with('error', 'error : ' . $th->getMessage());
                }
    }
}
