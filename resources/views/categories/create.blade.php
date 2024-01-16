@extends('layouts.master')
@section('title', 'إضافة تصنيف')
@section('main')
    <div class="container-fluid w-75 py-5">
        <h1 class="text-decoration-underline text-center">إضافة تصنيف</h1>
        <form method="POST" action="{{ route('categories.store') }}" class="container w-75 shadow-sm my-5 p-5 form-bg">

            @csrf
            {{-- @method('POST') --}}
            {{-- <h4 class="text-decoration-underline">معلومات المدرب </h4> --}}
            <div class="row g-3 my-3">
                <label class="col-md-2 form-label" for="title">التصنيف</label>
                <div class="col-md-10">
                    <input class=" form-control" type="text" name="title" id="title" required>
                </div>
            </div>


            <div class="row g-5">
                <div class="col-md-3"></div>
                <button class="col-md-6 btn-solid-sm">إضافة تصنيف</button>
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
