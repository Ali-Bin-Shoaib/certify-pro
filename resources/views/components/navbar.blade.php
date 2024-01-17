<nav id="navbarExample" class="navbar navbar-expand-lg fixed-top navbar-light p-0 py-3 shadow-sm "
    aria-label="Main navigation">
    <div class="container-fluid mx-5 px-5">
        <!-- Image Logo -->

        {{-- <a class="navbar-brand" href="{{ route('home') }}">
            <img src="{{ asset('images/logo.ico') }}" alt="Logo" width="30" height="24"
                class="d-inline-block align-text-top">
            certify pro
        </a> --}}
        <!-- Text Logo - Use this if you don't have a graphic logo -->
        <ul class="navbar-nav ms-auto navbar-nav-scroll">
            <li class="nav-item">
                <a class="navbar-brand nav-link logo-text text-capitalize m-0 px-0 d-flex flex-row align-items-center justify-content-center"
                    href="{{ route('home') }}"> <img src="{{ asset('favicon.ico') }}" alt="Logo" width="60"
                        height="60" class="d-inline-block align-text-top">
                    {{ config('app.name') }}
                </a>
            </li>
        </ul>

        <button class="navbar-toggler p-0 border-0 z-index-3" type="button" id="navbarSideCollapse"
            aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="navbar-collapse offcanvas-collapse fs-6" id="navbarsExampleDefault">
            <ul class="navbar-nav ms-auto navbar-nav-scroll">
                {{-- <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="{{ route('home') }}">الصفحة الرئيسية</a>
                </li> --}}
                @auth
                    @if (Auth::user()->role === 'organization' || Auth::user()->role == 'admin')
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('members.index') }}">الأعضاء</a>
                        </li>
                    @elseif (Auth::user()->role == 'member' || Auth::user()->role == 'admin')
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

                        {{-- <li class="nav-item">
                            <a class="nav-link" href="{{ route('pdf') }}">توليد الشهادة</a>
                        </li> --}}
                    @endif
                @endauth
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('certificateVerify') }}">تحقّق من شهادة</a>
                </li>
            </ul>
        </div> <!-- end of navbar-collapse -->
        @auth

            {{-- < class="nav-item ms-3 py-1"> --}}
            @if (Auth::user()->role === 'organization')
                <div class="btn-group">
                    <button type="button" class="btn-solid-sm dropdown-toggle" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        {{ Auth::user()->name }}
                    </button>
                    <ul class="dropdown-menu">
                        <li>
                            <a class="dropdown-item"
                                href="{{ route('organization.edit', Auth::user()->organization->id) }}">تعديل البانات</a>
                        </li>
                        <li> <a class="dropdown-item d-flex align-items-center justifiy-content-center gap-1 ms-0 "
                                href="{{ route('logout') }}">تسجيل الخروج <i class="bi bi-box-arrow-in-left fs-5"></i></a>
                        </li>


                    </ul>
                </div>
            @endif
            {{-- <div>نوع الحساب: {{ Auth::user()->role }}</div>
                <div><b>الاسم: {{ Auth::user()->name }}</b></div> --}}

        @endauth
        <span class="nav-item">

            @if (!str_contains(url()->current(), 'login'))
                @guest

                    <a class="btn-solid-sm d-flex align-items-center justifiy-content-center gap-1 ms-0 "
                        href="{{ route('login') }}">تسجيل الدخول <i class="bi bi-box-arrow-in-right fs-5"></i></a>
                @else
                    @if (Auth::user()->role == 'member')
                        <a class="btn-solid-sm d-flex align-items-center justifiy-content-center gap-1 ms-0 "
                            href="{{ route('logout') }}">تسجيل الخروج <i class="bi bi-box-arrow-in-left fs-5"></i></a>
                    @endif
                @endguest
            @endif
        </span>
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
