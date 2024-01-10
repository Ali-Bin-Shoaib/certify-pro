<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title> استعراض الشهادة

    </title>
    <link rel="stylesheet" href="{{ asset('bootstrap-5.3.2-dist/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('bootstrap-5.3.2-dist/css/bootstrap.rtl.css') }}">
    <link rel="stylesheet" href="{{ asset('bootstrap-icons/font/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('fontawesome-free-6.5.1-web/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('fontawesome-free-6.5.1-web/css/brands.min.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/swiper.css') }}">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link rel="stylesheet" href="{{ asset('css/myStyles.css') }}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <link rel="stylesheet" href="{{ asset('css/preview.css') }}">
</head>
<style>
    .main-container {
        background-image: url("{{ asset('images/test3.jpg') }}");
        background-size: 100% 100%;
        background-repeat: no-repeat;
        position: relative;
        top: 8rem;
        width: 70%;
        /* background-repeat: no-repeat; */
        /* padding-top: 9rem; */
        /* width: 100vw; */
        /* height:100vh; */
        /* border:1px solid black; */
        /* border-left: 1px solid black !important; */
        margin: 0 auto 9rem;
        padding: 5rem;
    }

    .export-btn {
        position: absolute;
        right: -13rem;
        top: 5rem;

    }
</style>


<body>
    @include('components.navbar')

    <div class="main-container">
        <a href="{{ route('generateCertificate', ['programId' => $program->id]) }}"
            class="btn btn-primary rounded-5 text-decoration-none  export-btn">إصدار الشهادات</a>
        <h1 class="certificate-header">شهادة مشاركة
        </h1>
        <div class="certificate-title">تشهد {{ $organization->user->name }} بأن</div>
        <div class="participant-name">"اسم المشارك الرباعي"</div>
        <div class="certificate-static-text">
            قد شارك في دورة <span class="program-title">"عنوان الدورة"</span> في الفترة من<br>
            {{ date('d-m-Y ', strtotime($program->start_date)) }} إلى
            {{ date('d-m-Y', strtotime($program->end_date)) }} المقامة في "موقع إقامة الدورة".
        </div>
        <table class="table">
            <tr style="text-align: ">
                <td class="stamp-td"><small class="border-top-dashed">الختم</small></td>
                <td>
                    <div class="certificate-qr">
                        {!! $qrCode !!}
                    </div>
                    <small class="certificate-id">
                        {{ $certificateId }}
                    </small>

                </td>
                <td class="signature-td"><small class="border-top-dashed">التوقيع</small></td>
            </tr>
        </table>

    </div>
    @include('components.footer')

</body>


<script src="{{ asset('bootstrap-5.3.2-dist/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('bootstrap-5.3.2-dist/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('js/swiper.min.js') }}"></script> <!-- Swiper for image and text sliders -->
<script src="{{ asset('js/scripts.js') }}"></script> <!-- Custom scripts -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script>
    toastr.options = {
        "closeButton": true,
        "progressBar": true,
        'timeOut': 3000,
    }
    @if (Session::has('error'))

        toastr.error("{{ Session::get('error') }}");
    @elseif (Session::has('success'))

        toastr.success("{{ Session::get('success') }}");
    @elseif (Session::has('info'))

        toastr.info("{{ Session::get('info') }}");
    @elseif (Session::has('wrning'))

        toastr.warning("{{ Session::get('warning') }}");
    @endif
</script>



</html>
