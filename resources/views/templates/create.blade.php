@extends('layouts.master')
@section('main')
    <div class="container-fluid w-75 py-5">

        <form id="template-form" action="{{ route('template.store', $programId) }}" enctype="multipart/form-data" method="POST"
            class="row g-4 row-cols-md-1">
            @csrf
            <h1 class="text-decoration-underline text-center">ملفات الشهادة</h1>

            <div class="input-group custom-file-button mt-0">
                <label class="input-group-text" for="template-image">قالب الشهادة</label>
                <input type="file" class="form-control" name="template-image" id="template-image" accept="image/*">
            </div>
            <small class="fw-bold mt-0 ms-3 mb-5 text-success">
                <i class="fas fa-info-circle"></i> يمكنك رفع صورة بأي أبعاد، سيتم تعديلها تلقائياً للتناسب مع متطلبات النظام
            </small>


            <div class="input-group custom-file-button mt-0">
                <label class="input-group-text" for="signature-image">التوقيع</label>
                <input type="file" class="form-control" name="signature-image" id="signature-image" accept="image/*">
            </div>
            <small class="fw-bold mt-0 ms-3 mb-5 text-success">
                <i class="fas fa-info-circle"></i> يمكنك رفع صورة بأي أبعاد، سيتم تعديلها تلقائياً للتناسب مع متطلبات النظام
            </small>

            <div class="col mt-0" id="text-editor">

                <div>
                    <small class="fw-bold  "> <span class="text-danger"> *ملاحظة: يرجى عدم تعديل الأقواس أو ما بداخلها كي لا يحصل أي خطأ</small>

                    <textarea id="editor" class="form-control" name="template-text"> </textarea>
                </div>
            </div>
            <div class="text-center">

                <button type="button" onclick="submitForm()" class="btn-solid-reg w-50">تأكيد</button>
            </div>


        </form>
    </div>
@endsection

@section('script')
    <script src="{{ asset('js/textEditor.js') }}"></script>
@endsection
