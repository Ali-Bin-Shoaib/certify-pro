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
use Mpdf\Config\ConfigVariables;
use Mpdf\Config\FontVariables;

use SimpleSoftwareIO\QrCode\Facades\QrCode;



class CertificateController extends Controller
{
    public function certificateGenerate(Request $request, string $programId, string $participantId)
    {
                // Define the custom font directory
        $defaultConfig = (new ConfigVariables())->getDefaults();
        $fontDirs = $defaultConfig['fontDir'];

        // Point to your public/Fonts directory
        $customFontDir = base_path('public/fonts/Tajawal/'); // You can also use base_path('public/Fonts')

        // Merge with existing font directories
        $fontDirs = array_merge($fontDirs, [
            $customFontDir,
        ]);

        // Define the custom font data
        $defaultFontConfig = (new FontVariables())->getDefaults();
        $fontData = $defaultFontConfig['fontdata'];

        $fontData['tajawal'] = [ // Use a lowercase, unique name for your font
            'R' => 'Tajawal-Regular.ttf', // Adjust filename based on your actual files
            'B' => 'Tajawal-Bold.ttf',
            'I' => 'Tajawal-Light.ttf', // Assuming Light is italic equivalent for this example
                        'useOTL' => 0xFF, // This is the key line to enable OpenType font features
            'useKashida' => 75, // Adjust this value (0-100) for justification style

            // Add other styles as needed (e.g., 'BI' for bold-italic)
        ];

        // Initialize mPDF with optimized settings for better performance
        $document = new Mpdf([
            'mode' => 'utf-8',
            'format' => 'A4-L',
            'margin_left' => 30,
            'margin_right' => 30,
            'margin_top' => 40,
            'margin_bottom' => 0,
            'fontDir' => $fontDirs,
            'fontdata' => $fontData,
            'default_font' => 'tajawal',
            'tempDir' => storage_path('app/tmp'),
            'allow_charset_conversion' => false,
            'autoScriptToLang' => false,
            'autoLangToFont' => false,
            'useSubstitutions' => false,
            'simpleTables' => true,
            'packTableData' => true,
            'use_kwt' => true,
            'autoPadding' => true,
            'shrink_tables_to_fit' => 1,
            'keep_table_proportions' => true,
        ]);

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


        $url =  env('APP_URL') . '/certificate-verify/';
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
            $filePath = 'public/uploads/';
            $images = Storage::files($filePath . $program->id . '_' . $program->title);
            $templateImages = [];

            // Separate template and signature images
            $templateImage = null;
            $signatureImage = null;

            foreach ($images as $image) {
                // Get the full path to the image file
                $fullImagePath = Storage::path($image);
                if (str_contains($image, 'template.')) {
                    $templateImage = $fullImagePath;
                } elseif (str_contains($image, 'signature.')) {
                    $signatureImage = $fullImagePath;
                }
            }

            // Ensure we have the required images
            if (!$templateImage) {
                return back()->with('error', 'لا توجد صورة قالب الشهادة. يجب رفع الملفات أولا');
            }
            if (!$signatureImage) {
                return back()->with('error', 'لا توجد صورة التوقيع. يجب رفع الملفات أولا');
            }

            // Create array with proper structure: [0] = signature, [1] = template
            $templateImages = [$signatureImage, $templateImage];

            // Debug: Log image paths for troubleshooting
            \Log::info('Template Image Path: ' . $templateImage);
            \Log::info('Signature Image Path: ' . $signatureImage);

        } catch (\Throwable $th) {
            return back()->with('error', 'خطأ في قراءة ملفات الشهادة: ' . $th->getMessage());
        }
        $qrCode = $this->qrGenerate($url, $certificateId);
        $content = Storage::get($filePath . $program->id . '_' . $program->title . '/text.txt');
        if ($content == null) return back()->with('error', 'لا توجد ملفات الشهادة. يجب رفع الملفات أولا');
        $trainerName = $program->trainers[0]->name??'';
        $content = $this->replaceTokensWithValues($content, [
            $participant->name,
            $organization->user->name,
            $program->title,
            $program->location,
            date('Y/m/d ', strtotime($program->start_date)),
            date('Y/m/d ', strtotime($program->end_date)),
            '',
            '',

        ]);
        $document->WriteHTML(view('certificates.template', compact(
            ['program', 'organization', 'qrCode', 'participantId', 'certificateId', 'templateImages', 'content','trainerName']
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
        $qrValue = $url . $certificateId;

        try {
            // Generate QR code as SVG with optimized settings
            $generatedQrCode = (string) QrCode::size(80)
                ->color(51, 51, 51)
                ->format('svg')
                ->errorCorrection('M')
                ->margin(1)
                ->generate($qrValue);

            // Fix XML declaration for better compatibility
            $generatedQrCode = str_replace(
                "<?xml version=\"1.0\" encoding=\"UTF-8\"?>",
                "<xml version=\"1.0\" encoding=\"UTF-8\">",
                $generatedQrCode
            );

            return $generatedQrCode;
        } catch (\Throwable $th) {
            // Fallback: return a simple text representation
            return '<div style="text-align:center; font-size:12px; color:#333;">QR Code Error</div>';
        }
    }
    public function certificateVerify(Request $request, string|null $certificateId =null)
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
            $organization = Organization::join('members', 'organizations.id', 'members.organization_id')
                ->join('programs', 'programs.member_id', 'programs.member_id')
                ->where('programs.id', $program->id)
                ->get('organizations.*')->first();
            if ($certificate && $program && $organization && $certificate)
                return view('certificates.certified', compact(['program', 'participant', 'certificate', 'organization']));
            else
                return view('certificates.uncertified');
        } catch (\Throwable $th) {
            //throw $th;
            return back()->with('error', 'خطأ. لا يوجد شهادة بهذا الرقم.');
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
