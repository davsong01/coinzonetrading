<x-app-layout>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
       {{ __('Transactions') }}
      </h1>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      </ol>
    </section>
    
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="box">
            <!-- /.box-header -->
            <div class="box-body">
              <div class="table-responsive">
                <div id="example_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4">
                  <table id="example"
                    class="table table-bordered table-hover display nowrap margin-top-10 w-p100 dataTable"
                    role="grid" aria-describedby="example_info">
                    <thead>
                      <tr>
                        <th>{{ __('Order No') }}</th>
                        <th>{{ __('Details') }}</th>
                       
                        <th class="package" style="min-width: 150px;">{{ __('Package') }}</th>
                        <th>{{ __('Amount') }}</th>
                        <th>{{ __('Status') }}</th>
                        @if(auth()->user()->admin->level == 'admin')
                        <th>Actions</th>
                        @endif
                      </tr>
                    </thead>
                    <tbody style="font-size:12px">
                      @foreach ($transactions as $transaction)
                        <tr>
                          <td>{{ $transaction->code }}</td>
                          <td class="package" style="min-width: 150px;">
                              <strong class="bold">Name: </strong>{{ isset($transaction->user) ? $transaction->user->name : 'NOT SET' }}<br>
                              <strong class="bold">Email: </strong>{{ isset($transaction->user) ? $transaction->user->email : 'NOT SET' }} 
                              @if(isset($transaction->user->investor))
                              <a target="_blank" style="color:blue" href="{{ route('investors.edit', ['investor' => $transaction->user->investor->id, 'hid' => 'packages' ] ) }}"><i class="fa fa-external-link"></i></a>  <br>
                              @endif
                              <strong class="bold">Reference: </strong>{{ $transaction->reference }} <br>
                              <strong class="bold">Fee rate: </strong>{{ $transaction->fee_rate }} <br>
                              <strong class="bold">Payment URL: </strong>{{ $transaction->url }} <br>
                              <strong class="bold">Initiated: </strong>{{ $transaction->created_at }} <br>
                              <strong class="bold">Payment Expiry: </strong>{{ $transaction->expires_at }}
                          </td>
                          <td> <strong class="bold">Name: </strong>{{ $transaction->package->name ?? 'NOT SET' }}<br>
                            @if(isset($transaction->start_date) && isset($transaction->end_date))
                              <strong class="bold">Start date: </strong>{{ $transaction->start_date }} <br>
                              <strong class="bold">End date: </strong>{{ $transaction->end_date }} <br>
                              <strong class="bold">Daily ROI: </strong>{{ $settings->currency_sign . number_format($transaction->daily_roi) }}
                            @endif
                          </td>
                          <td>{{ $settings->currency_sign . number_format($transaction->amount) }}</td>
                          <td style="color:{{ $transaction->status == 'active' ? 'green' : 'red'}}">{{ $transaction->status }}
                            @if($transaction->status == 'pending')
                              <a href="{{ route('payment.process', ['reference' => $transaction->reference, 'middleware' => 'none']) }}" class="btn btn-info btn-sm"> <i class="fa fa-refresh"></i> </a> 
                            @endif
                            @if(isset($transaction->test) && !empty($transaction->test))
                              <br>
                              <p style="color:black;border: 1px black solid;height: 120px;width: 320px;border-radius: 5px;padding:5px;margin-top:5px">
                                    RAW RESPONSE: <br>
                                    <b>Payment_id: </b>{{ $transaction->payment_id }} <br>
                                    <b>Network: </b>{{ $transaction->network }} <br>
                                    <b>Status: </b>{{ $transaction->raw_status }} <br>
                                    <b>Detected at: </b>{{ $transaction->detected_at }}
                               
                              </p>
                            @endif
                            
                          </td>
                          @if(auth()->user()->admin->level == 'admin')
                          <td> 
                            
                              <form onsubmit="return confirm('Are you sure you want to delete forever?');" action="{{ route('alltransactions.delete', $transaction->id) }}" method="POST" style="margin-top: 5px;">
                              @csrf
                             
                              <button class="btn btn-block btn-info btn-xs" type="submit"><i class="fa fa-trash"></i> Delete</button>
                              </form> 
                          </td>
                          @endif

                        </tr>
                        
                      @endforeach
                    </tbody>
                    
                  </table>

                </div>
              </div>
            </div>
            <!-- /.box-body -->
          </div>
        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>
  <x-slot name="scripts">
    <!-- DataTables -->
    <script src="{{ asset('back-end/assets/vendor_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('back-end/assets/vendor_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}">
    </script>
    <!-- This is data table -->
    <script src="{{ asset('back-end/assets/vendor_plugins/DataTables-1.10.15/media/js/jquery.dataTables.min.js') }} ">
    </script>

    <!-- start - This is for export functionality only -->
    <script
      src="{{ asset('back-end/assets/vendor_plugins/DataTables-1.10.15/extensions/Buttons/js/dataTables.buttons.min.js') }} ">
    </script>
    <script
      src="{{ asset('back-end/assets/vendor_plugins/DataTables-1.10.15/extensions/Buttons/js/buttons.flash.min.js') }}">
    </script>
    <script src="{{ asset('back-end/assets/vendor_plugins/DataTables-1.10.15/ex-js/jszip.min.js') }}"></script>
    <script src="{{ asset('back-end/assets/vendor_plugins/DataTables-1.10.15/ex-js/pdfmake.min.js') }}"></script>
    <script src="{{ asset('back-end/assets/vendor_plugins/DataTables-1.10.15/ex-js/vfs_fonts.js') }}"></script>
    <script
      src="{{ asset('back-end/assets/vendor_plugins/DataTables-1.10.15/extensions/Buttons/js/buttons.html5.min.js') }}">
    </script>
    <script
      src="{{ asset('back-end/assets/vendor_plugins/DataTables-1.10.15/extensions/Buttons/js/buttons.print.min.js') }}">
    </script>
    <!-- end - This is for export functionality only -->

    <!-- Crypto_Admin for Data Table -->
    <script src="{{ asset('back-end/js/pages/data-table.js') }}"></script>
  </x-slot>
</x-app-layout>
