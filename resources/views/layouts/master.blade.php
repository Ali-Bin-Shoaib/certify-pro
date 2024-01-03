<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <!-- SEO Meta Tags -->
    <meta name="description"
        content="auto generate certification based on program info, participants info, and certification template, and signature">
    <meta name="author" content="Ali hossain ali bin shoaib">

    <!-- OG Meta Tags to improve the way the post looks when you share the page on Facebook, Twitter, LinkedIn -->
    <meta property="og:site_name" content="Certificate Pro" /> <!-- website name -->
    <meta property="og:site" content="" /> <!-- website link -->
    <meta property="og:title" content="Certificate Pro" /> <!-- title shown in the actual shared post -->
    <meta property="og:description"
        content="auto generate certification based on program info, participants info, and certification template, and signature" />
    <!-- description shown in the actual shared post -->
    {{-- <meta property="og:image" content="" /> <!-- image link, make sure it's jpg -->
    <meta property="og:url" content="" /> <!-- where do you want your post to link to -->
    <meta name="twitter:card" content="summary_large_image"> <!-- to have large image post format in Twitter --> --}}

    <link rel="stylesheet" href="{{ asset('bootstrap-5.3.2-dist/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('bootstrap-5.3.2-dist/css/bootstrap.rtl.css') }}">
    <link rel="stylesheet" href="{{ asset('bootstrap-icons/font/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('css/fontawesome-all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/swiper.css') }}">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link rel="stylesheet" href="{{ asset('css/myStyles.css') }}">

    <title>@yield('title', config('app.name'))</title>
</head>
<style>
    @font-face {
        font-family: "Tajawal";
        src: url("fonts/Tajawal/Tajawal-Regular.ttf");
        src: url("fonts/Tajawal/Tajawal-Regular.ttf") format("truetype"),
    }

    body,
    html {
        font-family: 'Tajawal', sans-serif;
        direction: rtl;
    }
</style>

<body data-bs-spy="scroll" data-bs-target="#navbarExample">
    @include('components.navbar')
    <main class="bg-gray">

        @yield('main')
    </main>
    @include('components.footer')
    <script src="{{ asset('bootstrap-5.3.2-dist/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('bootstrap-5.3.2-dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/swiper.min.js') }}"></script> <!-- Swiper for image and text sliders -->
    <script src="{{ asset('js/scripts.js') }}"></script> <!-- Custom scripts -->

</body>

</html>
