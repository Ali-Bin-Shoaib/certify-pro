@extends('layouts.master')
@section('main')
    <div class="container-fluid w-75 border border-5 rounded-4 border-success pt-3 bg-certified">
        <img src="{{ asset('images/certified.png') }}" class="img-fluid mx-auto d-block" width="20%" alt="">
        {{-- <h1 class="text-success display-1 text-center fw-bolder text-decoration-underline">شهادة موثقة</h1> --}}
        <h1 class="text-decoration-underline text-center">معلومات الشهادة</h1>
        <hr>

        <!-- Desktop Layout: Side by side -->
        <div class="d-flex gap-3 justify-content-center align-items-start p-3 d-none d-lg-flex">
            <div class="w-50 pt-3">
                <h4 class="text-center mb-3 text-primary">معلومات المشارك</h4>
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
                <h4 class="text-center mb-3 text-primary">معلومات المنظمة</h4>
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

        <!-- Mobile Layout: Stacked vertically -->
        <div class="d-lg-none p-3">
            <!-- Participant Information -->
            <div class="mb-4">
                <h4 class="text-center mb-3 text-primary">معلومات المشارك</h4>
                <div class="row g-2 mb-2">
                    <div class="col-12">
                        <div class="d-flex justify-content-between align-items-center p-2 bg-light rounded">
                            <span class="fs-6 fw-bold">اسم المشارك:</span>
                            <b class="fs-6">{{ $participant->name }}</b>
                        </div>
                    </div>
                </div>
                <div class="row g-2 mb-2">
                    <div class="col-12">
                        <div class="d-flex justify-content-between align-items-center p-2 bg-light rounded">
                            <span class="fs-6 fw-bold">البريد الإلكتروني:</span>
                            <b class="fs-6 text-break">{{ $participant->email }}</b>
                        </div>
                    </div>
                </div>
                <div class="row g-2 mb-2">
                    <div class="col-12">
                        <div class="d-flex justify-content-between align-items-center p-2 bg-light rounded">
                            <span class="fs-6 fw-bold">عنوان الدورة:</span>
                            <b class="fs-6 text-break">{{ $program->title }}</b>
                        </div>
                    </div>
                </div>
                <div class="row g-2 mb-2">
                    <div class="col-12">
                        <div class="d-flex justify-content-between align-items-center p-2 bg-light rounded">
                            <span class="fs-6 fw-bold">موقع الدورة:</span>
                            <b class="fs-6 text-break">{{ $program->location }}</b>
                        </div>
                    </div>
                </div>
                <div class="row g-2 mb-2">
                    <div class="col-12">
                        <div class="d-flex justify-content-between align-items-center p-2 bg-light rounded">
                            <span class="fs-6 fw-bold">تاريخ الإصدار:</span>
                            <b class="fs-6">{{ date('D - M - Y', strtotime($certificate->created_at)) }}</b>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Organization Information -->
            <div class="mb-4">
                <h4 class="text-center mb-3 text-primary">معلومات المنظمة</h4>
                <div class="row g-2 mb-2">
                    <div class="col-12">
                        <div class="d-flex justify-content-between align-items-center p-2 bg-light rounded">
                            <span class="fs-6 fw-bold">اسم المنظمة:</span>
                            <b class="fs-6 text-break">{{ $organization->user->name }}</b>
                        </div>
                    </div>
                </div>
                <div class="row g-2 mb-2">
                    <div class="col-12">
                        <div class="d-flex justify-content-between align-items-center p-2 bg-light rounded">
                            <span class="fs-6 fw-bold">البريد الإلكتروني:</span>
                            <b class="fs-6 text-break">{{ $organization->user->email }}</b>
                        </div>
                    </div>
                </div>
                <div class="row g-2 mb-2">
                    <div class="col-12">
                        <div class="d-flex justify-content-between align-items-center p-2 bg-light rounded">
                            <span class="fs-6 fw-bold">العنوان:</span>
                            <b class="fs-6 text-break">{{ $organization->address }}</b>
                        </div>
                    </div>
                </div>
                <div class="row g-2 mb-2">
                    <div class="col-12">
                        <div class="d-flex justify-content-between align-items-center p-2 bg-light rounded">
                            <span class="fs-6 fw-bold">الجوال:</span>
                            <b class="fs-6">{{ $organization->phone }}</b>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
