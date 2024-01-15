@extends('layouts.master')
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Trumbowyg/2.27.3/trumbowyg.min.js" integrity="sha512-YJgZG+6o3xSc0k5wv774GS+W1gx0vuSI/kr0E0UylL/Qg/noNspPtYwHPN9q6n59CTR/uhgXfjDXLTRI+uIryg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> --}}
@section('main')
    <div class="container my-5 py-5 ">

        <form id="template-form" action="{{ route('template.store', $programId) }}" enctype="multipart/form-data" method="POST"
            class="row g-4 row-cols-md-1">
            @csrf
            <h1 class="text-decoration-underline text-center">ملفات الشهادة</h1>

            <div class="input-group custom-file-button">
                <label class="input-group-text" for="template-image">قالب الشهادة</label>
                <input type="file" class="form-control" name="template-image" id="template-image" accept="image/*"
                    placeholder="اختر قالب الشهادة">
            </div>

            <div class="input-group custom-file-button">
                <label class="input-group-text" for="signature-image">التوقيع</label>
                <input type="file" class="form-control" name="signature-image" id="signature-image" accept="image/*"
                    placeholder="اختر قالب الشهادة">
            </div>

            <div class="col">
                <div>

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
    <script>
        $('#editor').trumbowyg({
            btns: [
                ['viewHTML'],
                // ['undo', 'redo'], // Only supported in Blink browsers
                ['formatting'],
                ['strong', 'em', 'del'],
                ['superscript', 'subscript'],
                // ['link'],
                // ['insertImage'],
                ['justifyLeft', 'justifyCenter', 'justifyRight', 'justifyFull'],
                ['unorderedList', 'orderedList'],
                ['horizontalRule'],
                ['removeformat'],
                ['fullscreen']
            ],
            ow: true,
            lang: 'ar'
        });
        $('#editor').trumbowyg('html',
            `
<h3 style="text-align: center;">شهادة مشاركة</h3>
<h3 style="text-align: center; ">تشهد <span contenteditable="false">{اسم_المنظمة}</span> بأنّ&nbsp;</h3>
<h2 style="text-align: center; "><span contenteditable="false">{اسم_المشارك}</span></h2>
<h3 style="text-align: center; ">&nbsp;قد شارك في دورة <span contenteditable="false">{اسم_الدورة}</span> المقامة في
    <span contenteditable="false">{الموقع}</span> بتاريخ
    <span contenteditable="false">{تاريخ_البدايةوالنهاية}</span>&nbsp;
</h3>
<p><br></p>
<h2 style="text-align: left;" contenteditable="false">&nbsp; {التوقيع}</h2>
<h2 style="text-align: center;" contenteditable="false">{QR}</h2>

        `

        );
        // trumbowyg-editor
        function submitForm() {
            // Get the content of the div
            // var divContent = document.getElementById('trumbowyg-editor').innerHTML;
            const content = $('#trumbowyg-editor').html();
            console.log("🚀 ~ submitForm ~ content:", content);

            // Set the content as the value of the hidden input field
            $('#editor').html(content);
            // document.getElementById('editor').innerHTML = divContent;

            // Submit the form
            $('#template-form').submit();
        }
    </script>
@endsection
