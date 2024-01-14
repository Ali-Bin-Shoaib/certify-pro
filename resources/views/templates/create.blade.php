@extends('layouts.master')
@section('main')
    <div class="container my-5 py-5 ">

        <form action="{{ route('template.store', $programId) }}" enctype="multipart/form-data" method="POST" class="row g-4 ">
            @csrf
            <h1 class="text-decoration-underline text-center">ملفات الشهادة</h1>

            <div class="input-group custom-file-button">
                <label class="input-group-text" for="template-image">قالب الشهادة</label>
                <input type="file" class="form-control" name="template-image" id="template-image"
                accept="image/*"
                    placeholder="اختر قالب الشهادة">
            </div>

            <div class="input-group custom-file-button">
                <label class="input-group-text" for="signature-image">التوقيع</label>
                <input type="file" class="form-control" name="signature-image" id="signature-image"
                accept="image/*"
                    placeholder="اختر قالب الشهادة">
            </div>
            <div class="text-center">

                <button class="btn-solid-reg w-50">تأكيد</button>
            </div>
        </form>
    </div>
@endsection
