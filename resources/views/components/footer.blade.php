{{-- <footer>
    &copy; created by Ali Bin Shoaib. {{ date('Y') }}
</footer> --}}

<!-- Footer -->
<div class="footer bg-gray border-top">
    <img class="decoration-circles" src="{{ asset('images/decoration-circles.png') }}" alt="alternative">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h4 class="text-capitalize">certify Pro </h4>
                <div class="social-container">
                    <span class="fa-stack">
                        <a href="#your-link">
                            <i class="fas fa-circle fa-stack-2x"></i>
                            <i class="fab fa-facebook-f fa-stack-1x"></i>
                        </a>
                    </span>
                    <span class="fa-stack">
                        <a href="#your-link">
                            <i class="fas fa-circle fa-stack-2x"></i>
                            <i class="fab fa-twitter fa-stack-1x"></i>
                        </a>
                    </span>
                    <span class="fa-stack">
                        <a href="#your-link">
                            <i class="fas fa-circle fa-stack-2x"></i>
                            <i class="fab fa-pinterest-p fa-stack-1x"></i>
                        </a>
                    </span>
                    <span class="fa-stack">
                        <a href="#your-link">
                            <i class="fas fa-circle fa-stack-2x"></i>
                            <i class="fab fa-instagram fa-stack-1x"></i>
                        </a>
                    </span>
                    <span class="fa-stack">
                        <a href="#your-link">
                            <i class="fas fa-circle fa-stack-2x"></i>
                            <i class="fab fa-youtube fa-stack-1x"></i>
                        </a>
                    </span>
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
            <div class="col-lg-6 col-md-12 col-sm-12">
                <ul class="list-unstyled li-space-lg p-small">
                    <li><a href="{{ route('members.index') }}">الأعضاء</a></li>
                    <li><a href="{{ route('programs.index') }}">الدورات</a></li>
                    <li><a href="{{ route('participants.index') }}">المشاركين</a></li>
                    <li><a href="{{ route('trainers.index') }}">المدربين</a></li>
                    <li><a href="{{ route('categories.index') }}">التصنيفات</a></li>
                </ul>
            </div> <!-- end of col -->
            <div class="col-lg-3 col-md-12 col-sm-12">
                <p class="p-small statement">جميع الحقوق محفوظة © <a href="#">علي بن شعيب</a></p>
            </div> <!-- end of col -->

            <div class="col-lg-3 col-md-12 col-sm-12">
                {{-- <p class="p-small statement">Distributed by <a href="https://themewagon.com/" target="_blank">Themewagon</a></p> --}}
            </div> <!-- end of col -->
        </div> <!-- enf of row -->
    </div> <!-- end of container -->
</div> <!-- end of copyright -->
<!-- end of copyright -->


<!-- Back To Top Button -->
<button onclick="topFunction()" id="myBtn">
    <img src="{{ asset('images/up-arrow.png') }}" alt="alternative">
</button>
<!-- end of back to top button -->
