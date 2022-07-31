<header class="top-bar">
     <div class="topbar">
        <div class="container">
        <div class="row justify-content-end">
            <div class="col-lg-6 col-12 d-lg-block d-none">
            <div class="topbar-social text-center text-md-start topbar-left">
                <ul class="list-inline d-md-flex d-inline-block">
                <li class="ms-10 pe-10"><a href="mailto:{{ \App\Models\Setting::value('official_email')}}"><i class="text-white fa fa-envelope"></i> {{ \App\Models\Setting::value('official_email')}}</a></li>
                </ul>
            </div>
            </div>
            <div class="col-lg-6 col-12 xs-mb-10">
            <div class="topbar-call text-center text-lg-end topbar-right">
                <ul class="list-inline d-lg-flex justify-content-end">

                      @if (Route::has('login'))
                        @auth
                            <li class="me-10 ps-10"><a href="{{ route('dashboard') }}" target="_blank"><i class="text-white fa fa-dashboard d-md-inline-block d-none"></i> My Account</a></li>
                        @else
                            <li class="me-10 ps-10"><a href="{{ route('login') }}"><i class="text-white fa fa-sign-in d-md-inline-block d-none"></i> Login</a></li>
                        @endauth
                    @endif
                </ul>
            </div>
            </div>
            </div>
        </div>
    </div>
    <nav hidden class="nav-white nav-transparent">
        <div class="nav-header">
            <a href="{{route('home') }}" class="brand">
                <img src="{{ asset(\App\Models\Setting::value('light_logo'))}}" alt=""/>
            </a>
            <button class="toggle-bar">
                <span class="ti-menu"></span>
            </button>
        </div>
        <ul class="menu">
            <li>
               <a href="{{ url('/') }}">Home</a>
            </li>

            <li>
               <a href="{{ url('/#about') }}">About</a>
            </li>
            <li>
               <a href="{{ url('/#packages') }}">Packages</a>
            </li>
            <li>
               <a href="{{ route('faq') }}">Faqs</a>
            </li>
            <li>
                <a href="{{ url('/#contact') }}">Contact</a>
            </li>
        @guest
        <ul class="attributes">
        @if (Route::has('register'))
            <li class="d-md-block d-none"><a href="{{ route('login') }}#register" class="px-10 pt-15 pb-10"><div class="btn btn-primary py-5">Register Now</div></a></li>
        @endif
        </ul>
        @endguest


    </nav>
</header>