<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>{{request()->routeIs('dashboard') ? 'Dashboard' : '' }}<small></small></h1>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="breadcrumb-item active">Dashboard</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
		<div class="row">
      <div class="col-md-12"><h2>Quick tools</h2></div>
      
        <div class="col-xl-3 col-md-6 col">
          <a href="{{ route('investors.index') }}">
          <div class="info-box bg-info pull-up bg-hexagons-white">
            <span class="info-box-icon push-bottom"><i class="ion ion-person-stalker"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">All Investors</span>
              <span class="info-box-number">{{ \App\Models\Investor::count() }}</span>
              <div class="progress">
                <div class="progress-bar" style="width: 100%"></div>
              </div>
            </div>
          </div>
          </a>
        </div>
        <!-- /.col -->
        <div class="col-xl-3 col-md-6 col">
          <a href="{{ route('packages.index') }}">
          <div class="info-box bg-success pull-up bg-hexagons-white">
            <span class="info-box-icon push-bottom"><i class="icon-grid"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Packages</span>
              <span class="info-box-number">{{ \App\Models\Package::count() }}</span>

              <div class="progress">
                <div class="progress-bar" style="width: 100%"></div>
              </div>
              
            </div>
            <!-- /.info-box-content -->
          </div>
          </a>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-xl-3 col-md-6 col">
          <a href="{{ route('alltransactions') }}">
          <div class="info-box bg-primary pull-up bg-hexagons-white">
            <span class="info-box-icon push-bottom"><i class="icon-wallet"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Transactions</span>
              <span class="info-box-number">{{ $settings->currency_sign . number_format(\App\Models\InvestorPackage::where('status', '!=', 'pending')->sum('amount')) }}</span>

              <div class="progress">
                <div class="progress-bar" style="width: 100%"></div>
              </div>
              
            </div>
            <!-- /.info-box-content -->
          </div>
          </a>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-xl-3 col-md-6 col">
          <a href="{{ route('withdrawal.index') }}">
          <div class="info-box bg-danger pull-up bg-hexagons-white">
            <span class="info-box-icon push-bottom"><i class="icon-layers"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Pending Withdrawals</span>
              <span class="info-box-number">{{ \App\Models\Withdrawal::where('status', 'pending')->count() }}</span>

              <div class="progress">
                <div class="progress-bar" style="width: 100%"></div>
              </div>
             
            </div>
            <!-- /.info-box-content -->
          </div>
        </a>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
      </div>
	  </section>
  </div>

</div>
</x-app-layout>
