@extends('layouts.master')
@section('title', 'إضافة دورة')
@section('main')
    <div class="container w-75 mt-5 py-5">
        <h1 class="text-decoration-underline text-center ">معلومات العضو</h1>

        <div class="container  form-bg row  py-5 shadow-sm overflow-hidden">

            <h5 class=" col-md-3">ID: </h5>
            <b class="col-md-7 fs-4">{{ $member->id }}</b>

            <h5 class=" col-md-3">تمت الإضافة بواسطة: </h5>
            <b class="col-md-7 fs-4">{{ $member->organization->user->name }}</b>

            <h5 class=" col-md-3">اسم العضو: </h5>
            <b class="col-md-7 fs-4">{{ $member->user->name }}</b>

            <h5 class=" col-md-3">اسم المستخدم: </h5>
            <b class="col-md-7 fs-4">{{ $member->user->username }}</b>

            <h5 class=" col-md-3">البريد الإلكتروني: </h5>
            <b class="col-md-7 fs-4">{{ $member->user->email }}</b>

            <h5 class=" col-md-3">المسمى الوظيفي: </h5>
            <b class="col-md-7 fs-4">{{ $member->job_title }}</b>


            <h5 class=" col-md-3">تاريخ الإضافة: </h5>
            <b class="col-md-7 fs-4">{{ date('Y/m/dD - h-i-s a',strtotime($member->created_at)) }}</b>

            <h5 class=" col-md-3">آخر تعديل: </h5>
            <b class="col-md-7 fs-4">{{ $member->updated_at }}</b>

            <div class="d-flex flex-row align-items-end justify-content-end">
                <a href="{{ route('members.edit', $member->id) }}" class="btn btn-warning btn-sm text-white">
                    <i class="fa fa-pen"></i>
                </a>
                <form action="{{ route('members.destroy', $member->id) }}" method="POST">
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
