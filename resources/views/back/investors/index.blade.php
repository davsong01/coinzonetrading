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
      <h1>{{ request()->routeIs('investors') ? 'Dashboard' : '' }}</h1>
      <ol class="breadcrumb">
        <li class="breadcrumb-item active">Dashboard</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      @if ($canWithdraw)
        <div class="text-xs-right">
          <button type="submit" class="btn btn-info" data-toggle="modal" data-target="#modal-default">Withdraw</button>
          <div class="modal fade" id="modal-default" style="display: none;" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title"></h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                  <form method="POST" action="{{ route('withdrawal.store') }}">
                    @csrf
                    <div class="form-group">
                      <h5>Amount <span class="text-danger">*</span></h5>
                      <div class="controls">
                        <input type="number" name="amount" class="form-control" required=""
                          data-validation-required-message="This field is required"
                          max="{{ $settings->maximum_withdrawal_amount }}">
                        <div class="help-block"></div>
                      </div>
                    </div>
                    <div class="text-xs-right">
                      <button type="submit" class="btn btn-info">Submit</button>
                    </div>
                  </form>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-danger float-right" data-dismiss="modal">Close</button>
                </div>
              </div>
              <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
          </div>
        </div>
      @endif
      <div class="box my-2">
        <div class="box-header with-border">
          <h3 class="box-title">{{ __('Withdrawals') }}</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <div class="table-responsive">
        <div id="example_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4">
          <table id="example" class="table table-bordered table-hover display nowrap margin-top-10 w-p100 dataTable"
            role="grid" aria-describedby="example_info">
            <thead>
              <tr>
                <th>{{ __('S/N') }}</th>
                <th>{{ __('Amount') }}</th>
                <th>{{ __('Reference ID') }}</th>
                <th>{{ __('Request Date') }}</th>
                <th>{{ __('Status') }}</th>
              </tr>
            </thead>
            <tbody>
              @foreach (auth()->user()->withdrawals as $withdrawal)
                <tr>
                  <td>{{ $loop->index }}</td>
                  <td>{{ $settings->currency_sign . number_format($withdrawal->amount) }}</td>
                  <td>{{ $withdrawal->reference_id }}</td>
                  <td>{{ $withdrawal->request_date->diffForHumans() }}</td>
                  <td>{{ $withdrawal->status }}</td>
                </tr>
              @endforeach
            </tbody>
            <tfoot>
              <tr>
                <th>{{ __('S/N') }}</th>
                <th>{{ __('Amount') }}</th>
                <th>{{ __('Reference ID') }}</th>
                <th>{{ __('Request Date') }}</th>
                <th>{{ __('Status') }}</th>
              </tr>
            </tfoot>
          </table>

        </div>
      </div>
        </div>
        <!-- /.box-body -->
      </div>
    </section>

    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->


  </div>
  <!-- ./wrapper -->
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
