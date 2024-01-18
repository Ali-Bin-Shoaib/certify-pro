@extends('layouts.master')
@section('main')
    <div class="container-fluid w-75 py-5">
        <form  action="{{ route('template.importParticipants.post', $program->id) }}"
            enctype="multipart/form-data" method="POST" class="row g-4 row-cols-md-1">
            <h1 class="text-decoration-underline text-center ">إضافة مجموعة من المشاركين للدورة {{$program->title}}</h1>
            @csrf

            {{-- <p>ملاحظة</p> --}}
            <div class="input-group custom-file-button mt-0">
                <label class="input-group-text" for="file">الملف</label>
                <input type="file" class="form-control" name="file" id="file" accept=".xls, .xlsx, .csv">
            </div>
            {{-- <small class="fw-bold mt-0 ms-3 mb-5 text-danger"> يجب أن يكون  </small> --}}

            <div class="text-center">

                <button class="btn-solid-reg w-50">تأكيد</button>
            </div>


        </form>
    </div>
@endsection
