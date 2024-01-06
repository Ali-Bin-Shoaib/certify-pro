{{-- <nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand" href="/">certificate pro</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
            aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
                <a class="nav-link active" aria-current="page" href="{{ url('/') }}">Home</a>
                <a class="nav-link" href="{{ route('signup') }}">إنشاء حساب</a>
                <a class="nav-link" href="{{ route('login') }}">تسجيل الدخول</a>
                <a class="nav-link" href="{{ route('logout') }}">تسجيل الخروج</a>
                <a class="nav-link" href="{{url('/pdf')}}">generate pdf</a>
                <a class="nav-link" href="{{url('/ok')}}">view template</a>
            </div>
        </div>
    </div>
</nav> --}}

<!-- Navigation -->
<nav id="navbarExample" class="navbar navbar-expand-lg fixed-top navbar-light p-0 shadow-sm" aria-label="Main navigation">
    <div class="container">
        <!-- Image Logo -->

        {{-- <a class="navbar-brand" href="{{ route('home') }}">
            <img src="{{ asset('images/logo.ico') }}" alt="Logo" width="30" height="24"
                class="d-inline-block align-text-top">
            certify pro
        </a> --}}
        <!-- Text Logo - Use this if you don't have a graphic logo -->
        <ul class="navbar-nav ms-auto navbar-nav-scroll">
            <li class="nav-item">
                <a class="navbar-brand nav-link logo-text text-capitalize" href="{{ route('home') }}"> <img
                        src="{{ asset('favicon.ico') }}" alt="Logo" width="50" height="50"
                        class="d-inline-block align-text-top">
                    certify pro
                </a>
            </li>
        </ul>

        <button class="navbar-toggler p-0 border-0" type="button" id="navbarSideCollapse"
            aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="navbar-collapse offcanvas-collapse" id="navbarsExampleDefault">
            <ul class="navbar-nav ms-auto navbar-nav-scroll">
                {{-- <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="{{ route('home') }}">الصفحة الرئيسية</a>
                </li> --}}
                @auth
                    @if (Auth::user()->role === 'organization')
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('members.index') }}">الأعضاء</a>
                        </li>
                    @endif
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('programs.index') }}">الدورات</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('participants.index') }}">المشاركين</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('trainers.index') }}">المدربين</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('categories.index') }}">التصنيفات</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('pdf') }}">توليد الشهادة</a>
                    </li>
                @endauth
                {{-- <li class="nav-item">
                    <a class="nav-link" href="{{ route('verifiy') }}">التحقق من الشهادة</a>
                </li> --}}

                {{-- <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-bs-toggle="dropdown" aria-expanded="false">Drop</a>
                        <ul class="dropdown-menu" aria-labelledby="dropdown01">
                            <li><a class="dropdown-item" href="article.html">Article Details</a></li>
                            <li><div class="dropdown-divider"></div></li>
                            <li><a class="dropdown-item" href="terms.html">Terms Conditions</a></li>
                            <li><div class="dropdown-divider"></div></li>
                            <li><a class="dropdown-item" href="privacy.html">Privacy Policy</a></li>
                        </ul>
                    </li> --}}
            </ul>
            <div class="nav-item ms-3 py-1">
                <div><b>الاسم: {{ Auth::user()->name }}</b></div>
                <div>نوع الحساب: {{ Auth::user()->role }}</div>
            </div>
            <span class="nav-item">

                @guest

                    <a class="btn-solid-sm d-flex align-items-center justifiy-content-center gap-1"
                        href="{{ route('login') }}">تسجيل الدخول <i class="bi bi-box-arrow-in-right fs-5"></i></a>
                @else
                    <a class="btn-solid-sm d-flex align-items-center justifiy-content-center gap-1"
                        href="{{ route('logout') }}">تسجيل الخروج <i class="bi bi-box-arrow-in-left fs-5"></i></a>
                @endguest
            </span>
        </div> <!-- end of navbar-collapse -->
    </div> <!-- end of container -->
</nav> <!-- end of navbar -->
<!-- end of navigation -->
{{-- @if ($errors)
    <div class="position-absolute top-0  end-0   alert alet-danger"style='z-index:100000'>
        <ul style='z-index:100001'>
            @foreach ($errors as $error)
                <li style='z-index:100002'>{{ $error }}</li>
            @endforeach
        </ul>
    </div>


@endif

<script>
    setTimeout(() => {
        alert = document.querySelector('div. alert')
        alert.remove();
    }, 10000);
</script> --}}
