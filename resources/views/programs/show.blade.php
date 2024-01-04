@extends('layouts.master')
@section('title', 'إضافة دورة')
@section('main')
    <div class="container mt-5 py-5">
        <h1 class="text-decoration-underline text-center ">معلومات الدورة</h1>

        <div class="container form-bg row  py-5 shadow-sm">

            <h5 class=" col-md-5">تمت الإضافة بواسطة: </h5>
            <b class="col-md-7 fs-4">{{$program->member->username}}</b>
            <h5 class=" col-md-5">التصنيف: </h5>
            <b class="col-md-7 fs-4">{{$program->category->title}}</b>

            <h5 class=" col-md-5">العنوان: </h5>
            <b class="col-md-7 fs-4">{{$program->title}}</b>

            <h5 class=" col-md-5">الموقع: </h5>
            <b class="col-md-7 fs-4">{{$program->location}}</b>

            <h5 class=" col-md-5">تاريخ البداية: </h5>
            <b class="col-md-7 fs-4">{{ date('Y-m-d' ,strtotime($program->start_date)) }}</b>

            <h5 class=" col-md-5">تاريخ النهاية: </h5>
            <b class="col-md-7 fs-4">{{ date('Y-m-d' ,strtotime($program->end_date)) }}</b>

            <div class="text-end ">
                <a class="btn btn-sm btn-warning text-white" href="{{ route('programs.edit', 1) }}"><i class="fa fa-pen "></i></a>
                <a class="btn btn-sm btn-danger text-white" href="{{ route('programs.edit', 1) }}"><i class="fa fa-trash "></i></a>

            </div>

        </div>
        {{-- <div class="text-center mt-3">

            <a class="btn-solid-lg " href="{{ route('participants.create') }}">إضافة مشاركين للدورة؟</a>
        </div> --}}

    </div>

@endsection
