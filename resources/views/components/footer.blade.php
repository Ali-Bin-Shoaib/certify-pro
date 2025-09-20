{{-- <footer>
    &copy; created by Ali Bin Shoaib. {{ date('Y') }}
</footer> --}}

<!-- Footer -->
<div class="footer bg-gray">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <h4 class="text-capitalize mb-4">Certify Pro</h4>
                <p class="mb-4">منصة متكاملة لإدارة الدورات التدريبية وإصدار الشهادات بسهولة ومرونة عالية</p>
                <div class="social-container d-flex justify-content-center flex-wrap gap-3">
                    <a href="https://www.facebook.com/certifyPro" class="fa-stack" title="فيسبوك">
                        <i class="fas fa-circle fa-stack-2x"></i>
                        <i class="fab fa-facebook-f fa-stack-1x"></i>
                    </a>
                    <a href="https://twitter.com/certifyPro" class="fa-stack" title="تويتر">
                        <i class="fas fa-circle fa-stack-2x"></i>
                        <i class="fa-brands fa-x-twitter fa-stack-1x"></i>
                    </a>
                    <a href="https://www.pinterest.com/certifyPro" class="fa-stack" title="بينتيريست">
                        <i class="fas fa-circle fa-stack-2x"></i>
                        <i class="fab fa-pinterest-p fa-stack-1x"></i>
                    </a>
                    <a href="https://www.instagram.com/certifyPro" class="fa-stack" title="إنستغرام">
                        <i class="fas fa-circle fa-stack-2x"></i>
                        <i class="fab fa-instagram fa-stack-1x"></i>
                    </a>
                    <a href="https://www.youtube.com/c/certifyPro" class="fa-stack" title="يوتيوب">
                        <i class="fas fa-circle fa-stack-2x"></i>
                        <i class="fab fa-youtube fa-stack-1x"></i>
                    </a>
                </div> <!-- end of social-container -->
            </div> <!-- end of col -->
        </div> <!-- end of row -->
    </div> <!-- end of container -->
</div> <!-- end of footer -->
<!-- end of footer -->


<!-- Copyright -->
<div class="copyright bg-gray">
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-6 mb-3 mb-lg-0">
                <h6 class="mb-3">روابط سريعة</h6>
                <ul class="list-unstyled li-space-lg p-small d-flex flex-wrap gap-3">
                    <li><a href="{{ route('members.index') }}" class="text-decoration-none">الأعضاء</a></li>
                    <li><a href="{{ route('programs.index') }}" class="text-decoration-none">الدورات</a></li>
                    <li><a href="{{ route('participants.index') }}" class="text-decoration-none">المشاركين</a></li>
                    <li><a href="{{ route('trainers.index') }}" class="text-decoration-none">المدربين</a></li>
                    <li><a href="{{ route('categories.index') }}" class="text-decoration-none">التصنيفات</a></li>
                </ul>
            </div> <!-- end of col -->
            <div class="col-12 col-lg-6 text-center text-lg-end">
                <p class="p-small statement mb-0">
                    جميع الحقوق محفوظة © {{ date('Y') }}
                    <a href="https://github.com/ali-bin-shoaib" class="text-black fw-bold"
                       rel="external" target="_blank">Certify Pro</a>
                </p>
            </div> <!-- end of col -->
        </div> <!-- end of row -->
    </div> <!-- end of container -->
</div> <!-- end of copyright -->
<!-- end of copyright -->


<!-- Back To Top Button -->
<button onclick="topFunction()" id="myBtn">
    <img src="{{ asset('images/up-arrow.png') }}" alt="alternative">
</button>
<!-- end of back to top button -->
