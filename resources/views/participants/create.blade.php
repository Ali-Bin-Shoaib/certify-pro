@extends('layouts.master')
@section('title', 'إضافة مشارك')
@section('main')
    <div class="container py-5">
        <h1 class="text-decoration-underline text-center">إضافة مشارك</h1>
        <form method="POST" action="{{ route('participants.store') }}" class="container w-75 shadow-sm my-5 p-5 form-bg">
            @csrf
            {{-- @method('POST') --}}
            <h4 class="text-decoration-underline">إضافة مشارك </h4>
            <div class="row g-3 my-3">
                <label class="col-md-2 form-label" for="name">الإسم</label>
                <div class="col-md-10">
                    <input class=" form-control" type="text" name="name" id="name" required>
                </div>
            </div>
            <div class="row g-3 my-3">
                <label class="col-md-2 form-label" for="email">البريد الإلكتروني</label>
                <div class="col-md-10">
                    <input class=" form-control" type="text" name="email" id="email" required>
                </div>
            </div>
            <div class="row g-3 my-3">
                <label class="col-md-2 form-label" for="phone">رقم الهاتف</label>
                <div class=" col-md-10">

                    <input class="form-control" type="phone" name="phone" id="phone" required>
                </div>
            </div>
            <div class="row g-3 my-3">
                <label class="col-md-2 form-label" for="gender">الجنس</label>
                <div class=" col-md-10">
                    <select name="gender" id="gender" class="form-select">
                        <option value="ذكر">ذكر</option>
                        <option value="أنثى">أنثى</option>
                    </select>

                </div>
            </div>

            <div class="row g-5">
                <div class="col-md-3"></div>
                <button class="col-md-6 btn-solid-sm">إضافة مشارك</button>
            </div>
        </form>
    </div>
@endsection
