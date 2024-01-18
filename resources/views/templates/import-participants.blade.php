@extends('layouts.master')
@section('main')
    <div class="container-fluid w-75 py-5">

        <form id="template-form" action="{{ route('template.importParticipants.post', $programId) }}"
            enctype="multipart/form-data" method="POST" class="row g-4 row-cols-md-1">
            @csrf

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
