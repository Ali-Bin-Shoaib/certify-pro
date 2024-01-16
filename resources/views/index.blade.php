@extends('layouts.master')
@section('main')
    <!-- Header -->
    <header id="header" class="header">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-xl-5">
                    <div class="text-container">
                        <h1 class="h1 fw-bold text-black text-start">
                            "{{config('app.name')}}" يسهِّل عليك إصدار الشهادات بسهولة لبرامجك ودوراتك التدريبية.


                        </h1>
                        <p class="p-large text-start">مرحبًا بك في "{{config('app.name')}}"،
                            نحن هنا لمساعدتك في تسهيل وتوثيق عملية إصدار الشهادات للمشاركين في برامجكم
                            ودوراتكم. ابدأ اليوم واستخدم "{{config('app.name')}}" لإصدار الشهادات
                            المحترفة بكفاءة ودقة.
                        </p>
                        <a class="btn-solid-lg" href="{{ route('programs.create') }}">إضافة دورة</a>
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

                    <!-- Card -->
                    <div class="card">
                        <div class="card-icon green">
                            <span class="fas fa-award"></span>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">تصميم شهادة</h5>
                            <p>نقدم خدمات تصميم شهادات الدورات المخصصة وفقًا لمتطلباتك، مع إمكانية تخصيص النص والشعار
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
                    <div class="accordion" id="accordionExample">

                        <!-- Accordion Item -->
                        <div class="accordion-item ">
                            {{-- <div class="accordion-icon ">
                                <span class="fas fa-tv"></span>
                            </div> <!-- end of accordion-icon --> --}}
                            <div class="accordion-header" id="headingOne">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    تخصيص سهل </button>
                            </div> <!-- end of accordion-header -->
                            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">قم بتخصيص وتصميم الشهادات المهنية بسهولة وفقًا لاحتياجاتك.
                                    يمكنك إضافة شعار منظمتك، واختيار من بين مجموعة متنوعة من القوالب، وتخصيص الشهادة بتفاصيل
                                    المستلم.</div>
                            </div> <!-- end of accordion-collapse -->
                        </div> <!-- end of accordion-item -->
                        <!-- end of accordion-item -->

                        <!-- Accordion Item -->
                        <div class="accordion-item">
                            {{-- <div class="accordion-icon blue">
                                <span class="fas fa-microphone"></span>
                            </div> <!-- end of accordion-icon --> --}}
                            <div class="accordion-header" id="headingTwo">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    واجهة سهلة الإستخدام
                                </button>
                            </div> <!-- end of accordion-header -->
                            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body"> توفر منصتنا واجهة سهلة الاستخدام تمكنك من التنقل بسلاسة
                                    وكفاءة خلال عملية إصدار الشهادات. تم تصميمها لتبسيط العملية بأكملها، بدءًا من إدخال
                                    معلومات الدورة إلى تصدير الشهادة.</div>
                            </div> <!-- end of accordion-collapse -->
                        </div> <!-- end of accordion-item -->
                        <!-- end of accordion-item -->

                        <!-- Accordion Item -->
                        <div class="accordion-item">
                            {{-- <div class="accordion-icon purple">
                                <span class="fas fa-video"></span>
                            </div> <!-- end of accordion-icon --> --}}
                            <div class="accordion-header" id="headingThree">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    ملء البيانات التلقائي
                                </button>
                            </div> <!-- end of accordion-header -->
                            <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">وفر الوقت وانخفض من الأخطاء عن طريق تلقائي ملء معلومات الشهادة.
                                    يمكن لنظامنا سحب البيانات من سجلات المشاركين وتفاصيل الدورة ومصادر أخرى، مما يقضي على
                                    الحاجة إلى إدخال البيانات يدويًا.</div>
                            </div> <!-- end of accordion-collapse -->
                        </div> <!-- end of accordion-item -->
                        <!-- end of accordion-item -->

                        <!-- Accordion Item -->
                        <div class="accordion-item">
                            {{-- <div class="accordion-icon orange">
                                <span class="fas fa-tools"></span>
                            </div> <!-- end of accordion-icon --> --}}
                            <div class="accordion-header" id="headingFour">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                    خيارات تسليم مرنة
                                </button>
                            </div> <!-- end of accordion-header -->
                            <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">اختر كيفية تسليم الشهادات. يمكنك إما تنزيل ملفات PDF و تسليمها
                                    بشكل إلكتروني أو طباعتها للتسليم الفعلي. </div>
                            </div> <!-- end of accordion-collapse -->
                        </div> <!-- end of accordion-item -->
                        <!-- end of accordion-item -->

                    </div> <!-- end of accordion -->
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


    {{-- <!-- Testimonials -->
    <div class="cards-2 bg-gray">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2 class="h2-heading">Customer testimonials</h2>
                </div> <!-- end of col -->
            </div> <!-- end of row -->
            <div class="row">
                <div class="col-lg-12">

                    <!-- Card -->
                    <div class="card">
                        <img class="quotes" src="{{ asset('images/quotes.svg') }}" alt="alternative">
                        <div class="card-body">
                            <p class="testimonial-text">Suspendisse vitae enim arcu. Aliqu convallis risus a felis blandit,
                                at mollis nisi bibendum aliquam noto ricos</p>
                            <div class="testimonial-author">Roe Smith</div>
                            <div class="occupation">General Manager, Presentop</div>
                        </div>
                        <div class="gradient-floor red-to-blue"></div>
                    </div>
                    <!-- end of card -->

                    <!-- Card -->
                    <div class="card">
                        <img class="quotes" src="{{ asset('images/quotes.svg') }}" alt="alternative">
                        <div class="card-body">
                            <p class="testimonial-text">Suspendisse vitae enim arcu. Aliqu convallis risus a felis blandit,
                                at mollis nisi bibendum aliquam noto ricos</p>
                            <div class="testimonial-author">Sam Bloom</div>
                            <div class="occupation">General Manager, Presentop</div>
                        </div>
                        <div class="gradient-floor blue-to-purple"></div>
                    </div>
                    <!-- end of card -->

                    <!-- Card -->
                    <div class="card">
                        <img class="quotes" src="{{ asset('images/quotes.svg') }}" alt="alternative">
                        <div class="card-body">
                            <p class="testimonial-text">Suspendisse vitae enim arcu. Aliqu convallis risus a felis blandit,
                                at mollis nisi bibendum aliquam noto ricos</p>
                            <div class="testimonial-author">Bill McKenzie</div>
                            <div class="occupation">General Manager, Presentop</div>
                        </div>
                        <div class="gradient-floor purple-to-green"></div>
                    </div>
                    <!-- end of card -->

                    <!-- Card -->
                    <div class="card">
                        <img class="quotes" src="{{ asset('images/quotes.svg') }}" alt="alternative">
                        <div class="card-body">
                            <p class="testimonial-text">Suspendisse vitae enim arcu. Aliqu convallis risus a felis blandit,
                                at mollis nisi bibendum aliquam noto ricos</p>
                            <div class="testimonial-author">Vanya Dropper</div>
                            <div class="occupation">General Manager, Presentop</div>
                        </div>
                        <div class="gradient-floor red-to-blue"></div>
                    </div>
                    <!-- end of card -->

                    <!-- Card -->
                    <div class="card">
                        <img class="quotes" src="{{ asset('images/quotes.svg') }}" alt="alternative">
                        <div class="card-body">
                            <p class="testimonial-text">Suspendisse vitae enim arcu. Aliqu convallis risus a felis blandit,
                                at mollis nisi bibendum aliquam noto ricos</p>
                            <div class="testimonial-author">Lefty Brown</div>
                            <div class="occupation">General Manager, Presentop</div>
                        </div>
                        <div class="gradient-floor blue-to-purple"></div>
                    </div>
                    <!-- end of card -->

                    <!-- Card -->
                    <div class="card">
                        <img class="quotes" src="{{ asset('images/quotes.svg') }}" alt="alternative">
                        <div class="card-body">
                            <p class="testimonial-text">Suspendisse vitae enim arcu. Aliqu convallis risus a felis blandit,
                                at mollis nisi bibendum aliquam noto ricos</p>
                            <div class="testimonial-author">Susane Blake</div>
                            <div class="occupation">General Manager, Presentop</div>
                        </div>
                        <div class="gradient-floor purple-to-green"></div>
                    </div>
                    <!-- end of card -->

                </div> <!-- end of col -->
            </div> <!-- end of row -->
        </div> <!-- end of container -->
    </div> <!-- end of cards-2 -->
    <!-- end of testimonials -->
 --}}

    {{-- <!-- Customers -->
    <div class="slider-1">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h4>Trusted by over <span class="blue">5000</span> customers worldwide</h4>
                    <hr class="section-divider">

                    <!-- Image Slider -->
                    <div class="slider-container">
                        <div class="swiper-container image-slider">
                            <div class="swiper-wrapper">
                                <div class="swiper-slide">
                                    <img class="img-fluid" src="{{ asset('images/customer-logo-1.png') }}"
                                        alt="alternative">
                                </div>
                                <div class="swiper-slide">
                                    <img class="img-fluid" src="{{ asset('images/customer-logo-2.png') }}"
                                        alt="alternative">
                                </div>
                                <div class="swiper-slide">
                                    <img class="img-fluid" src="{{ asset('images/customer-logo-3.png') }}"
                                        alt="alternative">
                                </div>
                                <div class="swiper-slide">
                                    <img class="img-fluid" src="{{ asset('images/customer-logo-4.png') }}"
                                        alt="alternative">
                                </div>
                                <div class="swiper-slide">
                                    <img class="img-fluid" src="{{ asset('images/customer-logo-5.png') }}"
                                        alt="alternative">
                                </div>
                                <div class="swiper-slide">
                                    <img class="img-fluid" src="{{ asset('images/customer-logo-6.png') }}"
                                        alt="alternative">
                                </div>
                            </div> <!-- end of swiper-wrapper -->
                        </div> <!-- end of swiper container -->
                    </div> <!-- end of slider-container -->
                    <!-- end of image slider -->

                </div> <!-- end of col -->
            </div> <!-- end of row -->
        </div> <!-- end of container -->
    </div> <!-- end of slider-1 -->
    <!-- end of customers --> --}}


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


    <!-- Contact -->
    {{-- <div id="contact" class="form-1">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="text-container">
                        <div class="section-title">GET QUOTE</div>
                        <h2>Submit the form for quote</h2>
                        <p>Aliquam et enim vel sem pulvinar suscipit sit amet quis lorem. Sed risus ipsum, egestas sed odio
                            in, pulvinar euismod ipsum. Sed ut enim non nunc fermentum dictum et sit amet erat. Maecenas</p>
                        <ul class="list-unstyled li-space-lg">
                            <li class="d-flex">
                                <i class="fas fa-square"></i>
                                <div class="flex-grow-1">Vel maximus nunc aliquam ut. Donec semper, magna a pulvinar</div>
                            </li>
                            <li class="d-flex">
                                <i class="fas fa-square"></i>
                                <div class="flex-grow-1">Suscipit sit amet quis lorem. Sed risus ipsum, egestas mare</div>
                            </li>
                            <li class="d-flex">
                                <i class="fas fa-square"></i>
                                <div class="flex-grow-1">Sem pulvinar suscipit sit amet quis lorem. Sed risus</div>
                            </li>
                        </ul>
                    </div> <!-- end of text-container -->
                </div> <!-- end of col -->
                <div class="col-lg-6">

                    <!-- Contact Form -->
                    <form>
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="اسم المنظمة" required>
                        </div>
                        <div class="form-group">
                            <input type="email" class="form-control" dir="rtl" placeholder="الإيميل" required>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="كلمة المرور" required>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control " placeholder="العنوان" required>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="form-control btn btn-primary btn-lg rounded-5">Submit</button>
                        </div>
                    </form>
                    <!-- end of contact form -->

                </div> <!-- end of col -->
            </div> <!-- end of row -->
        </div> <!-- end of container -->
    </div> <!-- end of form-1 --> --}}
    <!-- end of contact -->
@endsection
