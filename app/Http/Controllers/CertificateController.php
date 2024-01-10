<?php

namespace App\Http\Controllers;

use App\Models\Organization;
use App\Models\Program;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;
use Mpdf\Mpdf;
use SimpleSoftwareIO\QrCode\Facades\QrCode;



class CertificateController extends Controller
{
    public function generateCertificate(string $programId)
    {
        $program = Program::find($programId);
        $organization = Organization::find(Auth::user()->member->organization_id);
        if (!$program || !$organization)
            return redirect()->back()->with('error', 'خطأ. الدورة غير موجودة.');
        $document = new Mpdf([
            'mode' => 'utf-8',
            'format' => 'A4-L',
        ]);
        $url = "http://127.0.0.1:8000/verify/";
        $certificateId = uniqid();
        $qrCode = $this->generateQr($url, $certificateId);
        $document->WriteHTML(view('pdf.template', compact(['program', 'organization', 'qrCode', 'certificateId'])));
        return $document->Output();
    }
    public function previewCertificate(string $programId)
    {
        $program = Program::find($programId);
        $organization = Organization::find(Auth::user()->member->organization_id);
        if (!$program || !$organization)
            return redirect()->back()->with('error', 'خطأ. الدورة غير موجودة.');

        $url = "http://127.0.0.1:8000/verify/";
        $certificateId = uniqid();
        $qrCode = $this->generateQr($url, $certificateId);
        return view("pdf.preview", compact(["qrCode", "certificateId", "program", "organization"]));
    }
    public function generateQr(string $url, string $certificateId)
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
    public function verifyCertificate(string $certificateId = null)
    {
        if ($certificateId != null) {
            
        }
        return view("certificate.verify");
    }
}
