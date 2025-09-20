<nav id="navbarExample" class="navbar navbar-expand-lg fixed-top navbar-light p-0 py-3 shadow-sm"
    aria-label="Main navigation">
    <div class="container-fluid">
        <!-- Logo -->
        <a class="navbar-brand nav-link logo-text text-capitalize m-0 px-0 d-flex flex-row align-items-center"
            href="{{ route('home') }}">
            <img src="{{ asset('favicon.ico') }}" alt="Logo" width="40" height="40"
                class="d-inline-block align-text-top me-2">
            <span class="d-none d-sm-inline">{{ config('app.name') }}</span>
        </a>

        <!-- Mobile Menu Toggle -->
        <button class="navbar-toggler p-0 border-0 z-index-3" type="button" id="navbarSideCollapse"
            aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="navbar-collapse offcanvas-collapse fs-6" id="navbarsExampleDefault">
            <ul class="navbar-nav ms-auto navbar-nav-scroll">
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
                    @endif
                @endauth
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('certificateVerify') }}">تحقّق من شهادة</a>
                </li>
            </ul>
        </div> <!-- end of navbar-collapse -->
        <!-- User Actions -->
        <div class="d-flex align-items-center gap-2">
            @auth
                <div class="btn-group">
                    <button type="button" class="btn-solid-sm dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                        <span class="d-none d-sm-inline">{{ Auth::user()->name }}</span>
                        <span class="d-sm-none">{{ Str::limit(Auth::user()->name, 10) }}</span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end">
                        @if (Auth::user()->role === 'organization')
                            <li>
                                <a class="dropdown-item" href="{{ route('organization.edit', Auth::user()->organization->id) }}">
                                    <i class="fa fa-edit me-2"></i>تعديل البيانات
                                </a>
                            </li>
                        @endif
                        <li>
                            <a class="dropdown-item" href="{{ route('logout') }}">
                                <i class="fa fa-sign-out-alt me-2"></i>تسجيل الخروج
                            </a>
                        </li>
                    </ul>
                </div>
            @else
                @if (!str_contains(url()->current(), 'login'))
                    <a class="btn-solid-sm d-flex align-items-center gap-1" href="{{ route('login') }}">
                        <i class="fa fa-sign-in-alt"></i>
                        <span class="d-none d-sm-inline">تسجيل الدخول</span>
                    </a>
                @endif
            @endauth
        </div>
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
