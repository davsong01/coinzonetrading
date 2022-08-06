@section('css')
<style>
    .box-title {
        height: 110px !important;
    }
</style>
    
@endsection
@extends('layouts.frontapp')
@section('body')
<section class="bg-img pt-200 pb-120" data-overlay="7" style="background-image: url({{ asset('/front-end/images/front-end-img/banners/banner-1.jpg') }}); background-position: top center;">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="text-center mt-80">
                    <h1 class="box-title text-white fs-50 mb-30">Buy & Sell 100+ coins instantly</h1>	
                </div>
                <div class="text-center d-flex gap-3 justify-content-center">
                    <a href="#about" class="btn btn-outline btn-primary text-white">What we are</a>
                </div>
            </div>
        </div>
    </div>
</section>	
<section class="overflow-xh" data-aos="fade-up">		
    <div class="row">
        <div class="col-12">
            <div class="box">
                <div class="box-body">
                    <!-- TradingView Widget BEGIN -->
                    <div class="tradingview-widget-container">
                        <div class="tradingview-widget-container__widget"></div>
                        <script type="text/javascript" src="https://s3.tradingview.com/external-embedding/embed-widget-ticker-tape.js" async>
                        {
                        "symbols": [
                        {
                            "proName": "BITSTAMP:BTCUSD",
                            "title": "BTC/USD"
                        },
                        {
                            "proName": "BITSTAMP:ETHUSD",
                            "title": "ETH/USD"
                        },
                        {
                            "description": "BTC/USD",
                            "proName": "BITBAY:BTCUSD"
                        },
                        {
                            "description": "XRP/USD",
                            "proName": "BITSTAMP:XRPUSD"
                        },
                        {
                            "description": "LTC/USD",
                            "proName": "BINANCE:LTCUSDT"
                        }
                        ],
                        "showSymbolLogo": true,
                        "colorTheme": "light",
                        "isTransparent": true,
                        "displayMode": "adaptive",
                        "locale": "in"
                    }
                        </script>
                    </div>
                    <!-- TradingView Widget END -->
                </div>
            </div>
        </div>
    </div>
