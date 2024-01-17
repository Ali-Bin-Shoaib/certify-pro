@extends('layouts.master')
@section('title', 'تعديل بيانات الحساب')
@section('main')
    <div class="container-fluid w-75 py-5">
        <h3 class="text-center text-decoration-underline">معلومات الحساب</h3>
        <form method="POST" action="{{ route('organization.update') }}" class="container w-75 shadow-sm my-3">
            @csrf
            <div class="row g-3 my-3">
                <label class="col-md-2 form-label fw-bold" for="name">اسم المنظمة</label>
                <div class="col-md-10">
                    <input class=" form-control" type="text" name="name" id="name"
                        value="{{ Auth::user()->name }}" required>
                </div>
            </div>
            <div class="row g-3 my-3">
                <label class="col-md-2 form-label fw-bold" for="email">الإيميل</label>
                <div class=" col-md-10">
                    <input class="form-control" type="email" name="email" id="email"
                        value="{{ Auth::user()->email }}" required>
                </div>
            </div>
            <div class="row g-3 my-3">
                <label class="col-md-2 form-label fw-bold" for="username">اسم المستخدم</label>
                <div class=" col-md-4">

                    <input class="form-control" type="text" name="username" value="{{ Auth::user()->username }}"
                        id="username" required>
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

                    <input class="form-control" type="tel" name="phone" id="phone"
                        value="{{ $organization->phone }}" required>
                </div>
            </div>
            <div class="row g-3 my-3">
                <label class="col-md-2 form-label fw-bold" for="address">الموقع</label>
                <div class=" col-md-10">

                    <input class="form-control" type="text" name="address" id="address"
                        value="{{ $organization->address }}" required>
                </div>
            </div>


            <div class="row g-5">
                <div class="col-md-3"></div>
                <button class="col-md-6 btn-solid-sm">تعديل</button>
            </div>
        </form>
    </div>
    </div>
@endsection
