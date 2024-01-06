@extends('layouts.master')
@section('title', 'تعديل التصنيف')
@section('main')
    <div class="container py-5">
        <h1 class="text-decoration-underline text-center">تحديث تصنيف</h1>
        <form method="POST" action="{{ route('categories.update',$category->id) }}" class="container w-75 shadow-sm my-5 p-5 form-bg">

            @csrf
            @method('PUT')
            {{-- <h4 class="text-decoration-underline">معلومات التصنيف </h4> --}}
            <div class="row g-3 my-3">
                <label class="col-md-2 form-label" for="title">التصنيف</label>
                <div class="col-md-10">
                    <input class=" form-control" type="text" name="title" id="title" value="{{ $category->title }}"
                        required>
                </div>
            </div>


            <div class="row g-5">
                <div class="col-md-3"></div>
                <button class="col-md-6 btn-solid-sm">تحديث تصنيف</button>
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
