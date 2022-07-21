<footer class="footer_three">
    <div class="footer-top bg-dark3 pt-50">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-12">
                    <div class="widget">
                        <h4 class="footer-title">About</h4>
                        <hr class="bg-primary mb-10 mt-0 d-inline-block mx-auto w-60">
                        <p class="text-capitalize mb-20">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
                            eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis
                            exercitation ullamco laboris<br><br>Duis aute irure dolor in reprehenderit in voluptate
                            velit esse cillum.</p>
                    </div>
                </div>
                <div class="col-lg-3 col-12">
                    <div class="widget">
                        <h4 class="footer-title">Contact Info</h4>
                        <hr class="bg-primary mb-10 mt-0 d-inline-block mx-auto w-60">
                        <ul class="list list-unstyled mb-30">
                            <li> <i class="fa fa-map-marker"></i> 123, Lorem Ipsum, Dummy City,<br>FL-12345 USA</li>
                            <li> <i class="fa fa-phone"></i> <span>+(1) 123-878-1649 </span><br><span>+(1) 123-878-1649
                                </span></li>
                            <li> <i class="fa fa-envelope"></i> <span>hello@multipurposethemes.com
                                </span><br><span>support@multipurposethemes.com </span></li>
                        </ul>
                    </div>
                </div>
                <div class="col-12 col-lg-3">
                    <div class="widget footer_widget clearfix">
                        <h4 class="footer-title">Our Gallery</h4>
                        <hr class="bg-primary mb-10 mt-0 d-inline-block mx-auto w-60">
                        <ul class="list-unstyled">
                            <li><a href="#">Home</a></li>
                            <li><a href="#">Instant Buy & Sell</a></li>
                            <li><a href="#">Trade</a></li>
                            <li><a href="#">Pages</a></li>
                            <li><a href="#">Blog</a></li>
                            <li><a href="#">Contact</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-12">
                    <div class="widget">
                        <h4 class="footer-title">Accept Card Payments</h4>
                        <hr class="bg-primary mb-10 mt-0 d-inline-block mx-auto w-60">
                        <ul class="payment-icon list-unstyled d-flex gap-items-1">
                            <li class="ps-0">
                                <a href="javascript:;"><i class="fa fa-cc-amex" aria-hidden="true"></i></a>
                            </li>
                            <li>
                                <a href="javascript:;"><i class="fa fa-cc-visa" aria-hidden="true"></i></a>
                            </li>
                            <li>
                                <a href="javascript:;"><i class="fa fa-credit-card-alt" aria-hidden="true"></i></a>
                            </li>
                            <li>
                                <a href="javascript:;"><i class="fa fa-cc-mastercard" aria-hidden="true"></i></a>
                            </li>
                            <li>
                                <a href="javascript:;"><i class="fa fa-cc-paypal" aria-hidden="true"></i></a>
                            </li>
                        </ul>
                        <h4 class="footer-title mt-20">Newsletter</h4>
                        <hr class="bg-primary mb-4 mt-0 d-inline-block mx-auto w-60">
                        <div class="mb-20">
                            <form class="" action="" method="post">
                                <div class="input-group">
                                    <input name="email" required="required" class="form-control"
                                        placeholder="Your Email Address" type="email">
                                    <button name="submit" value="Submit" type="submit" class="btn btn-primary"> <i
                                            class="fa fa-envelope"></i> </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-bottom bg-dark3">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6 col-12 text-md-start text-center"> © 2021 <span class="text-white"> Multipurpose
                        Themes</span> All Rights Reserved.</div>
                <div class="col-md-6 mt-md-0 mt-20">
                    <div class="social-icons">
                        <ul class="list-unstyled d-flex gap-items-1 justify-content-md-end justify-content-center">
                            <li><a href="#"
                                    class="waves-effect waves-circle btn btn-social-icon btn-circle btn-facebook"><i
                                        class="fa fa-facebook"></i></a></li>
                            <li><a href="#"
                                    class="waves-effect waves-circle btn btn-social-icon btn-circle btn-twitter"><i
                                        class="fa fa-twitter"></i></a></li>
                            <li><a href="#"
                                    class="waves-effect waves-circle btn btn-social-icon btn-circle btn-linkedin"><i
                                        class="fa fa-linkedin"></i></a></li>
                            <li><a href="#"
                                    class="waves-effect waves-circle btn btn-social-icon btn-circle btn-youtube"><i
                                        class="fa fa-youtube"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>


<!-- Vendor JS -->
<script src="{{ asset('front-end/js/vendors.min.js') }}"></script>
<!-- Corenav Master JavaScript -->
<script src="{{ asset('front-end/corenav-master/coreNavigation-1.1.3.js') }}"></script>
<script src="{{ asset('front-end/js/nav.js') }}"></script>
<script src="{{ asset('front-end/assets/vendor_components/OwlCarousel2/dist/owl.carousel.js')}}"></script>
<script src="{{ asset('front-end/assets/vendor_components/bootstrap-select/dist/js/bootstrap-select.js')}}"></script>
<script src="{{ asset('front-end/assets/vendor_components/Web-Ticker-master/jquery.webticker.min.js')}}"></script>
<script>
    //ticker
    if ($('#webticker-1').length) {
        $("#webticker-1").webTicker({
            height: 'auto',
            duplicate: true,
            startEmpty: false,
            rssfrequency: 5
        });
    }
    /*--- Sparkline charts - mini charts ---*/
    function sparkline_charts() {
        $('.sparklines').sparkline('html');
    }
    if ($('.sparklines').length) {
        sparkline_charts();
    }

</script>

<!-- CryptoCurrency front end -->
<script src="{{ asset('/front-end/js/template.js')}}"></script>
