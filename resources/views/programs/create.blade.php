@extends('layouts.master')
@section('title', 'إضافة دورة')
@section('main')
    <div class="container-fluid w-75 py-5">
        <h1 class="text-decoration-underline text-center">إضافة دورة</h1>
        <form method="POST" action="{{ route('programs.store') }}" class="container w-75 shadow-sm my-5 p-5 form-bg">
            {{-- Session::get('error'); --}}
            {{-- @if ($errors)

                @foreach ($errors as $error)

                @endforeach
            @endif --}}
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
            <h4 class="text-decoration-underline">معلومات المدرب </h4>
            <div class="row g-3 my-3">
                <label class=" form-label col-md-2" for="name">اختر مدرب </label>
                <div class="col-md-9  pe-0">
                    <select name="selectedTrainer" id="selectedTrainer" class="form-control ">
                        <option disabled selected value="">اختر مدرب </option>
                        @foreach ($trainers as $trainer)
                            <option value="{{ $trainer->id }}">{{ $trainer->name }}</option>
                        @endforeach
                    </select>

                </div>
                <div class="input-group-append col-md-1 pe-0">
                    <button class="btn btn-secondary" type="button" id="clearButton">مسح</button>
                </div>
            </div>
            <div class="row g-3 my-3">
                <label class="col-md-2 form-label" for="name">اسم المدرب</label>
                <div class="col-md-10">
                    <input class=" form-control" type="text" name="name" id="name" required>
                </div>
            </div>
            <div class="row g-3 my-3">
                <label class="col-md-2 form-label" for="gender">الجنس</label>
                <div class="col-md-10">
                    <select name="gender" id="gender" class="form-select" required>
                        <option>أنثى</option>
                        <option>ذكر</option>
                    </select>
                </div>
            </div>
            <div class="row g-3 my-3">
                <label class="col-md-2 form-label" for="phone">رقم الجوال</label>
                <div class=" col-md-10">

                    <input class="form-control" type="tel" name="phone" id="phone" required>
                </div>
            </div>



            <div class="row g-5">
                <div class="col-md-3"></div>
                <button class="col-md-6 btn-solid-sm">إضافة </button>
            </div>
        </form>
    </div>
    <script>
        $('#selectedTrainer').on('change', function() {
            var trainerId = $(this).val();
            disableTrainerInputs(trainerId);
        });

        function disableTrainerInputs(trainerId) {
            @foreach ($trainers as $trainer)
                if ({{ $trainer->id }} == trainerId) {
                    $('#name').val(`{{ $trainer->name }}`)
                    $('#phone').val(`{{ $trainer->phone }}`)
                    $('#gender ').val('{{ $trainer->gender }}');
                    $('#name,#gender,#phone').prop({
                        readonly: true,
                        disabled: true
                    });;
                }
            @endforeach

        }

        function enableTrainerInputs() {
            $('#selectedTrainer').val('');
            $('#name').val('')
            $('#phone').val('')
            $('#gender ').val('');
            $('#name,#gender,#phone').prop({
                readonly: false,
                disabled: false
            });;


        }
        $("#clearButton").on("click", function() {

            enableTrainerInputs();
        });
    </script>
@endsection
