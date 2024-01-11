@extends('layouts.master')
@section('title', 'إضافة مشارك')
@section('main')
    <div class="container py-5">
        <h1 class="text-decoration-underline text-center">إضافة مشارك</h1>
        <form method="POST"
            @isset($program)
action="{{ route('participants.store', ['programId' => $program->id]) }}"
        @else
             action="{{ route('participants.store') }}"
        @endisset
            class="container w-75 shadow-sm my-5 p-5 form-bg ">
            @csrf
            @isset($program)
                <div class="container form-bg row  py-3 shadow-sm">
                    #{{ $program->id }}
                    <h4 class="text-decoration-underline">معلومات الدورة </h4>

                    <h5 class=" col-md-3">تمت الإضافة بواسطة: </h5>
                    <b class="col-md-7 fs-4">{{ $program->member->user->name ?? '' }}</b>
                    <h5 class=" col-md-3">التصنيف: </h5>
                    <b class="col-md-7 fs-4">{{ $program->category->title }}</b>

                    <h5 class=" col-md-3">العنوان: </h5>
                    <b class="col-md-7 fs-4">{{ $program->title }}</b>

                    <h5 class=" col-md-3">الموقع: </h5>
                    <b class="col-md-7 fs-4">{{ $program->location }}</b>

                    <h5 class=" col-md-3">عدد المشاركين: </h5>
                    <b class="col-md-7 fs-4">{{ $program->participants->count() }}</b>

                    <h5 class=" col-md-3">تاريخ بداية الدورة: </h5>
                    <b class="col-md-7 fs-4">{{ date('Y-m-dD', strtotime($program->start_date)) }}</b>

                    <h5 class=" col-md-3">تاريخ نهاية الدورة: </h5>
                    <b class="col-md-7 fs-4">{{ date('Y-m-dD', strtotime($program->end_date)) }}</b>

                </div>
                <hr class="my-3">
            @endisset
            <h4 class="text-decoration-underline">معلومات المشارك </h4>
            <div class="row g-3 my-3">

                <label class="col-md-2 form-label" for="program_id">الدورة</label>
                <div class="col-md-10">
                    <select name="program_id" id="program_id" class="form-select">
                        @foreach ($programs as $program)
                            <option value="{{ $program->id }}">{{ $program->title }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
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
                        <option value="أنثى">أنثى</option>
                        <option value="ذكر">ذكر</option>
                    </select>

                </div>
            </div>

            <div class="row g-5">
                <div class="col-md-3"></div>
                <button class="col-md-6 btn-solid-sm" type="submit">إضافة مشارك</button>
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
@section('script')

@endsection
