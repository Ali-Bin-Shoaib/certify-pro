@extends('layouts.master')
@section('main')
    <div class=" basic-1 bg-gray">
        <div class="container py-5">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if (Session::has('error-message'))
                <p class="alert alert-info">{{ Session::get('error-message') }}</p>
            @endif
            <form action="{{ route('login') }}" method="POST" class="container w-50 mt-5 shadow border rounded p-5">
                @csrf

                <div class="row ">
                    <label class="g-2 col-md-12 fw-bold" for="username">اسم المستخدم</label>
                    <input type="username" name="username" id="username" required class="form-control">
                </div>
                <div class="row ">
                    <label class="g-2 col-md-12 fw-bold" for="password">كلمة المرور</label>
                    <input type="password" name="password" id="password" required class="form-control">
                </div>
                <div class="row ">
                    <small class="g-2 ps-5">ليس لديك حساب؟ <a href="signup" class="fw-bold nav-link d-inline">سجّل
                            الآن</a></small>
                </div>

                <div class="row">
                    <div class="col-md-3"></div>
                    <button class="col-md-6 btn-solid-lg">تسجيل الدخول</button>
                </div>
            </form>
        </div>
    </div>
@endsection
