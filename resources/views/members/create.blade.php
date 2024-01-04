@extends('layouts.master')
@section('title', 'إضافة عضو')
@section('main')
    <div class="container py-5">
        <h1 class="text-decoration-underline text-center">إضافة عضو</h1>
        <form method="POST" action="{{ route('members.store') }}" class="container w-75 shadow-sm my-5 p-5 form-bg">
            @csrf
            {{-- @method('POST') --}}
            <h4 class="text-decoration-underline">إضافة عضو </h4>
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
            <div class="row g-5">
                <div class="col-md-3"></div>
                <button class="col-md-6 btn-solid-sm">إضافة عضو</button>
            </div>
        </form>
    </div>
@endsection
