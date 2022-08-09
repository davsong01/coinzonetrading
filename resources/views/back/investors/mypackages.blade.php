<x-app-layout>
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       {{ __('Packages') }}
      </h1>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i>Dashboard</a></li>
      </ol>
    </section>
   
    <!-- Main content -->
    @if($mypackages->count() > 0)
    <section class="content">
     
      <!-- START Card With Image -->
      <h4 class="box-title mb-10" style="padding: 10px;color: black;"> <u>My packages</u></h4>
      <div class="row">
          @foreach($mypackages as $package)
            <div class="col-md-12 col-lg-4">
              <div class="box box-default pull-up" style="padding: 5px;height: 350px;">
                <div class="text-center mb-30">
                    <h3 class="box-title mb-10" style="color: black;">{{ $package->package->name }}</h3>			
                    <hr class="w-100 bg-primary" style="margin: 1rem auto">
                      @if(!empty($package->end_date) && $package->end_date >= \Carbon\Carbon::today())
                        <button class="btn btn-info" style="background:#dd3765;border:none" readonly>Active</button>
                      @endif
                      @if(!empty($package->end_date) && $package->end_date < \Carbon\Carbon::today())
                        <button class="btn btn-warning" style="background:red"  id="status{{ $package->id }}" readonly>Expired</button>
                      @endif
                      @if(empty($package->end_date) && $package->status == 'pending')
                          <button class="btn btn-warning" id="status{{ $package->id }}" readonly>Payment Pending</button>
                      @endif
                      <br> <br>
                      <span><strong>Ref: {{ $package->reference }}</strong></span>
                </div>
                <div class="box-body">  
                  @if(!empty($package->end_date) && !empty($package->start_date))
                  <p class="box-text">
                    <div class="col-md-12" style="display: flex">
                      <div class="col-md-6" style="font-size:11px">
                        <b class="box-title bold">Start date: <br> </b> <span>{{date("M dS, Y", strtotime($package->start_date)). ','. date("h:ia", strtotime($package->start_date))}}</span>  <br>
                      </div>
                      <div class="col-md-6" style="font-size:11px">
                        <b class="box-title bold">End date: </b> <br> <span>{{date("M dS, Y", strtotime($package->end_date)). ','. date("h:ia", strtotime($package->start_date))}}</span>  <br>
                      </div>
                    </div>
                      
                  </p> 
                  @endif
                  @if(!empty($package->end_date) && $package->end_date < \Carbon\Carbon::today())
                  <div class="col-md-12" style="display: flex">
                      <a target="_blank" href="{{ route('package.renew', $package->reference) }}" class="btn btn-info bold" style="width:100%;background:#dd3765;border:none; color:white !important">Renew</a>
                  </div>

                  @endif
                  @if(empty($package->end_date) && $package->status == 'pending' && $package->expires_at > now())
                  <div class="col-md-12" style="display: flex">
                    <div class="col-md-6">
                      <a href="{{ route('payment.retry', $package->reference) }}" class="btn btn-info" style="width:100%;border:none">Try again </a>
                    </div>
                      <div class="col-md-6">
                      <a href="{{ route('payment.process', $package->reference ) }}" class="btn btn-info" style="width:100%; background:#dd3765;border:none">Check status</a>
                    </div>
                  </div>
                  @endif
                </div>
              </div>
            </div>
          @endforeach
      </div>
    </section>
     @endif
    @if($otherpackages->count() > 0)
    <section class="content">
       
      <h4 class="box-title mb-10" style="color: black;paddind:10px"><u>Select a Package</u></h4>
      <div class="row">
       
          @foreach($otherpackages as $package)
            <div class="col-md-12 col-lg-4">
              <div class="box box-default pull-up" style="border: #dd3765 solid 1px;padding: 5px;">
                <div class="text-center mb-30" style="height: 130px;">
                    <h3 class="box-title mb-10" style="color: black;">{{ $package->name }}</h3>			
                    <hr class="w-100 bg-primary" style="margin: 1rem auto">
                    <span class="bold"><strong>{{ \App\Models\Setting::value('currency_sign') }}{{ number_format($package->amount) }}/{{ $package->validity_period }}Days</strong></span>
                </div>
                <div class="box-body">            	
                  <p class="box-text">
                    <div class="col-md-12" style="display: flex">
                      <div class="col-md-6">
                        <b class="box-title bold">Daily ROI: </b><span>{{ \App\Models\Setting::value('currency_sign') . number_format($package->daily_roi) }}</span>
                      </div>
                      <div class="col-md-6">
                        <b class="box-title bold">Monthly ROI: </b><span>{{ \App\Models\Setting::value('currency_sign') . number_format($package->monthly_roi) }}</span>
                      </div>
                    </div>
                  </p>
                 
                  <div class="col-md-12" style="display: flex">
                      <a target="_blank" href="{{ route('package.select', $package->id) }}" class="btn btn-info" style="width:100%; background:#dd3765;border:none">Purchase</a>
                  </div>
                
                </div>
                <!-- /.box-body -->
              </div>
              <!-- /.box -->
            </div>
          @endforeach
       
      </div>
    </section>
    @endif
  </div>
  
</x-app-layout>
