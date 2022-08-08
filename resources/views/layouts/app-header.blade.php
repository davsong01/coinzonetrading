  <header class="main-header">
    <!-- Logo -->
    <a href="index.html" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
	  <b class="logo-mini">
    <link rel="icon" href="">
		  <span class="light-logo"><img src="{{asset(\App\Models\Setting::value('light_logo'))}}" alt="logo"></span>
		  <span class="dark-logo"><img src="{{asset(\App\Models\Setting::value('dark_logo'))}}" alt="logo"></span>
	  </b>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg">
		  <img src="{{asset(\App\Models\Setting::value('light_logo'))}}" alt="logo" class="light-logo">
	  	  <img src="{{asset(\App\Models\Setting::value('dark_logo'))}}" alt="logo" class="dark-logo">
	  </span>
    </a>
    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          {{-- <li>
            mhjh {{ auth()->user()->investor }}
          </li> --}}
          @if(auth()->user()->role == 'investor')
          <li class="search-box">
            <a class="nav-link hidden-sm-down" href="javascript:void(0)"><i class="icon-wallet"></i> {{ $settings->currency_sign }}{{ number_format(auth()->user()->walletBalance()) }}</a>
            
          </li>
          @endif
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="
              @if(auth()->user()->role == 'admin' || auth()->user()->role == 'staff')
              {{ asset(!empty(auth()->user()->admin->profile_picture) ? auth()->user()->admin->profile_picture : 'back-end/images/user2-160x160.jpg') }}
              @else
              {{ asset(!empty(auth()->user()->investor->profile_picture) ? auth()->user()->investor->profile_picture : 'back-end/images/user2-160x160.jpg') }}
              @endif"
              class="user-image rounded-circle" alt="User Image">
            </a>
            <ul class="dropdown-menu scale-up">
              <!-- User image -->
             
              <!-- Menu Body -->
              <li class="user-body">
                <div class="row no-gutters">
                  <div class="col-12 text-left">
                    <a href="{{ route('profile') }}"><i class="ion ion-person"></i> My Profile</a>
                  </div>
                 
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
  </header>
  