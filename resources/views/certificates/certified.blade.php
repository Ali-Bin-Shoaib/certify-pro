@extends('layouts.master')
@section('main')

    <div class="container-fluid w-75  border border-5 rounded-4  border-success pt-3 bg-certified">
        <img src="{{asset('images/certified.png')}}" class="img-fluid mx-auto d-block" width="25%" alt="">
        {{-- <h1 class="text-success display-1 text-center fw-bolder text-decoration-underline">شهادة موثقة</h1> --}}
        <div class="container   pt-5">
            <h1 class="text-decoration-underline text-center">معلومات الشهادة</h1>
            <hr>
            <div class="row g-3 justify-content-center align-items-center">
                <span class="col-md-2 fs-4"> اسم المشارك</span>
                <b class="col-md-10 fs-2 fw-normal">{{ $participant->name }}</b>
            </div>
            <div class="row g-3">
                <span class="col-md-2 fs-4"> البريد الإلكتروني</span>
                <b class="col-md-10 fs-2 fw-normal">{{ $participant->email }}</b>
            </div>
            <div class="row g-3">
                <span class="col-md-2 fs-4"> عنوان الدورة</span>
                <b class="col-md-10 fs-2 fw-normal">{{ $program->title }}</b>
            </div>
            <div class="row g-3">
                <span class="col-md-2 fs-4"> موقع الدورة</span>
                <b class="col-md-10 fs-2 fw-normal">{{ $program->location }}</b>
            </div>
            <div class="row g-3">
                <span class="col-md-2 fs-4"> تاريخ الإصدار</span>
                <b class="col-md-10 fs-2 fw-normal">{{ date('D - M - Y',strtotime($certificate->created_at)) }}</b>
            </div>
        </div>
    </div>
@endsection
