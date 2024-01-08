@extends('layouts.master')
@section('title', 'إضافة دورة')
@section('main')
    <div class="container py-5">
        <h1 class="text-decoration-underline text-center">إضافة دورة</h1>
        <form method="POST" action="{{ route('programs.store') }}" class="container w-75 shadow-sm my-5 p-5 form-bg">
            @csrf
            <h4 class="text-decoration-underline">معلومات الدورة</h4>
            <div class="row g-3 my-3">
                <label class="col-md-2 form-label" for="title">عنوان الدورة</label>
                <div class="col-md-10">
                    <input class=" form-control" type="text" name="title" id="title" required>
                </div>
            </div>
            <div class="row g-3 my-3">
                <label class="col-md-2 form-label" for="location">الموقع</label>
                <div class=" col-md-10">

                    <input class="form-control" type="text" name="location" id="location" required>
                </div>
            </div>
            <div class="row g-3 my-3">
                <label class="col-md-2 form-label" for="start_date">تاريخ بداية الدورة</label>
                <div class=" col-md-10">

                    <input class="form-control" type="date" name="start_date" id="start_date" value="{{ date('Y-m-d') }}"
                        required>
                </div>
            </div>
            <div class="row g-3 my-3">
                <label class="col-md-2 form-label" for="end_date">تاريخ نهاية الدورة</label>
                <div class=" col-md-10">

                    <input class="form-control" type="date" name="end_date" id="end_date"
                        value="{{ date('Y-m-d', strtotime('+1 week')) }}" required>
                </div>
            </div>
            <div class="row g-3 my-3">
                <label class="col-md-2 form-label" for="category_id">التصنيف</label>
                <div class=" col-md-10">
                    <select name="category_id" id="category_id" class="form-select">
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->title }}</option>
                        @endforeach
                    </select>

                </div>
            </div>
            {{-- <div class="row g-3 my-2">
                <div class="col-md-1"></div>
                <div class="form-check col-md-9">
                    <input class="form-check-input" type="checkbox" id="addParticipants" name="addParticipants">
                    <label class="form-check-label" for="addParticipants">
                        إضافة مشاركين للدورة؟
                    </label>
                </div>
            </div> --}}

            <div class="row g-5">
                <div class="col-md-3"></div>
                <button class="col-md-6 btn-solid-sm">إضافة </button>
            </div>
        </form>
    </div>
    {{-- <script>
        $(function() {
            //   const addParticipants = $('#addParticipants'); 
            $('#addParticipants').on('click', function() {
                console.log($('#addParticipants').val());
                if ($('#addParticipants').val() == 'on')
                    showNumberInput();
                // showParticipantInput();
                else
                    hideParticipantInput();
            });

            function showNumberInput() {
                $('#addParticipants').parent().parent().after(`
                            <div class="row g-3 my-3" participantNumber>
                <label class="col-md-2 form-label" for="participantsNumber">أدخل عدد المشاركين </label>
                <div class=" col-md-10 d-flex">

                    <input class="form-control " type="text" name="participantsNumber"  id="participantsNumber" required>
                    <button class="btn btn-danger" id> delete</button>
                </div>
            </div>

                `)
                // console.log($('addParticipants').parent())
            }

            function deleteElement() {
                this.parent().parent().remove();
            }

            function showParticipantInput() {
                const participantsContainer = document.querySelect('#participantsContainer');
                // participantsContainer.innerHTML = ``

            }

            function hideParticipantInput() {
                $(`[name='name[]']`).remove();
            }

        })
    </script> --}}
@endsection
