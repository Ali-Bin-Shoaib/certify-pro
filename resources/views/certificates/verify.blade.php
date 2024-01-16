@extends('layouts.master')
@section('title', 'تحقق من أصالة الشهادة')

@section('main')
    <div class="container-fluid w-75 py-5">
        <h1 class="text-decoration-underline text-center">التحقّق من أصالة الشهادة</h1>
        <form class="container w-75 shadow-sm my-5 p-5 form-bg">
            @csrf
            <h4 class="text-decoration-underline text-center">أدخل رقم الشهادة للتّحقّق</h4>
            <div class="row g-3 my-3">
                <input class=" form-control" type="text" name="certificate_id" id="certificate_id" required>
            </div>

            <div class="row g-5">
                <div class="col-md-3"></div>
                <button class="col-md-6 btn-solid-sm">تحقّق </button>
            </div>
        </form>
        @isset($program)
            @isset($participant)
                @isset($certificate)
                @endisset

            @endisset

        @endisset
</div>@endsection
