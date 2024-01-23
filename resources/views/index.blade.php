@extends('layouts.master')
@section('main')
    <!-- Header -->
    <header id="header" class="header">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-xl-5">
                    <div class="text-container">
                        <h1 class="h1 fw-bold text-black text-start mb-5">
                            "{{ config('app.name') }}" يسهِّل عليك إصدار الشهادات بسهولة لبرامجك ودوراتك التدريبية.


                        </h1>
                        {{-- <p class="p-large text-start">مرحبًا بك في "{{config('app.name')}}"،
                            نحن هنا لمساعدتك في تسهيل وتوثيق عملية إصدار الشهادات للمشاركين في برامجكم
                            ودوراتكم. ابدأ اليوم واستخدم "{{config('app.name')}}" لإصدار الشهادات
                            المحترفة بكفاءة ودقة.
                        </p> --}}
                        <a class="btn-solid-lg mt-5" href="{{ route('programs.create') }}">إضافة دورة</a>
                    </div> <!-- end of text-container -->
                </div> <!-- end of col -->
                <div class="col-lg-6 col-xl-7">
                    <div class="image-container">
                        <img class="img-fluid" src="{{ asset('images/certificate-icon.png') }}" alt="alternative">
                    </div> <!-- end of image-container -->
                </div> <!-- end of col -->
            </div> <!-- end of row -->
        </div> <!-- end of container -->
    </header> <!-- end of header -->
    <!-- end of header -->


    <!-- Services -->
    <div id="services" class="cards-1 bg-gray">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2>استكشف خدماتنا</h2>
                </div> <!-- end of col -->
            </div> <!-- end of row -->
            <div class="row">
                <div class="col-lg-12">
                    <!-- Card -->
                    <div class="card">
                        <div class="card-icon green">
                            <span class="fas fa-award"></span>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">إصدار شهادة</h5>
                            <p>نقدم خدمات تصميم شهادات الدورات المخصصة وفقًا لمتطلباتك، مع إمكانية تخصيص النص
                                والتصميم لإبراز هوية المؤسسة الخاصة بك.</p>
                            <a class="read-more no-line" href="article.html">المزيد <span
                                    class="fas fa-long-arrow-alt-left"></span></a>
                        </div>
                    </div>
                    <!-- end of card -->

                    <!-- Card -->
                    <div class="card">
                        <div class="card-icon green">
                            <span class="fas fa-check"></span>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">التحقق من أصالة الشهادة</h5>
                            <p>توفر المنصة إمكانية التحقق من أصالة أي شهادة عن طريق إدخال الرقم الخاص بالشهادة أو عن طريق
                                مسح الQr code الخاص بكل شهادة.</p>
                            <a class="read-more no-line" href="article.html">المزيد <span
                                    class="fas fa-long-arrow-alt-left"></span></a>
                        </div>
                    </div>
                    <!-- end of card -->

                    <!-- Card -->
                    <div class="card">
                        <div class="card-icon">
                            <span class="fas fa-book-open"></span>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title"> إدارة الدورات</h5>
                            <p>
                                تستطيع تسجيل جميع الدورات التي قامت بها المؤسسة ومراجعتها في أي وقت.
                            </p>
                            <a class="read-more no-line" href="article.html">المزيد <span
                                    class="fas fa-long-arrow-alt-left"></span></a>
                        </div>
                    </div>
                    <!-- end of card -->
                    <!-- Card -->
                    <div class="card">
                        <div class="card-icon">
                            <span class="fas fa-users"></span>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title"> إدارة المشاركين</h5>
                            <p> نوفر واجهة سهلة الاستخدام لتسجيل و مراجعة المشاركين في كل دورة.</p>
                            <a class="read-more no-line" href="article.html">المزيد <span
                                    class="fas fa-long-arrow-alt-left"></span></a>
                        </div>
                    </div>
                    <!-- end of card -->
                    <!-- Card -->
                    <div class="card">
                        <div class="card-icon">
                            <span class="fas fa-user-tie "></span>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title"> إدارة المدربين</h5>
                            <p> نمكنكم من حفظ معلومات جميع المدربين الذين قاموا بتقديم دورات لمنظمتكم.</p>
                            <a class="read-more no-line" href="article.html">المزيد <span
                                    class="fas fa-long-arrow-alt-left"></span></a>
                        </div>
                    </div>
                    <!-- end of card -->

                    <!-- Card -->
                    <div class="card">
                        <div class="card-icon red">
                            <span class="fas fa-tag"></span>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">إدارة التصنيفات</h5>
                            <p>يمكنك تنظيم الدورات والشهادات في تصنيفات مختلفة لتسهيل الوصول إليها وتنظيمها بشكل فعال.</p>
                            <a class="read-more no-line" href="article.html">المزيد <span
                                    class="fas fa-long-arrow-alt-left"></span></a>
                        </div>
                    </div>
                    <!-- end of card -->


                </div> <!-- end of col -->
            </div> <!-- end of row -->
        </div> <!-- end of container -->
    </div> <!-- end of cards-1 -->
    <!-- end of services -->


    <!-- Details 1 -->
    <div id="details" class="basic-1">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-xl-7">
                    <div class="image-container">
                        <img class="img-fluid" src="{{ asset('images/cert2.png') }}" alt="alternative">
                    </div> <!-- end of image-container -->
                </div> <!-- end of col -->
                <div class="col-lg-6 col-xl-5">
                    <div class="text-container">
                        <div class="section-title">ما نقوم به</div>
                        <h2>تصميم شهادة لكل دورة بكل يسر و سهولة</h2>
                        <p>عن طريق إضافة معلومات الدورة و معلومات المشاركين في الدورة تستطيع تصميم وإصدار شهادة لكل مشارك.
                        </p>
                        <a class="btn-solid-reg" href="#contact">إصدار شهادة</a>
                    </div> <!-- end of text-container -->
                </div> <!-- end of col -->
            </div> <!-- end of row -->
        </div> <!-- end of container -->
    </div> <!-- end of basic-1 -->
    <!-- end of details 1 -->


    <!-- Details 2 -->
    <div class="basic-2">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-xl-5">
                    <div class="text-container">
                        <div class="section-title">من نحن</div>
                        <h2>نسعى لتسهيل عملية إصدار الشهادات بطريقة مبتكرة وفعالة</h2>
                        <p> نقوم بتوفير واجهة سهلة الاستخدام
                            تمكنكم من إضافة معلومات الدورة ومعلومات المشاركين بسهولة، واختيار قالب الشهادة المناسب.</p>
                    </div> <!-- end of text-container -->
                </div> <!-- end of col -->
                <div class="col-lg-6 col-xl-7">
                    <div class="image-container">
                        <img class="img-fluid shadow-sm" src="{{ asset('images/details-2.jpg') }}" alt="alternative">
                    </div> <!-- end of image-container -->
                </div> <!-- end of col -->
            </div> <!-- end of row -->
        </div> <!-- end of container -->
    </div> <!-- end of basic-2 -->
    <!-- end of details 2 -->


    <!-- Features -->
    <div id="features" class="accordion-1">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <h2 class="h2-heading">
                        ميّزات خدمة إصدار الشهادات عبر الإنترنت


                    </h2>
                    <p class="p-heading">توفر خدمتنا لإصدار الشهادات عبر الإنترنت الميزات التالية</p>
                </div> <!-- end of col -->
            </div> <!-- end of row -->
            <div class="row align-items-center">
                <div class="col-xl-5">

                    <ul class="text-white fs-3 d-flex flex-column gap-5 list-unstyled">
                        <li> <i class="fa-solid fa-gears ms-3"></i>تخصيص سهل</li>
                        <li><i class="fa-solid fa-check ms-3"></i>واجهة سهلة الإستخدام</li>
                        <li><i class="fa-solid fa-print ms-3"></i>خيارات تسليم مرنة</li>
                    </ul>
                </div> <!-- end of col -->
                <div class="col-xl-7">
                    <div class="image-container">
                        <img class="img-fluid" src="{{ asset('images/features.png') }}" alt=alternative>
                    </div> <!-- end of image-container -->
                </div> <!-- end of col -->
            </div> <!-- end of row -->
        </div> <!-- end of container -->
    </div> <!-- end of accordion-1 -->
    <!-- end of features -->




    <!-- Invitation -->
    <div class="basic-3">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="text-container">
                        <h2>انضم إلينا الآن واستفد من جميع المميزات </h2>
                        <p class="p-large"> قم بالتسجيل الآن واحصل على القدرة على إنشاء شهادات احترافية وجذابة في ثوانٍ
                            معدودة.

                        </p>
                        <a class="btn-solid-lg" href="{{ route('signup') }}">سجل الآن</a>
                    </div> <!-- end of text-container -->
                </div> <!-- end of col -->
            </div> <!-- end of row -->
        </div> <!-- end of container -->
    </div> <!-- end of basic-3 -->
    <!-- end of invitation -->


    <!-- end of contact -->
@endsection
