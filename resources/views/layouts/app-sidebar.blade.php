  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel" style="padding-top: 0;">
		 <div class="ulogo">
			 <a href="{{route('dashboard')}}">
			  <!-- logo for regular state and mobile devices -->
                
			  <span><img src="{{ asset(\App\Models\Setting::value('light_logo'))}}" alt=""/></span>
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
        <li class="active">
          <a href="{{route('dashboard')}}">
            <i class="icon-home"></i> <span>Dashboard</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="icon-chart"></i>
            <span>Reports</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="#">Transactions</a></li>
            <li><a href="#">Top Gainers/Losers</a></li>
            <li><a href="#">Market Capitalizations</a></li>
            <li><a href="#">Crypto Stats</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="icon-compass"></i>
            <span>Initial Coin Offering</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="#">Countdown</a></li>
            <li><a href="#">Roadmap/Timeline</a></li>
            <li><a href="#">Progress Bar</a></li>
            <li><a href="#">Details</a></li>
            <li><a href="#">ICO Listing</a></li>
            <li><a href="#">ICO Listing - Filters</a></li>
          </ul>
        </li>
        <li>
          <a href="#">
            <i class="icon-refresh"></i> <span>Currency Exchange</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="icon-people"></i>
            <span>Members</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="#">Members Grid</a></li>
            <li><a href="#">Members List</a></li>
            <li><a href="#">Member Profile</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="icon-equalizer"></i>
            <span>Tickers</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="#">Ticker</a></li>
            <li><a href="#">Live Crypto Prices</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="icon-wallet"></i>
            <span>Transactions</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="#">Transactions Tables</a></li>
            <li><a href="#">Transactions Search</a></li>
            <li><a href="#">Single Transaction</a></li>
            <li><a href="#">Transactions Counter</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="icon-graph"></i>
            <span>Charts</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="#">ChartJS</a></li>
            <li><a href="#">Flot</a></li>
            <li><a href="#">Inline charts</a></li>
            <li><a href="#">Morris</a></li>
            <li><a href="#">Peity</a></li>
            <li><a href="#">Chartist</a></li>
            <li><a href="#">Rickshaw Charts</a></li>
            <li><a href="#">NVD3 Charts</a></li>
			<li><a href="#">eChart</a></li>
			<li><a href="#">amCharts Charts</a></li>
			<li><a href="#">amCharts Stock Charts</a></li>
			<li><a href="#">amCharts Maps</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="icon-grid"></i>
            <span>App</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="#">Chat app</a></li>
            <li><a href="#">Project</a></li>
            <li><a href="#">Contact / Employee</a></li>
            <li><a href="#">Support Ticket</a></li>
			<li><a href="#">Calendar</a></li>
            <li><a href="#">Profile</a></li>
            <li><a href="#">Userlist Grid</a></li>
			<li><a href="#">Userlist</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="icon-envelope"></i> <span>Mailbox</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="#">Inbox</a></li>
            <li><a href="#">Compose</a></li>
            <li><a href="#">Read</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="icon-drop"></i>
            <span>UI Elements</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="#">Badges</a></li>
            <li><a href="#">Border</a></li>
            <li><a href="#">Buttons</a></li>
            <li><a href="#">Bootstrap Switch</a></li>
            <li><a href="#">User Card</a></li>
            <li><a href="#">Color</a></li>
			<li><a href="#">Date Paginator</a></li>
            <li><a href="#">Dropdown</a></li>
            <li><a href="#">Dropdown Grid</a></li>
            <li><a href="#">General</a></li>
            <li><a href="#">Icons</a></li>
            <li><a href="#">Advanced Medias</a></li>
			<li><a href="#">Modals</a></li>
            <li><a href="#">Nestable</a></li>
            <li><a href="#">Notification</a></li>
            <li><a href="#">Draggable Portlets</a></li>
            <li><a href="#">Ribbons</a></li>
            <li><a href="#">Sliders</a></li>
            <li><a href="#">Sweet Alert</a></li>
            <li><a href="#">Tabs</a></li>
            <li><a href="#">Timeline</a></li>
            <li><a href="#">Horizontal Timeline</a></li>
          </ul>
        </li>
        <li class="header nav-small-cap">FORMS, TABLE & LAYOUTS</li>
		<li class="treeview">
          <a href="#">
            <i class="icon-puzzle"></i>
            <span>Widgets</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="#">Blog</a></li>
            <li><a href="#">Chart</a></li>
            <li><a href="#">List</a></li>
            <li><a href="#">Social</a></li>
            <li><a href="#">Statistic</a></li>
            <li><a href="#">Tiles</a></li>
            <li><a href="#">Weather</a></li>
            <li><a href="#">Widgets</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="icon-layers"></i>
            <span>Layout Options</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="#">Boxed</a></li>
            <li><a href="#">Fixed</a></li>
            <li><a href="#">Collapsed Sidebar</a></li>
          </ul>
        </li>
		<li class="treeview">
          <a href="#">
            <i class="icon-loop"></i>
            <span>Box</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="#">Advanced</a></li>
            <li><a href="#">Boxed</a></li>
            <li><a href="#">Color</a></li>
			<li><a href="#">Group</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="icon-note"></i> <span>Forms</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="#">Advanced Elements</a></li>
            <li><a href="#">Code Editor</a></li>
            <li><a href="#">Markdown</a></li>
            <li><a href="#">Editors</a></li>
            <li><a href="#">Form Validation</a></li>
            <li><a href="#">Form Wizard</a></li>
            <li><a href="#">General Elements</a></li>
            <li><a href="#">Formatter</a></li>
            <li><a href="#">Pre-made Forms</a></li>
            <li><a href="#">Xeditable Editor</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="icon-menu"></i> <span>Tables</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="#">Simple tables</a></li>
            <li><a href="#">Data tables</a></li>
            <li><a href="#">Editable Tables</a></li>
            <li><a href="#">Table Color</a></li>
          </ul>
        </li>
		<li>
          <a href="#">
            <i class="icon-envelope-open"></i> <span>Emails</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
        </li>
		<li class="header nav-small-cap">EXTRA COMPONENTS</li>
        <li class="treeview">
          <a href="#">
            <i class="icon-map"></i> <span>Map</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="#">Google Map</a></li>
            <li><a href="#">Vector Map</a></li>
          </ul>
        </li>
		<li class="treeview">
          <a href="#">
            <i class="icon-magnet"></i> <span>Extension</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="#">Fullscreen</a></li>
          </ul>
        </li>
		<li class="treeview">
          <a href="#">
            <i class="icon-folder-alt"></i> <span>Sample Pages</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="#">Blank</a></li>
            <li><a href="#">Coming Soon</a></li>
            <li><a href="#">Custom Scrolls</a></li>
			<li><a href="#">FAQ</a></li>
			<li><a href="#">Gallery</a></li>
			<li><a href="#">Invoice</a></li>
			<li><a href="#">Lightbox Popup</a></li>
			<li><a href="#">Pace</a></li>
			<li><a href="#">Pricing</a></li>
            <li class="treeview">
              <a href="#">Authentication
                <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="#">Login</a></li>
                <li><a href="#">Register</a></li>
                <li><a href="#">Lockscreen</a></li>
                <li><a href="#">Recover password</a></li>
              </ul>
            </li>
			<li class="treeview">
              <a href="#">Error Pages
                <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="#">404</a></li>
                <li><a href="#">500</a></li>
                <li><a href="#">Maintenance</a></li>
              </ul>
            </li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="icon-menu"></i> <span>Multilevel</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="#">Level One</a></li>
            <li class="treeview">
              <a href="#">Level One
                <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="#">Level Two</a></li>
                <li class="treeview">
                  <a href="#">Level Two
                    <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
                  </a>
                  <ul class="treeview-menu">
                    <li><a href="#">Level Three</a></li>
                    <li><a href="#">Level Three</a></li>
                  </ul>
                </li>
              </ul>
            </li>
            <li><a href="#">Level One</a></li>
          </ul>
        </li>

      </ul>
    </section>
  </aside>