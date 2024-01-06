@extends('layouts.master')
@section('title', 'تعديل المدرب')
@section('main')
    <div class="container py-5">
        <h1 class="text-decoration-underline text-center">تعديل معلومات المدرب</h1>
        <form method="POST" action="{{ route('trainers.update', $trainer->id) }}"
            class="container w-75 shadow-sm my-5 p-5 form-bg">
            @csrf
            @method('PUT')
            <h4 class="text-decoration-underline">معلومات المدرب </h4>
            <div class="row g-3 my-3">
                <label class="col-md-2 form-label" for="name">اسم المدرب</label>
                <div class="col-md-10">
                    <input class=" form-control" type="text" name="name" id="name" value="{{ $trainer->name }}"
                        required>
                </div>
            </div>
            <div class="row g-3 my-3">
                <label class="col-md-2 form-label" for="gender">الجنس</label>
                <div class="col-md-10">
                    <select name="gender" id="gender" class="form-select" value="{{ $trainer->gender }}" required>
                        <option {{ $trainer->gender === 'أنثى' ? 'selected' : '' }}>أنثى</option>
                        <option {{ $trainer->gender === 'ذكر' ? 'selected' : '' }}>ذكر</option>
                    </select>
                </div>
            </div>
            <div class="row g-3 my-3">
                <label class="col-md-2 form-label" for="phone">رقم الجوال</label>
                <div class=" col-md-10">

                    <input class="form-control" type="tel" name="phone" id="phone" value="{{ $trainer->phone }}"
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
