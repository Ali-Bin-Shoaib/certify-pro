@extends('layouts.master')
@section('title', 'إضافة مدرب')
@section('main')
    <div class="container-fluid w-75 py-5">
        <h1 class="text-decoration-underline text-center ">معلومات المدرب</h1>

        <div class="container  form-bg row  py-5 shadow-sm overflow-hidden">

            <h5 class=" col-md-3">ID: </h5>
            <b class="col-md-7 fs-4">{{ $trainer->id }}</b>

            <h5 class=" col-md-3">تمت الإضافة بواسطة: </h5>
            <b class="col-md-7 fs-4">{{ $trainer->member->user->name ?? '' }}</b>

            <h5 class=" col-md-3">اسم العضو: </h5>
            <b class="col-md-7 fs-4">{{ $trainer->name }}</b>

            <h5 class=" col-md-3">الجنس: </h5>
            <b class="col-md-7 fs-4">{{ $trainer->gender }}</b>

            <h5 class=" col-md-3">رقم الجوال: </h5>
            <b class="col-md-7 fs-4">{{ $trainer->phone }}</b>



            <h5 class=" col-md-3">تاريخ الإضافة: </h5>
            <b class="col-md-7 fs-4">{{ date('Y/m/dD - h-i-s a', strtotime($trainer->created_at)) }}</b>

            <h5 class=" col-md-3">آخر تعديل: </h5>
            <b class="col-md-7 fs-4">{{ date('Y/m/dD - h-i-s a', strtotime($trainer->updated_at)) }}</b>

            <div class="d-flex flex-row align-items-end justify-content-end">
                <a href="{{ route('trainers.edit', $trainer->id) }}" class="btn btn-warning btn-sm text-white">
                    <i class="fa fa-pen"></i>
                </a>
                <form action="{{ route('trainers.destroy', $trainer->id) }}" method="POST">
                    @method('DELETE')
                    @csrf
                    <button class="btn btn-sm btn-danger text-white"><i class="fa fa-trash "></i></button>
                </form>

            </div>

        </div>
        {{-- <div class="text-center mt-3">

            <a class="btn-solid-lg " href="{{ redirect()->back() }}">الرجوع</a>
        </div> --}}

    </div>

@endsection
