<footer class="footer_three">
    <div class="footer-bottom bg-dark3">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6 col-12 text-md-start text-center"> © {{ date('Y') }} <span class="text-white"> {{ config('app.name') }}</span>. All Rights Reserved.</div>
                <div class="col-md-6 mt-md-0 mt-20">
                   
                    <div class="social-icons">
                        <ul class="list-unstyled d-flex gap-items-1 justify-content-md-end justify-content-center">
                            @if(!empty($settings->facebook))
                            <li><a href="{{ $settings->facebook }}" target="_blank"
                                    class="waves-effect waves-circle btn btn-social-icon btn-circle btn-facebook"><i
                                        class="fa fa-facebook"></i></a></li>
                            @endif
                            @if(!empty($settings->twitter))
                            <li><a href="{{ $settings->twitter }}" target="_blank"
                                    class="waves-effect waves-circle btn btn-social-icon btn-circle btn-twitter"><i
                                        class="fa fa-twitter"></i></a></li>
                            @endif
                            @if(!empty($settings->linkedin))
                            <li><a href="{{ $settings->linkedin }}"
                                    class="waves-effect waves-circle btn btn-social-icon btn-circle btn-linkedin"><i
                                        class="fa fa-linkedin"></i></a></li>
                            @endif
                            @if(!empty($settings->twitter))
                            <li><a href="{{ $settings->youtube }}"
                                    class="waves-effect waves-circle btn btn-social-icon btn-circle btn-youtube"><i
                                        class="fa fa-youtube"></i></a></li>
                            @endif
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
