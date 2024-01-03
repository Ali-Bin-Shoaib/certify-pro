<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title> certificate</title>
</head>
<style>
    .margin {
        margin-right: 40rem;
    }

    body,
    body * {
        /* font-family: 'Tajawal' */
        direction: rtl;

    }
</style>

<body style="background-image: url('{{ public_path('images/star-template.png') }}')">

    {{-- <body style="background-image: url('{{ asset('images/star-template.jpg') }}')"> --}}
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    {{-- <h1 style="direction:rtl; font-family:Cairo,Tajawal;">شهادة مشاركة</h1> --}}
    <h1 style=" font-family:Tajawal;" class="margin">شهادة مشاركة</h1>

    <p style="width:50%; font-size: 1.5em;font-family:Tajawal" class="margin">
        تشهد مؤسسة حضرموت - تنمية بشرية بأن <strong>{{ $name }}</strong> قد شارك في دورة ريادة الأعمال في تاريخ
        {{ date('d-m-Y') }}.
    </p>
    {{-- <img src="{{ public_path('images/star-template.jpg') }}" width="700px" height="700px" alt="{{ $name }}"> --}}


</body>


</html>
