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
        font-family: 'Tajawal';
        direction: rtl !important;
    }

    /* td,
    table,
    div,
    h1,
    small {
        border: 1px solid red;
    } */

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

    .table {
        width: 100%;
        margin-top: 3rem;
        text-align: center;
        vertical-align: bottom;
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
    .certificate-id {
        font-size: 0.8rem;
        position: absolute;
        bottom: 0;
        right: 1rem;
    }



    .certificate-qr {
        text-align: center;
    }

    .border-top-dashed {
        border-top: 0.5px dashed #333;
    }
</style>


<body {{-- style="background-image: url('{{ public_path('images/test3.jpg') }}'); margin: 0; padding: 0; box-sizing: border-box;"> --}} {{-- style="background-image: url('{{public_path('storage/uploads/3_quia/template.jpg')}}'); margin: 0; padding: 0; box-sizing: border-box;"> --}}
    style="background-image: url('{{ public_path($templateImages[1]) }}'); margin: 0; padding: 0; box-sizing: border-box;">



    <div class="container">

        <h1 class="certificate-header">شهادة مشاركة
        </h1>
        <div class="certificate-title">تشهد {{ $organization->user->name }} بأنّ</div>
        <div class="participant-name">{{ $program->participants()->find($participantId)->name }}</div>
        <div class="certificate-static-text ">
            قد شارك في الدورة التدريبية <span class="program-title">{{ $program->title }}</span> في الفترة من<br>
            {{ date('d-m-Y ', strtotime($program->start_date)) }} إلى
            {{ date('d-m-Y', strtotime($program->end_date)) }} المقامة في {{ $program->location }}

        </div>
        <table class="table">
            <tr style="text-align: ">
                <td class="stamp-td">
                    {{-- <small class="border-top-dashed">الختم</small> --}}
                </td>
                <td>
                    <div class="certificate-qr">
                        {!! $qrCode !!}
                    </div>
                    {{-- <small class="certificate-id">
                        {{ $certificateId }}
                    </small> --}}

                </td>
                <td class="signature-td "
                    style="background-image: url('{{ public_path($templateImages[0]) }}');background-repeat:no-repeat;
">
                    {{-- <div
                        style="
                        background-image: url('{{ public_path('images/s1.png') }}');
                        background-repeat:no-repeat;
                        height:103px;
                        width:75%;
                        ">
                    </div> --}}
                    <small class="border-top-dashed">
                        التوقيع</small>
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


</body>


</html>
{{-- <h1 style="text-align: center; ">شهادة مشاركة&nbsp;</h1><h2 style="text-align: center; "><font color="#5e6576"><span style="font-size: 16px; letter-spacing: normal;">تشهد مؤسسة حضرموت تنمية بشرية بأنّ</span></font></h2><h2 style="text-align: center; "><em> علي حسين بن شعيب</em></h2><p style="text-align: center;">&nbsp;قد شارك في دورة تطوير مهارات الشباب المقامة في مدينة حضرموت - المكلا - أبراج بن محفوظ&nbsp;</p><p style="text-align: center;">بتاريخ 2024-1-1 إلى 2024-6-6&nbsp;</p><p style="text-align: center;"><br></p><p style="text-align: left;">أ.هشام بن عطية</p><p style="text-align: center; "><br></p> --}}
