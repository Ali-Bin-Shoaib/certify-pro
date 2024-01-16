@extends('layouts.master')
@section('title', 'إضافة مدرب')
@section('main')
    <div class="container-fluid w-75 py-5">
        <h1 class="text-decoration-underline text-center">إضافة مدرب</h1>
        <form method="POST" action="{{ route('trainers.store') }}" class="container w-75 shadow-sm my-5 p-5 form-bg">

            @csrf
            {{-- @method('POST') --}}
            <h4 class="text-decoration-underline">معلومات المدرب </h4>
            <div class="row g-3 my-3">
                <label class="col-md-2 form-label" for="name">اسم المدرب</label>
                <div class="col-md-10">
                    <input class=" form-control" type="text" name="name" id="name" required>
                </div>
            </div>
            <div class="row g-3 my-3">
                <label class="col-md-2 form-label" for="gender">الجنس</label>
                <div class="col-md-10">
                    <select name="gender" id="gender" class="form-select" required>
                        <option>أنثى</option>
                        <option>ذكر</option>
                    </select>
                </div>
            </div>
            <div class="row g-3 my-3">
                <label class="col-md-2 form-label" for="phone">رقم الجوال</label>
                <div class=" col-md-10">

                    <input class="form-control" type="tel" name="phone" id="phone" required>
                </div>
            </div>


            <div class="row g-5">
                <div class="col-md-3"></div>
                <button class="col-md-6 btn-solid-sm">إضافة مدرب</button>
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
