  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel" style="padding-top: 0;">
        <div class="ulogo">
          <a href="{{ route('dashboard') }}">
            <!-- logo for regular state and mobile devices -->
            <span><img class="" src="{{ asset(\App\Models\Setting::value('light_logo')) }}" alt="" /></span>
          </a>
        </div>
        <div class="image">
          <img src="
          @if(auth()->user()->role == 'admin' || auth()->user()->role == 'staff')
          {{ asset(!empty(auth()->user()->admin->profile_picture) ? auth()->user()->admin->profile_picture : 'back-end/images/user2-160x160.jpg') }}
          @else
          {{ asset(!empty(auth()->user()->investor->profile_picture) ? auth()->user()->investor->profile_picture : 'back-end/images/user2-160x160.jpg') }}
          @endif"
          class="rounded-circle" alt="User Image">
        </div>
        @if(auth()->user()->role == 'investor')
        @if(empty(auth()->user()->investor->means_of_identification) || (auth()->user()->investor->means_of_identification != auth()->user()->investor->approved_identification)) 
         <div class="info" style="padding: 7px 5px 5px 5px;">
              <img class="verify" style="max-width: 15px;" src="{{ asset('back-end/images/warning.png') }}"  alt="verification"> <span style="font-size: 10px;"> ID Unverified</span>
        </div>
        @else
        <div class="info" style="padding: 7px 5px 5px 5px;">
              <img class="verify" style="max-width: 15px;" src="{{ asset('back-end/images/check.png') }}"  alt="verification"> <span style="font-size: 10px;"> ID Verified</span>
        </div>
        @endif
        @endif
        <div class="info">
          <p>Hi, {{ auth()->user()->name }}</p>
        </div>
      </div>
      <!-- sidebar menu -->
      <ul class="sidebar-menu" data-widget="tree">
		    <li class="nav-devider"></li>
        <li>
          <a href="/" target="_blank">
            <i class="icon-home"></i> <span>Visit Frontend</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
        </li>
        @if(auth()->user()->role == 'admin')
        <li class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
          <a href="{{route('dashboard')}}">
            <i class="icon-list"></i> <span>Dashboard</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
        </li>

        <li class="treeview {{ request()->routeIs('packages.*') ? 'active' : '' }}">
          <a href="#">
            <i class="icon-chart"></i>
            <span>{{ __('Packages') }}</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="{{ request()->routeIs('packages.index') ? 'active' : '' }}"><a href="{{ route('packages.index') }}">All Packages</a></li>
            <li class="{{ request()->routeIs('packages.create') ? 'active' : '' }}"><a href="{{ route('packages.create') }}">Create Package</a></li>
            <li class="{{ request()->routeIs('packages.trashed') ? 'active' : '' }}"><a href="{{ route('packages.trashed') }}">Trashed Packages</a></li>
          </ul>
        </li>
        <li class="{{ request()->routeIs('alltransactions') ? 'active' : '' }}">
          <a href="{{route('alltransactions')}}">
            <i class="icon-wallet"></i> <span>Transactions</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
        </li>
        <li class="{{ request()->routeIs('withdrawal.index') ? 'active' : '' }}">
          <a href="{{route('withdrawal.index')}}">
            <i class="icon-layers"></i> <span>Withdrawals</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
        </li>
        <li class="treeview {{ request()->routeIs('investors.*') ? 'active' : '' }}">
          <a href="#">
            <i class="ion ion-person-stalker"></i>
            <span>{{ __('Investors') }}</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="{{ request()->routeIs('investors.index') ? 'active' : '' }}"><a href="{{ route('investors.index') }}">All Investors</a></li>
            <li class="{{ request()->routeIs('investors.create') ? 'active' : '' }}"><a href="{{ route('investors.create') }}">Add Investor</a></li>
          </ul>
        </li>

        @if(auth()->user()->admin->level == 'admin')
        <li class="treeview {{ request()->routeIs('staff.*') ? 'active' : '' }}">
          <a href="#">
            <i class="cc MCO-alt"></i>
            <span>{{ __('Staff') }}</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="{{ request()->routeIs('staff.index') ? 'active' : '' }}"><a href="{{ route('staff.index') }}">All Staff</a></li>
            <li class="{{ request()->routeIs('staff.create') ? 'active' : '' }}"><a href="{{ route('staff.create') }}">Add Staff</a></li>
          </ul>
        </li>
        @endif

        <li class="{{ request()->routeIs('settings') ? 'active' : '' }}">
          <a href="{{route('settings')}}">
            <i class="icon-equalizer"></i> <span>Settings</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
        </li>
        @endif
        @if(auth()->user()->role == 'investor')
        <li class="{{ request()->routeIs('investor.packages') ? 'active' : '' }}">
          <a href="{{route('investor.packages')}}">
            <i class="icon-grid"></i> <span>My Packages</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
        </li>
        <li class="{{ request()->routeIs('mytransactions') ? 'active' : '' }}">
          <a href="{{route('mytransactions')}}">
            <i class="icon-wallet"></i> <span>My Transactions</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
        </li>
        <li class="{{ request()->routeIs('mywallet.history') ? 'active' : '' }}">
          <a href="{{route('mywallet.history')}}">
            <i class="cc BCN-alt"></i> <span>Wallet history</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
        </li>
        <li class="treeview {{ request()->routeIs('withdrawal.index') ? 'active' : '' }}">
          <a href="#">
            <i class="icon-layers"></i>
            <span>Withdrawals</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="{{ request()->routeIs('withdrawal.index') ? 'active' : '' }}"><a href="{{ route('withdrawal.index') }}">Withdraw</a></li>
            <li class="{{ request()->routeIs('withdrawal.history') ? 'active' : '' }}"><a href="{{ route('withdrawal.history') }}">Withdraw History</a></li>
          </ul>
        </li>
         <li class="treeview {{ request()->routeIs('withdrawal.index') ? 'active' : '' }}">
          <a href="#">
            <i class="icon-equalizer"></i>
            <span>Trades</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="{{ request()->routeIs('trade') ? 'active' : '' }}"><a href="{{ route('trade') }}">Trade</a></li>
            <li class="{{ request()->routeIs('market.data') ? 'active' : '' }}"><a href="{{ route('market.data') }}">Market Data</a></li>
          </ul>
        </li>
       
        {{-- <li class="{{ request()->routeIs('withdrawal.index') ? 'active' : '' }}">
          <a href="{{route('withdrawal.index')}}">
            <i class="icon-layers"></i> <span>Withdrawal history</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
        </li> --}}
        
        <li class="{{ request()->routeIs('profile') ? 'active' : '' }}">
          <a href="{{route('profile')}}">
            <i class="icon-people"></i> <span>My Profile</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
        </li>
        @endif
        <li class="">
            <a href="{{ route('logout') }}"
                onclick="event.preventDefault();
                              document.getElementById('logout-form').submit();">
              <i class="ion ion-power"></i> <span>Logout</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-right pull-right"></i>
              </span>
            </a>
        </li>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
      </ul>
    </section>
  </aside>
