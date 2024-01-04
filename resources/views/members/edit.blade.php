@extends('layouts.master')
@section('title', 'تعديل عضو')
@section('main')
    <div class="container py-5">
        <h1 class="text-decoration-underline text-center">تعديل معلومات العضو</h1>
        <form method="POST" action="{{ route('members.update', $member->id) }}" class="container w-75 shadow-sm my-5 p-5 form-bg">
            @csrf
            @method('PUT')
            <h4 class="text-decoration-underline">معلومات العضو</h4>
            <div class="row g-3 my-3">
                <label class="col-md-2 form-label" for="username">اسم المستخدم</label>
                <div class="col-md-10">
                    <input class=" form-control" type="text" name="username" value="{{ $member->username }}"
                        id="username" required>
                </div>
            </div>
            <div class="row g-3 my-3">
                <label class="col-md-2 form-label" for="password">كلمة المرور</label>
                <div class=" col-md-10">

                    <input class="form-control" type="password" name="password" id="password"
                         required>
                </div>
            </div>

            <div class="row g-5">
                <div class="col-md-3"></div>
                <button class="col-md-6 btn-solid-sm">تحديث</button>
            </div>
        </form>
    </div>
@endsection
