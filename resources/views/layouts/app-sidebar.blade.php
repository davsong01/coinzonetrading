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
          <img src="{{ asset('back-end/images/user2-160x160.jpg') }}" class="rounded-circle" alt="User Image">
        </div>
        <div class="info">
          <p>Admin Template</p>
          <a href="" class="link" data-toggle="tooltip" title="" data-original-title="Settings"><i
              class="ion ion-gear-b"></i></a>
          <a href="" class="link" data-toggle="tooltip" title="" data-original-title="Email"><i
              class="ion ion-android-mail"></i></a>
          <a href="" class="link" data-toggle="tooltip" title="" data-original-title="Logout"><i
              class="ion ion-power"></i></a>
        </div>
      </div>
      <!-- sidebar menu -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="nav-devider"></li>
        <li class="header nav-small-cap">PERSONAL</li>
        <li class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
          <a href="{{ route('dashboard') }}">
            <i class="icon-home"></i> <span>Dashboard</span>
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
            <li class="{{ request()->routeIs('packages.create') ? 'active' : '' }}"><a href="{{ route('packages.create') }}">Create Packages</a></li>
          </ul>
        </li>
      </ul>
    </section>
  </aside>
