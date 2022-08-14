<x-app-layout>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                {{ __('Packages') }}
            </h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i
                            class="fa fa-dashboard"></i>Dashboard</a></li>
            </ol>
        </section>

        <!-- Main content -->
        @if($mypackages->count() > 0)
        <section class="content">
          <div class="row">
              <div class="col-lg-12 col-12">
                  <div class="box">
                      <div class="box-header with-border">
                          <h4 class="box-title">Latest Package(s)</h4> <a href="{{ route('mytransactions') }}" class="btn btn-info"><i class="icon-grid"></i> All Packages</a>
                          <ul class="box-controls pull-right">
                              <li><a class="box-btn-slide" href="#"></a></li>
                              <li><a class="box-btn-fullscreen" href="#"></a></li>
                          </ul>
                      </div>
                      <div class="box-body">

                          <div class="table-responsive">
                              <table class="table table-bordered no-margin">
                                  <thead>
                                      <tr class="bg-pale-dark">
                                          <th>Package</th>
                                          <th>Status</th>
                                          <th>Amount</th>
                                          <th>ROI</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                    @foreach($mypackages as $package)
                                      <tr>
                                          <td>
                                            {{ $package->package->name  }} <br>
                                            @if(!empty($package->end_date) && !empty($package->start_date))
                                            <div style="font-size:11px">
                                                <span style="color:#dd3765"> <b>Start date: </span><br>  <span>{{date("M dS, Y", strtotime($package->start_date)). ','. date("h:ia", strtotime($package->start_date))}} </b></span> <br>

                                              <b style="color:#dd3765">End date : </b><br>
                                              <span>{{date("M dS, Y", strtotime($package->end_date)). ','. date("h:ia", strtotime($package->start_date))}}</span>
                                                <br>
                                              @endif   

                                              <b style="color:#dd3765;font-size:11px">Ref:</b>  <span style="font-size:11px">{{ $package->reference }}</span>
                                            </div>
                                            

                                          </td>
                                          <td>
                                              @if(!empty($package->end_date) && $package->end_date >= \Carbon\Carbon::today())
                                              <button class="btn btn-info" style="background:#dd3765;border:none" readonly>Active</button>
                                              @endif
                                              @if(!empty($package->end_date) && $package->end_date < \Carbon\Carbon::today()) <button
                                                  class="btn btn-warning" style="background:red" id="status{{ $package->id }}" readonly>
                                                  Expired</button>
                                              @endif
                                              @if(empty($package->end_date) && $package->status == 'pending')
                                                  <button class="btn btn-warning" id="status{{ $package->id }}" readonly>Payment Pending</button>
                                                    @if(empty($package->end_date) && $package->status == 'pending' && $package->expires_at > now()) <br>
                                                    <a href="{{ route('payment.process', ['reference' => $package->reference, 'middleware' => 'none' ]) }}"class="btn btn-info" style="background:#dd3765;border:none; margin-top:5px"> <i class="fa fa-refresh"></i> Check status</a>
                                                    @endif
                                              
                                              @endif
                                            </td>
                                            <td>
                                              {{ $settings->currency_sign . number_format($package->amount) }}
                                            </td>
                                            <td>
                                              {{ $settings->currency_sign . number_format($package->daily_roi) }}

                                            </td>
                                      </tr>
                                      @endforeach
                                      
                                  </tbody>
                              </table>
                          </div>
                      </div>
                      <!-- /.box-body -->
                  </div>
                  <!-- /.box -->

              </div>
          </div>
        </section>
        @endif

        @if($packages->count() > 0)
        <section class="content">

            <h4 class="box-title mb-10" style="color: black;paddind:10px"><u>Select a Package</u></h4>
            <div class="row">
                @foreach($packages as $package)
                <div class="col-md-12 col-lg-4">
                    <div class="box box-default pull-up" style="border: #dd3765 solid 1px;padding: 5px;">
                        <div class="text-center mb-30" style="height: 130px;">
                            <h3 class="box-title mb-10" style="color: black;">{{ $package->name }}</h3>
                            <hr class="w-100 bg-primary" style="margin: 1rem auto">
                            <span class="bold"><strong>{{ \App\Models\Setting::value('currency_sign') }}{{ number_format($package->amount) }}
                                    -
                                    {{ \App\Models\Setting::value('currency_sign') . number_format($package->max_amount) }}/{{ $package->validity_period }}days</strong></span>
                        </div>
                        <div class="box-body" style="font-size: 14px;">
                            <p class="box-text">
                                <div class="col-md-12" style="display: flex">
                                    <div class="col-md-6">
                                        <b class="box-title bold">Daily ROI:
                                        </b><span>{{ number_format($package->daily_roi) }}%</span>
                                    </div>

                                </div>
                            </p>

                            <div class="col-md-12" style="display: flex">
                                <a data-toggle="modal" data-target="#modal-payment{{ $package->id }}" class="btn btn-info"
                                    style="width:100%; background:#dd3765;border:none">Purchase</a>
                            </div>

                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>
                <div class="text-xs-right">
                    <div class="modal fade" id="modal-payment{{ $package->id }}" style="display: none;" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Enter amount you want to purchase for <b> {{ $package->name }}
                                        </b> within the range of: <br> <span
                                            style="color:red">{{ $settings->currency_sign. number_format($package->amount, 2) }}</span>
                                        - <span
                                            style="color:green">{{ $settings->currency_sign. number_format($package->max_amount, 2) }}</span>
                                    </h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">×</span></button>
                                </div>
                                <div class="modal-body">
                                    <form method="POST" target="_blank" action="{{ route('package.select') }}">
                                        @csrf
                                        <div class="form-group">
                                            <h5>Enter Amount <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <input type="number" name="amount" class="form-control" required=""
                                                    min="{{ $package->amount }}" max="{{ $package->max_amount }}" step=".01"
                                                    value={{old('amount')}}>
                                                <div class="help-block"></div>
                                            </div>
                                        </div>
                                        <div class="text-xs-right">
                                            <input type="hidden" name="package" value="{{ $package->id }}">
                                            <button type="submit" class="btn btn-info">Purchase Package</button>
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-primary float-right"
                                        data-dismiss="modal">Close</button>
                                </div>
                            </div>
                            <!-- /.modal-content -->
                        </div>
                        <!-- /.modal-dialog -->
                    </div>
                </div>
                @endforeach

            </div>
        </section>
        @endif
      

</x-app-layout>