</section>
<section class="pt-30 pb-50" data-aos="fade-up">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <ul class="nav nav-tabs justify-content-center bb-0 mb-10" role="tablist">
                    <li class="nav-item"> <a class="nav-link px-50 py-10 fs-24 active" data-bs-toggle="tab" href="#all" role="tab">Buy Crypto</a> </li>
                    <li class="nav-item"> <a class="nav-link px-50 py-10 fs-24" data-bs-toggle="tab" href="#tab1" role="tab">Sell Crypto</a> </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="all" role="tabpanel">
                        <div class="px-15 pt-15">
                            <div class="row">
                                <div class="col-12 col-md-4">
                                <div class="box box-body pull-up">
                                    <!-- TradingView Widget BEGIN -->
                                    <div class="tradingview-widget-container">
                                        <div class="tradingview-widget-container__widget"></div>
                                        <script type="text/javascript" src="https://s3.tradingview.com/external-embedding/embed-widget-mini-symbol-overview.js" async>
                                        {
                                        "symbol": "BITSTAMP:BTCUSD",
                                        "width": "100%",
                                        "height": "100%",
                                        "locale": "in",
                                        "dateRange": "12M",
                                        "colorTheme": "light",
                                        "trendLineColor": "rgba(246, 178, 107, 1)",
                                        "underLineColor": "rgba(255, 242, 204, 1)",
                                        "isTransparent": true,
                                        "autosize": true,
                                        "largeChartUrl": ""
                                    }
                                        </script>
                                    </div>
                                    <!-- TradingView Widget END -->
                                </div>			
                                </div>
                                <div class="col-12 col-md-4">
                                <div class="box box-body pull-up">
                                    <!-- TradingView Widget BEGIN -->
                                    <div class="tradingview-widget-container">
                                        <div class="tradingview-widget-container__widget"></div>
                                        <script type="text/javascript" src="https://s3.tradingview.com/external-embedding/embed-widget-mini-symbol-overview.js" async>
                                        {
                                        "symbol": "BITSTAMP:ETHUSD",
                                        "width": "100%",
                                        "height": "100%",
                                        "locale": "in",
                                        "dateRange": "12M",
                                        "colorTheme": "light",
                                        "trendLineColor": "rgba(246, 178, 107, 1)",
                                        "underLineColor": "rgba(255, 242, 204, 1)",
                                        "isTransparent": true,
                                        "autosize": true,
                                        "largeChartUrl": ""
                                    }
                                        </script>
                                    </div>
                                    <!-- TradingView Widget END -->
                                </div>			
                                </div>
                                <div class="col-12 col-md-4">
                                <div class="box box-body pull-up">
                                    <!-- TradingView Widget BEGIN -->
                                    <div class="tradingview-widget-container">
                                        <div class="tradingview-widget-container__widget"></div>
                                        <script type="text/javascript" src="https://s3.tradingview.com/external-embedding/embed-widget-mini-symbol-overview.js" async>
                                        {
                                        "symbol": "BINANCE:XRPUSDT",
                                        "width": "100%",
                                        "height": "100%",
                                        "locale": "in",
                                        "dateRange": "12M",
                                        "colorTheme": "light",
                                        "trendLineColor": "rgba(246, 178, 107, 1)",
                                        "underLineColor": "rgba(255, 242, 204, 1)",
                                        "isTransparent": true,
                                        "autosize": true,
                                        "largeChartUrl": ""
                                    }
                                        </script>
                                    </div>
                                    <!-- TradingView Widget END -->
                                </div>			
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="tab1" role="tabpanel">
                        <div class="px-15 pt-15">
                            <div class="row">
                                <div class="col-12 col-md-4">
                                <div class="box box-body pull-up">
                                    <!-- TradingView Widget BEGIN -->
                                    <div class="tradingview-widget-container">
                                        <div class="tradingview-widget-container__widget"></div>
                                        <script type="text/javascript" src="https://s3.tradingview.com/external-embedding/embed-widget-mini-symbol-overview.js" async>
                                        {
                                        "symbol": "BITSTAMP:BTCUSD",
                                        "width": "100%",
                                        "height": "100%",
                                        "locale": "in",
                                        "dateRange": "12M",
                                        "colorTheme": "light",
                                        "trendLineColor": "rgba(246, 178, 107, 1)",
                                        "underLineColor": "rgba(255, 242, 204, 1)",
                                        "isTransparent": true,
                                        "autosize": true,
                                        "largeChartUrl": ""
                                    }
                                        </script>
                                    </div>
                                    <!-- TradingView Widget END -->
                                </div>			
                                </div>
                                <div class="col-12 col-md-4">
                                <div class="box box-body pull-up">
                                    <!-- TradingView Widget BEGIN -->
                                    <div class="tradingview-widget-container">
                                        <div class="tradingview-widget-container__widget"></div>
                                        <script type="text/javascript" src="https://s3.tradingview.com/external-embedding/embed-widget-mini-symbol-overview.js" async>
                                        {
                                        "symbol": "BITSTAMP:ETHUSD",
                                        "width": "100%",
                                        "height": "100%",
                                        "locale": "in",
                                        "dateRange": "12M",
                                        "colorTheme": "light",
                                        "trendLineColor": "rgba(246, 178, 107, 1)",
                                        "underLineColor": "rgba(255, 242, 204, 1)",
                                        "isTransparent": true,
                                        "autosize": true,
                                        "largeChartUrl": ""
                                    }
                                        </script>
                                    </div>
                                    <!-- TradingView Widget END -->
                                </div>			
                                </div>
                                <div class="col-12 col-md-4">
                                <div class="box box-body pull-up">
                                    <!-- TradingView Widget BEGIN -->
                                    <div class="tradingview-widget-container">
                                        <div class="tradingview-widget-container__widget"></div>
                                        <script type="text/javascript" src="https://s3.tradingview.com/external-embedding/embed-widget-mini-symbol-overview.js" async>
                                        {
                                        "symbol": "BINANCE:XRPUSDT",
                                        "width": "100%",
                                        "height": "100%",
                                        "locale": "in",
                                        "dateRange": "12M",
                                        "colorTheme": "light",
                                        "trendLineColor": "rgba(246, 178, 107, 1)",
                                        "underLineColor": "rgba(255, 242, 204, 1)",
                                        "isTransparent": true,
                                        "autosize": true,
                                        "largeChartUrl": ""
                                    }
                                        </script>
                                    </div>
                                    <!-- TradingView Widget END -->
                                </div>			
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section> 

{{-- <section class="py-50 bg-white" data-aos="fade-up">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-7 col-12 text-center">
                <h1 class="mb-15">Live Market</h1>					
                <hr class="w-100 bg-primary">
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="box box-body">
                    <div style="height:433px; background-color: #FFFFFF; overflow:hidden; box-sizing: border-box; border: 1px solid #56667F; border-radius: 4px; text-align: right; line-height:14px; font-size: 12px; font-feature-settings: normal; text-size-adjust: 100%; box-shadow: inset 0 -20px 0 0 #56667F; padding: 0px; margin: 0px; width: 100%;"><div style="height:413px; padding:0px; margin:0px; width: 100%;"><iframe src="https://widget.coinlib.io/widget?type=full_v2&theme=light&cnt=6&pref_coin_id=1505&graph=yes" width="100%" height="409px" scrolling="auto" marginwidth="0" marginheight="0" frameborder="0" border="0" style="border:0;margin:0;padding:0;"></iframe></div><div style="color: #FFFFFF; line-height: 14px; font-weight: 400; font-size: 11px; box-sizing: border-box; padding: 2px 6px; width: 100%; font-family: Verdana, Tahoma, Arial, sans-serif;"><a href="https://coinlib.io" target="_blank" style="font-weight: 500; color: #FFFFFF; text-decoration:none; font-size:11px">Cryptocurrency Prices</a>&nbsp;by Coinlib</div></div>
                </div>
            </div>
        </div>						
    </div>
</section> --}}
<section id="about" style="padding-top: 15px;">
</section>
<section>
    <div class="gaps" ></div>
