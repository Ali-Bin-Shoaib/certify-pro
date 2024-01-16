<?php

namespace App\Http\Controllers;

use App\Models\Organization;
use App\Models\Participant;
use App\Models\Program;
use App\Models\ProgramParticipant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Mpdf\Mpdf;
use SimpleSoftwareIO\QrCode\Facades\QrCode;



class CertificateController extends Controller
{
    public function certificateGenerate(Request $request, string $programId, string $participantId)
    {
        $program = Program::join('members', 'programs.member_id', 'members.id')
            ->where('members.organization_id', Auth::user()->member->organization_id)
            ->where('programs.id', $programId)
            ->get('programs.*')
            ->first();
        // $program = Program::find($programId);
        $organization = Organization::find(Auth::user()->member->organization_id);
        $participant = Participant::join('members', 'participants.member_id', 'members.id')
            ->where('members.organization_id', Auth::user()->member->organization_id)
            ->where('participants.id', $participantId)
            ->get('participants.*')
            ->first();
        if (!$program || !$organization || !$participant)
            return redirect()->back()->with('error', 'خطأ. الدورة غير موجودة.');

        $document = new Mpdf([
            'mode' => 'utf-8',
            'format' => 'A4-L',
            'margin_left' => 30,
            'margin_right' => 30,
            'margin_top' => 40,
            'margin_bottom' => 0,
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
        if ($content == null) return back()->with('error', 'لا توجد ملفات الشهادة. يجب رفع الملفات أولا');
        $content = $this->replaceTokensWithValues($content, [
            $participant->name,
            $organization->user->name,
            $program->title, $program->location,
            date('Y/m/d ', strtotime($program->start_date)),
            date('Y/m/d ', strtotime($program->end_date)), '', ''

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
        if ($certificateId === null && $request->input("certificate_id") === null)
            return view("certificates.verify");

        try {
            $certificateId = $certificateId ? $certificateId : $request->validate(["certificate_id" => 'required|string']);
        } catch (\Throwable $th) {
            return back()->with('error', 'أدخل رقم شهادة للّتحقّق من أصالتها.');
        }
        try {
            $certificate = ProgramParticipant::where('certificate_id', $certificateId)->first();
            $participant = Participant::find($certificate->participant->id);
            $program = Program::find($certificate->program->id);
            if ($certificate && $program && $program)
                return view('certificates.certified', compact(['program', 'participant', 'certificate']));
            else
                return view('certificates.uncertified');
        } catch (\Throwable $th) {
            //throw $th;
            return back()->with('error', 'حصل خطأ في جلب بيانات الشهادة .');
        }
    }

    public function replaceTokensWithValues(string $content, array $values): string
    {
        $tokens = ['{اسم_المشارك}', '{اسم_المنظمة}', '{اسم_الدورة}', '{الموقع}', '{تاريخ_البداية}', '{تاريخ_النهاية}', '{التوقيع}', '{QR}'];
        if (isset($values))
            foreach ($tokens as $key => $token) {
                $content = str_replace($token, $values[$key], $content);
            }
        else
            foreach ($tokens as $token) {
                $content = str_replace($token, '', $content);
            }
        return $content;
    }
}
