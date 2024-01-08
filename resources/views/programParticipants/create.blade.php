@extends('layouts.master')
@php
    $title = 'إضافة مشاركين لدورة ' . $program->title;
@endphp
@section('title', $title)
@section('main')
    <div class="container-fluid  py-5 ">
        <h1 class="text-decoration-underline text-center">إضافة مشاركين لدورة {{ $program->title }}</h1>
        <form method="POST" action="{{ route('categories.store') }}" class="container  shadow-sm my-5 p-0  pb-5 form-bg">

            @csrf
            {{-- @method('POST') --}}
            {{-- <h4 class="text-decoration-underline">معلومات المدرب </h4> --}}
            {{-- <div class="row g-3 my-3 text-center">
                <div class="col-md-3 form-label" for="title">الاسم </div>
                <div class="col-md-3 form-label" for="title">البريد الإلكتروني </div>
                <div class="col-md-3 form-label" for="title">الهاتف </div>
                <div class="col-md-3 form-label" for="title">الجنس </div>
            </div> --}}
            <table class="table table-bordered table-responsive">
                <thead>
                    <th>#</th>
                    <th>الاسم</th>
                    <th>البريد الإلكتروني</th>
                    <th>الهاتف</th>
                    <th>الجنس</th>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td><input required type="text" name="name[]" class="form-control"></td>
                        <td><input required type="email" name="email[]" class="form-control"></td>
                        <td><input required type="tel" name="phone[]" class="form-control"></td>
                        <td><select class="form-select" name="gender[]" id="gender[]" required>
                                <option value="test">test</option>
                            </select></td>
                    </tr>
                    <tr>
                        <td colspan='5'><button type="button" class="btn btn-primary btn-sm">+</button></td>
                    </tr>
                </tbody>
            </table>
            {{-- <div class="row g-3 my-3">
                <div class="col-md-10">
                    <input class=" form-control" type="text" name="title" id="title" required>
                </div>

            </div> --}}

            <div class="row g-5">
                <div class="col-md-3"></div>
                <button class="col-md-6 btn-solid-sm">إضافة مشاركين لدورة {{ $program->title }}</button>
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
