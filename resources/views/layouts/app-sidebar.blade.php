  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel" style="padding-top: 0;">
        <div class="ulogo">
          <a href="{{ route('dashboard') }}">
            <!-- logo for regular state and mobile devices -->
            <span><img src="{{ asset(\App\Models\Setting::value('light_logo')) }}" alt="" /></span>
          </a>
        </div>
        <div class="image">
          <img src="{{ asset(!empty(auth()->user()->investor->profile_picture) ? auth()->user()->investor->profile_picture : 'back-end/images/user2-160x160.jpg') }}" class="rounded-circle" alt="User Image">
        </div>
        <div class="info">
          <p>Hi, {{ auth()->user()->name }}</p>
        </div>
      </div>
      <!-- sidebar menu -->
      <ul class="sidebar-menu" data-widget="tree">
		    <li class="nav-devider"></li>
        {{-- <li class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
          <a href="{{route('dashboard')}}">
            <i class="icon-home"></i> <span>Dashboard</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
        </li> --}}
        @if(auth()->user()->role == 'admin')
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
            <i class="icon-chart"></i>
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
        <li class="{{ request()->routeIs('withdrawal.index') ? 'active' : '' }}">
          <a href="{{route('withdrawal.index')}}">
            <i class="icon-layers"></i> <span>Withdrawal history</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
        </li>
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