</section>
<section class="py-50 overflow-xh" data-aos="fade-up">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-7 col-12 text-start">
                <h6 class="sub-heading">Dan Morehead</h6>
                <h1 class="mb-15 fs-18 mb-20">“We believe in the future of cryptocurrency because it entered the exchange markets on a strong note. Success in this sphere is assured to everyone, who gets the hang of managing risks in this sphere.</h1>					
                <hr class="w-100 bg-primary ms-0">
               
               
                <!-- Tab panes -->
                <div class="tab-content">
                    <div class="tab-pane active" id="home7" role="tabpanel">
                        <div class="py-15">
                            <p class="fs-18 mb-20">Coinzonetrading Limited is one of the Best Trading Platforms. We attract investors to get a steady income. The core of our activity is conducting financial transactions on international exchanges while managing risks and guaranteeing profits. <br><br>
                            Our team consists of experienced traders engaged in trading activity for more than 14 years. We created the financial portfolio with an active profit pool from the high-yielding assets. Attracting additional capital allows us to extend boundaries and move forward. With our company, every investor becomes a player in the professional exchange market.
                            Our customer service and support are always available to meet your needs, and our account
                            managers know that your success is our success.</p>								
                            <div class="text-center d-flex gap-3 justify-content-start">
                                <a href="{{ route('about') }}" class="btn btn-primary">Read More</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-5 col-12 d-lg-block d-none">
                <div class="browserMockup browserMockup--perspectiveRight ms-70 position-relative">
                    <div class="browserMockup__addressBar">
                        <span class="browserMockup__button"></span>
                        <span class="browserMockup__button"></span>
                        <span class="browserMockup__button"></span>
                        <span class="browserMockup__addressInput"></span>
                    </div>
                    <span class="homeScreenshot  homeScreenshot--mmo" style="background-position-y: 0px;"></span>
                </div>
            </div>
        </div>
    </div>
</section>
<section style="margin-top:15px" id="packages">
</section>
<section class="py-50 bg-white" data-aos="fade-up">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-7 col-12 text-center">
                <h1 class="mb-15">Packages</h1>					
                <hr class="w-100 bg-primary">
            </div>
        </div>
        <div class="row mt-30">
            @if(\App\Models\Package::count() > 1)
                @foreach(\App\Models\Package::all() as $package)
                <div class="col-lg-3 col-12">
                    <a href="{{ route('package.select', $package->id) }}" target="_blank">
                    <div class="box packages">
                        
                        <div class="box-body px-30 pt-50 pb-30">
                            <div class="text-center mb-30">
                                <h3 class="box-title mb-10">{{ $package->name }}</h3>			
                                <hr class="w-100 bg-primary">
                            </div>
                            <ul class="list list-hand">
                                <li><strong>Daily ROI: </strong>${{ number_format($package->daily_roi) }}</li>
                                <li><strong>Monthly ROI: </strong>${{ number_format($package->monthly_roi) }}</li>
                            </ul>
                        </div>
                        <div class="box-footer bg-lightest min-h-80 l-h-60">
                            <p class="text-center fs-36">${{ number_format($package->amount) }} <small class="fs-16 fw-300">/ month*</small></p>
                        </div>
                        
                    </div>
                    </a>
                </div>
            @endforeach
            @endif
        </div>						
    </div>
</section>
<section style="margin-top:15px" id="contact">

</section>
<section class="py-50 bg-white" data-aos="fade-up">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-7 col-12 text-center">
                <h1 class="mb-15">Get in touch with us.<br>We are available to help.</h1>				
                <hr class="w-100 bg-primary">
            </div>
        </div>
        <div class="row justify-content-center mt-30">
            <div class="col-lg-6 col-12">   
                <form action="{{ route('contact.send') }}" method="post">
                    @csrf
                    <div class="contact-form form-border clearfix">
                        <div class="form-group">
                            <input id="name" name="name" type="text" placeholder="Name*" class="form-control" value="{{ old('name') }}">
                        </div>
                        <div class="form-group">
                            <input type="email" name="email" placeholder="Email*" class="form-control" value="{{ old('email') }}">
                        </div>
                        <div class="form-group">
                            <input type="text" name="phone" placeholder="Phone*" class="form-control" value="{{ old('phone') }}">
                        </div>
                        <div class="form-group textarea">
                            <textarea class="form-control" name="message" placeholder="Message*" rows="7" value="{{ old('message') }}">{{ old('message') }}</textarea>
                        </div>
                        <div class="form-group submit-button">
                            <button id="submit" name="submit" type="submit" value="Send" style="width:100%" class="btn btn-primary">Send your message</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection