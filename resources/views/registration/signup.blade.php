@extends('layouts.master')
@section('title', 'إنشاء حساب')
@section('main')
    <div class="basic-1">

        <div class="container ">
            <h3 class="text-center text-decoration-underline">معلومات المنظمة</h3>
            <form method="POST" action="{{ route('signup') }}" class="container w-75 shadow-sm my-3">
                @csrf
                <div class="row g-3 my-3">
                    <label class="col-md-2 form-label fw-bold" for="name">اسم المنظمة</label>
                    <div class="col-md-10">
                        <input class=" form-control" type="text" name="name" id="name"
                            required>
                    </div>
                </div>
                <div class="row g-3 my-3">
                    <label class="col-md-2 form-label fw-bold" for="email">الإيميل</label>
                    <div class=" col-md-10">

                        <input class="form-control" type="email" name="email" id="email" required>
                    </div>
                </div>
                <div class="row g-3 my-3">
                    <label class="col-md-2 form-label fw-bold" for="username">اسم المستخدم</label>
                    <div class=" col-md-4">

                        <input class="form-control" type="text" name="username" id="username" required>
                    </div>
                    {{-- </div>
                <div class="row g-3 my-3"> --}}
                    <label class="col-md-2 form-label fw-bold" for="password">كلمة المرور</label>
                    <div class=" col-md-4">

                        <input class="form-control" type="password" name="password" id="password" required>
                    </div>
                </div>
                <div class="row g-3 my-3">
                    <label class="col-md-2 form-label fw-bold" for="phone">رقم الجوال</label>
                    <div class=" col-md-10">

                        <input class="form-control" type="tel" name="phone" id="phone" required>
                    </div>
                </div>
                <div class="row g-3 my-3">
                    <label class="col-md-2 form-label fw-bold" for="address">الموقع</label>
                    <div class=" col-md-10">

                        <input class="form-control" type="text" name="address" id="address" required>
                    </div>
                </div>
                {{-- <div class="row g-3 my-3">
                    <label class="col-md-2 form-label fw-bold" for="cid">رقم السجل التجاري</label>
                    <div class=" col-md-10">

                        <input class="form-control" type="text" name="cid" id="cid" required>
                    </div>
                </div> --}}
                <div class="row g-5">
                    <div class="col-md-3"></div>
                    <button class="col-md-6 btn-solid-sm">إنشاء حساب</button>
                </div>
            </form>
        </div>
    </div>
@endsection
