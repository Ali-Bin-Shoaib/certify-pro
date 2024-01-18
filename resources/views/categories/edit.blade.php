@extends('layouts.master')
@section('title', 'تعديل التصنيف')
@section('main')
    <div class="container-fluid w-75 py-5">
        <h1 class="text-decoration-underline text-center">تحديث تصنيف</h1>
        <form method="POST" action="{{ route('categories.update', $category->id) }}"
            class="container w-75 shadow-sm my-5 p-5 form-bg">

            @csrf
            @method('PUT')
            <div class="row g-3 my-3">
                <label class="col-md-2 form-label" for="title">التصنيف</label>
                <div class="col-md-10">
                    <input class=" form-control" type="text" name="title" id="title" value="{{ $category->title }}"
                        required>
                </div>
            </div>


            <div class="row g-5 gap-2">
                <div class="col-md-3"></div>
                <button class="col-md-3 btn-solid-sm">تحديث </button>
                <a  onclick="javascript:window.history.back();" class="col-md-3 btn btn-sm rounded-5 fw-bold btn-secondary">رجوع </a>
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
