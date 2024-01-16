@extends('layouts.master')
@section('title', 'إضافة عضو')
@section('main')
    <div class="container-fluid w-75 py-5">
        <h1 class="text-decoration-underline text-center">إضافة عضو</h1>
        <form method="POST" action="{{ route('members.store') }}" class="container w-75 shadow-sm my-5 p-5 form-bg">

            @csrf
            {{-- @method('POST') --}}
            <h4 class="text-decoration-underline">معلومات العضو </h4>
            <div class="row g-3 my-3">
                <label class="col-md-2 form-label" for="name">الاسم الكامل</label>
                <div class="col-md-10">
                    <input class=" form-control" type="text" name="name" id="name" required>
                </div>
            </div>
            <div class="row g-3 my-3">
                <label class="col-md-2 form-label" for="username">اسم المستخدم</label>
                <div class="col-md-10">
                    <input class=" form-control" type="text" name="username" id="username" required>
                </div>
            </div>
            <div class="row g-3 my-3">
                <label class="col-md-2 form-label" for="password">كلمة المرور</label>
                <div class=" col-md-10">

                    <input class="form-control" type="password" name="password" id="password" required>
                </div>
            </div>

            <div class="row g-3 my-3">
                <label class="col-md-2 form-label" for="email">البريد الإلكتروني</label>
                <div class="col-md-10">
                    <input class=" form-control" type="email" name="email" id="email" required>
                </div>
            </div>
            <div class="row g-3 my-3">
                <label class="col-md-2 form-label" for="job_title">المسمى الوظيفي</label>
                <div class="col-md-10">
                    <input class=" form-control" type="text" name="job_title" id="job_title" required>
                </div>
            </div>

            <div class="row g-5">
                <div class="col-md-3"></div>
                <button class="col-md-6 btn-solid-sm">إضافة عضو</button>
            </div>
            @if ($errors)
                <ul class="mt-2">

                    @foreach ($errors->all() as $error)
                        <li class="text-danger">{{ $error }}</li>
                    @endforeach
                </ul>
            @endif
        </form>
    </div>
@endsection
