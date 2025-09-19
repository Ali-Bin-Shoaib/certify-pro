<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title> قالب الشهادة</title>
</head>
<style>
    body,
    body * {
        font-family: 'tajawal';
        direction: rtl !important;
    }

    /* td,
    table,
    div,
    h1,
    small {
        border: 1px solid red;
    } */
    .bottom {
        position: absolute;
        bottom: 0;
    }

    .container {
        margin: auto;
        padding-top: 3rem;
        text-align: center
    }

    .certificate-header {
        font-size: 3rem;
        margin-bottom: 1rem;
    }

    .certificate-title {
        font-size: 2.5rem
    }

    .participant-name {
        font-size: 4rem;
        margin-top: 1rem;
        color: black;
    }

    .certificate-static-text {

        font-size: 2rem;
        margin: auto;
        margin-top: 1rem;
        width: 85%;
    }

    .program-title {
        text-decoration: underline;
        color: black;

    }

    body {
        width: 100%;
        height: 100%;
    }

    .table {

        width: 100%;
        margin-top: 3rem;
        text-align: center;
        vertical-align: bottom;
    }

    .p-bottom {
        position: absolute;
        bottom: 8rem;
    }

    .stamp-td,
    .signature-td {
        font-size: 2rem;

    }

    .stamp-td {
        width: 40%;
    }

    .qr-td {
        text-align: center;
        width: 20%;
        margin: auto;
    }

    .signature-td {
        width: 40%;
        background-repeat: no-repeat;
        background-position: 50% 100%;

    }

    /* .signature-img{
display: block;
    } */



    .certificate-qr {
        text-align: center;
    }

    .certificate-id {
        font-size: 0.8rem;
        position: absolute;
        bottom: 0;
        right: 1rem;
    }

    .border-top-dashed {
        border-top: 0.5px dashed #333;
    }
</style>


<body style="background-image: url('{{ isset($templateImages[1]) ? $templateImages[1] : '' }}');background-repeat:no-repeat; background-size: cover; margin: 0; padding: 0; box-sizing: border-box;">



    {{-- <div class="container"> --}}
    {!! $content !!}
    {{-- </div> --}}
    <div class="p-bottom">
        <table class="table ">
            <tr class="" style=" ">
                <td class="stamp-td ">
                    {{-- <small class="border-top-dashed">الختم</small> --}}
                </td>
                <td>
                    <div class="certificate-qr ">
                        {!! $qrCode !!}
                    </div>


                </td>
                <td class="signature-td  "
                    style="background-image: url('{{ isset($templateImages[0]) ? $templateImages[0] : '' }}');background-repeat:no-repeat; background-size: contain; background-position: center bottom;">
                    <small class="border-top-dashed">
                        {{ $trainerName ?? 'التوقيع' }}</small>
                </td>
            </tr>
        </table>
    </div>

    <div class="certificate-id">
        تم إصدار هذه الشهادة بواسطة certify pro . رقم التحقق {{ $certificateId }}
    </div>
</body>

{{-- <body style="background-image: url('{{ asset('images/star-template.jpg') }}')"> --}}
{{-- <h1 style="direction:rtl; font-family:Cairo,Tajawal;">شهادة مشاركة</h1> --}}
{{-- <h1 style=" font-family:Tajawal;" class="margin">شهادة مشاركة</h1>

    <p style="width:50%; font-size: 1.5em;font-family:Tajawal" class="margin">
        تشهد مؤسسة حضرموت - تنمية بشرية بأن <strong>{{ $name }}</strong> قد شارك في دورة ريادة الأعمال في تاريخ
        {{ date('d-m-Y') }}.
    </p> --}}
{{-- <img src="{{ public_path('images/star-template.jpg') }}" width="700px" height="700px" alt="{{ $name }}"> --}}


{{-- </body> --}}


</html>
{{-- <h1 style="text-align: center; ">شهادة مشاركة&nbsp;</h1><h2 style="text-align: center; "><font color="#5e6576"><span style="font-size: 16px; letter-spacing: normal;">تشهد مؤسسة حضرموت تنمية بشرية بأنّ</span></font></h2><h2 style="text-align: center; "><em> علي حسين بن شعيب</em></h2><p style="text-align: center;">&nbsp;قد شارك في دورة تطوير مهارات الشباب المقامة في مدينة حضرموت - المكلا - أبراج بن محفوظ&nbsp;</p><p style="text-align: center;">بتاريخ 2024-1-1 إلى 2024-6-6&nbsp;</p><p style="text-align: center;"><br></p><p style="text-align: left;">أ.هشام بن عطية</p><p style="text-align: center; "><br></p> --}}
