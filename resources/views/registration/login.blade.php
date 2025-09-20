@extends('layouts.master')
@section('title', 'تسجيل الدخول')
@section('main')
    <div class="basic-1 bg-gray" style="background-image: url({{ asset('images/header-background.jpg') }});background-size:contain">
        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-12 col-md-8 col-lg-6">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @if (Session::has('error-message'))
                        <div class="alert alert-info">{{ Session::get('error-message') }}</div>
                    @endif

                    <div class="card shadow border-0">
                        <div class="card-body p-4">
                            <h2 class="text-center mb-4">تسجيل الدخول</h2>

                            <form action="{{ route('login') }}" method="POST">
                                @csrf

                                <div class="form-group mb-3">
                                    <label class="form-label fw-bold" for="username">اسم المستخدم</label>
                                    <input type="text" name="username" id="username" required
                                           class="form-control form-control-input"
                                           placeholder="أدخل اسم المستخدم">
                                </div>

                                <div class="form-group mb-3">
                                    <label class="form-label fw-bold" for="password">كلمة المرور</label>
                                    <input type="password" name="password" id="password" required
                                           class="form-control form-control-input"
                                           placeholder="أدخل كلمة المرور">
                                </div>

                                <div class="form-check mb-3">
                                    <input class="form-check-input" type="checkbox" id="rememberMe" name="rememberMe">
                                    <label class="form-check-label" for="rememberMe">
                                        تذكرني
                                    </label>
                                </div>

                                <div class="d-grid mb-3">
                                    <button type="submit" class="btn btn-primary btn-lg">تسجيل الدخول</button>
                                </div>

                                <div class="text-center">
                                    <small class="text-muted">
                                        ليس لديك حساب؟
                                        <a href="{{ route('signup') }}" class="fw-bold text-decoration-none">
                                            سجّل الآن
                                        </a>
                                    </small>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
