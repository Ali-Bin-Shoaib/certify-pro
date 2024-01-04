@extends('layouts.master')
@section('title', 'تعديل دورة')
@section('main')
    <div class="container py-5">
        <h1 class="text-decoration-underline text-center">تعديل الدورة</h1>
        <form method="POST" action="{{ route('programs.update', $program->id) }}"
            class="container w-75 shadow-sm my-5 p-5 form-bg">
            @csrf
            @method('PUT')
            <h4 class="text-decoration-underline">معلومات الدورة</h4>
            <div class="row g-3 my-3">
                <label class="col-md-2 form-label" for="title">عنوان الدورة</label>
                <div class="col-md-10">
                    <input class=" form-control" type="text" name="title" id="title" value="{{ $program->title }}"
                        required>
                </div>
            </div>
            <div class="row g-3 my-3">
                <label class="col-md-2 form-label" for="location">الموقع</label>
                <div class=" col-md-10">

                    <input class="form-control" type="text" name="location" id="location"
                        value="{{ $program->location }}" required>
                </div>
            </div>
            <div class="row g-3 my-3">
                <label class="col-md-2 form-label" for="start_date">تاريخ بداية الدورة</label>
                <div class=" col-md-10">

                    <input class="form-control" type="date" name="start_date" id="start_date"
                        value="{{ date('Y-m-d', strtotime($program->start_date)) }}" required>
                </div>
            </div>
            <div class="row g-3 my-3">
                <label class="col-md-2 form-label" for="end_date">تاريخ نهاية الدورة</label>
                <div class=" col-md-10">

                    <input class="form-control" type="date" name="end_date" id="end_date"
                        value="{{ date('Y-m-d', strtotime($program->end_date)) }}" required>
                </div>
            </div>
            <div class="row g-3 my-3">
                <label class="col-md-2 form-label" for="category_id">التصنيف</label>
                <div class=" col-md-10">
                    <select name="category_id" id="category_id" class="form-select">
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ $program->category_id === $category->id ? 'selected' : '' }}>
                                {{ $category->title }}</option>
                        @endforeach
                    </select>

                </div>
            </div>
            <div class="row g-5 gap-5 mt-3 align-items-center justify-content-center">

                <button class="col-md-4 btn-solid-sm">تعديل</button>
                <a href="{{ route('programs.index') }}"
                    class="col-md-4 btn btn-sm rounded-5 text-white bg-secondary">إلغاء</a>

            </div>
        </form>
    </div>
@endsection
