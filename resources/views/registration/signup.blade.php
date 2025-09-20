@extends('layouts.master')
@section('title', 'إنشاء حساب')
@section('main')
    <div class="basic-1 bg-gray" style="background-image: url({{ asset('images/header-background.jpg') }});background-size:contain">
        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-12 col-md-10 col-lg-8">
                    <div class="card shadow border-0">
                        <div class="card-body p-4">
                            <h2 class="text-center text-decoration-underline mb-4">معلومات المنظمة</h2>

                            <form method="POST" action="{{ route('signup') }}">
                                @csrf

                                <div class="row">
                                    <div class="col-12 mb-3">
                                        <label class="form-label fw-bold" for="name">اسم المنظمة</label>
                                        <input class="form-control form-control-input" type="text" name="name" id="name"
                                               required placeholder="أدخل اسم المنظمة">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12 mb-3">
                                        <label class="form-label fw-bold" for="email">البريد الإلكتروني</label>
                                        <input class="form-control form-control-input" type="email" name="email" id="email"
                                               required placeholder="أدخل البريد الإلكتروني">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12 col-md-6 mb-3">
                                        <label class="form-label fw-bold" for="username">اسم المستخدم</label>
                                        <input class="form-control form-control-input" type="text" name="username" id="username"
                                               required placeholder="أدخل اسم المستخدم">
                                    </div>
                                    <div class="col-12 col-md-6 mb-3">
                                        <label class="form-label fw-bold" for="password">كلمة المرور</label>
                                        <input class="form-control form-control-input" type="password" name="password" id="password"
                                               required placeholder="أدخل كلمة المرور">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12 mb-3">
                                        <label class="form-label fw-bold" for="phone">رقم الجوال</label>
                                        <input class="form-control form-control-input" type="tel" name="phone" id="phone"
                                               required placeholder="أدخل رقم الجوال">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12 mb-3">
                                        <label class="form-label fw-bold" for="address">الموقع</label>
                                        <input class="form-control form-control-input" type="text" name="address" id="address"
                                               required placeholder="أدخل الموقع">
                                    </div>
                                </div>

                                <div class="text-center mb-3">
                                    <small class="text-muted">
                                        لديك حساب؟
                                        <a href="{{ route('login') }}" class="fw-bold text-decoration-none">
                                            سجّل دخول
                                        </a>
                                    </small>
                                </div>

                                <div class="d-grid">
                                    <button type="submit" class="btn btn-primary btn-lg">إنشاء حساب</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
