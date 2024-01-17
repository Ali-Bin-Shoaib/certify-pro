@extends('layouts.master')
@section('main')
    <div class="container-fluid w-75  border border-5 rounded-4  border-success pt-3 bg-certified "
   >
        <img src="{{ asset('images/certified.png') }}" class="img-fluid mx-auto d-block" width="20%" alt="">
        {{-- <h1 class="text-success display-1 text-center fw-bolder text-decoration-underline">شهادة موثقة</h1> --}}
        <h1 class="text-decoration-underline text-center">معلومات الشهادة</h1>
        <hr>
        <div class="d-flex gap-3 justifiy-content-center align-items-center p-3">
            <div class="  w-50 pt-3">
                <div class="row g-3 justify-content-center align-items-center">
                    <span class="col-md-4 fs-5"> اسم المشارك</span>
                    <b class="col-md-8 fs-4 fw-normal">{{ $participant->name }}</b>
                </div>
                <div class="row g-3"> <span class="col-md-4 fs-5"> البريد الإلكتروني</span>
                    <b class="col-md-8 fs-4 fw-normal">{{ $participant->email }}</b>
                </div>
                <div class="row g-3"> <span class="col-md-4 fs-5"> عنوان الدورة</span>
                    <b class="col-md-8 fs-4 fw-normal">{{ $program->title }}</b>
                </div>
                <div class="row g-3"> <span class="col-md-4 fs-5"> موقع الدورة</span>
                    <b class="col-md-8 fs-4 fw-normal">{{ $program->location }}</b>
                </div>
                <div class="row g-3"> <span class="col-md-4 fs-5"> تاريخ الإصدار</span>
                    <b class="col-md-8 fs-4 fw-normal">{{ date('D - M - Y', strtotime($certificate->created_at)) }}</b>
                </div>
            </div>
            <div class="w-50">
                <div class="row g-3 justify-content-center align-items-center">
                    <span class="col-md-4 fs-5"> اسم المنظمة</span>
                    <b class="col-md-8 fs-4 fw-normal">{{ $organization->user->name }}</b>
                </div>
                <div class="row g-3"> <span class="col-md-4 fs-5"> البريد الإلكتروني</span>
                    <b class="col-md-8 fs-4 fw-normal">{{ $organization->user->email }}</b>
                </div>
                <div class="row g-3"> <span class="col-md-4 fs-5"> العنوان</span>
                    <b class="col-md-8 fs-4 fw-normal">{{ $organization->address }}</b>
                </div>
                <div class="row g-3"> <span class="col-md-4 fs-5"> الجوال</span>
                    <b class="col-md-8 fs-4 fw-normal">{{ $organization->phone }}</b>
                </div>

            </div>

        </div>
    </div>
@endsection
