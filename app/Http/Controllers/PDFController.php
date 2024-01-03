<?php

namespace App\Http\Controllers;

use Mpdf\Mpdf;

class PDFController extends Controller
{
    public function previewPdf()
    {
        $name = 'علي حسين علي بن شعيب';
        $data = ['name' => $name];

        return view('pdf.template', $data);
    }
    public function generatePdf()
    {
        $name = 'علي حسين علي بن شعيب';
        $data = ['name' => $name];

        $document = new Mpdf([
            'mode' => 'utf-8',
            'format' => 'A4-L',
            'margin'=>100,
        ]);
        // $document->SetFont('Tajawal');
        $document->WriteHTML(view('pdf.template', $data));
        return $document->Output();
    }
    public function generateQRcode($value)
    {
    }
}
