@extends('layouts.master')

@section('main')
    <div class="basic-1">

        <div class="container ">
            <form action="" class="container w-75 shadow-sm">
                <div class="row g-3 my-3">
                    <label class="col-md-2 form-label" for="organization-name">اسم المنظمة</label>
                    <div class="col-md-10">
                        <input class=" form-control" type="text" name="organization-name" id="organization-name" required>
                    </div>
                </div>
                <div class="row g-3 my-3">
                    <label class="col-md-2 form-label" for="email">الإيميل</label>
                    <div class=" col-md-10">

                        <input class="form-control" type="email" name="email" id="email" required>
                    </div>
                </div>
                <div class="row g-3 my-3">
                    <label class="col-md-2 form-label" for="password">كلمة المرور</label>
                    <div class=" col-md-10">

                        <input class="form-control" type="password" name="password" id="password" required>
                    </div>
                </div>
                <div class="row g-3 my-3">
                    <label class="col-md-2 form-label" for="phone">رقم الجوال</label>
                    <div class=" col-md-10">

                        <input class="form-control" type="text" name="phone" id="phone" required>
                    </div>
                </div>
                <div class="row g-3 my-3">
                    <label class="col-md-2 form-label" for="address">الموقع</label>
                    <div class=" col-md-10">

                        <input class="form-control" type="text" name="address" id="address" required>
                    </div>
                </div>
                <div class="row g-3 my-3">
                    <label class="col-md-2 form-label" for="cid">رقم السجل التجاري</label>
                    <div class=" col-md-10">

                        <input class="form-control" type="text" name="cid" id="cid" required>
                    </div>
                </div>
                <div class="row g-5">
                    <div class="col-md-3"></div>
                    <button class="col-md-6 btn btn-secondary">إنشاء حساب</button>
                </div>
            </form>
        </div>
    </div>
@endsection
