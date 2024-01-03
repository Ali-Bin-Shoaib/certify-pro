@extends('layouts.master')
@section('title', 'إضافة دورة')
@section('main')
    <div class="container py-5">
        <h1 class="text-decoration-underline text-center">إضافة دورة</h1>
        <form method="POST" action="{{ route('programs.store') }}" class="container w-75 shadow-sm my-5 p-5 form-bg">
            @csrf
            {{-- @method('POST') --}}
            <h4 class="text-decoration-underline">معلومات الدورة</h4>
            <div class="row g-3 my-3">
                <label class="col-md-2 form-label" for="title">عنوان الدورة</label>
                <div class="col-md-10">
                    <input class=" form-control" type="text" name="title" id="title" required>
                </div>
            </div>
            <div class="row g-3 my-3">
                <label class="col-md-2 form-label" for="location">الموقع</label>
                <div class=" col-md-10">

                    <input class="form-control" type="text" name="location" id="location" required>
                </div>
            </div>
            <div class="row g-3 my-3">
                <label class="col-md-2 form-label" for="start_date">تاريخ بداية الدورة</label>
                <div class=" col-md-10">

                    <input class="form-control" type="date" name="start_date" id="start_date" value="{{ date('Y-m-d') }}"
                        required>
                </div>
            </div>
            <div class="row g-3 my-3">
                <label class="col-md-2 form-label" for="end_date">تاريخ نهاية الدورة</label>
                <div class=" col-md-10">

                    <input class="form-control" type="date" name="end_date" id="end_date"
                        value="{{ date('Y-m-d', strtotime('+1 week')) }}" required>
                </div>
            </div>
            <div class="row g-3 my-3">
                <label class="col-md-2 form-label" for="category_id">التصنيف</label>
                <div class=" col-md-10">
                    <select name="category_id" id="category_id" class="form-select">
                        <option value="1">برمجي</option>
                        <option value="2">اجتماعي</option>
                        <option value="3">ثقافي</option>
                    </select>

                </div>
            </div>
            <div class="row g-5">
                <div class="col-md-3"></div>
                <button class="col-md-6 btn-solid-sm">إضافة دورة</button>
            </div>
        </form>
    </div>
@endsection
