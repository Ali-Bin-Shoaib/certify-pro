@extends('layouts.master')
@section('main')
    <div class="container-fluid w-75 py-5">

        <form id="template-form" action="{{ route('template.store', $programId) }}" enctype="multipart/form-data" method="POST"
            class="row g-4 row-cols-md-1">
            @csrf
            <h1 class="text-decoration-underline text-center">ملفات الشهادة</h1>

            <small class="fw-bold"> أبعاد قالب الشهادة يجب أن تكون بطول 793 بكسل وعرض 1116 بكسل. لتغير أبعاد الصورة <a
                    href="https://imageresizer.com/" target="_black">اضغط هنا</a></small>
            <div class="input-group custom-file-button mt-0">
                <label class="input-group-text" for="template-image">قالب الشهادة</label>
                <input type="file" class="form-control" name="template-image" id="template-image" accept="image/*">
            </div>

            <small class="fw-bold"> التوقيع يجب أن يكون بطول 103 بكسل وعرض 200 بكسل. لتغير أبعاد الصورة <a
                    href="https://imageresizer.com/" target="_black">اضغط هنا</a></small>

            <div class="input-group custom-file-button mt-0">
                <label class="input-group-text" for="signature-image">التوقيع</label>
                <input type="file" class="form-control" name="signature-image" id="signature-image" accept="image/*">
            </div>

            <div class="col">
                <div>

                    <textarea id="editor" class="form-control" name="template-text"> </textarea>
                </div>
            </div>
            <div class="text-center">

                <button type="button" onclick="submitForm()" class="btn-solid-reg w-50">تأكيد</button>
            </div>

            {{-- <div class="col">
                <textarea>
  Welcome to TinyMCE!
</textarea>
            </div> --}}
        </form>
    </div>
@endsection

@section('script')
    <script src="{{asset('js/textEditor.js')}}">
    </script>
@endsection
