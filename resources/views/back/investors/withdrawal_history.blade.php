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
      <h1>
       {{ __('Withdrawal history') }}
      </h1>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      </ol>
      @include('back.investors.verification_streak')
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="box my-2">
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
              @php
                  $count = 1;
              @endphp
              @foreach (auth()->user()->withdrawals->sortByDesc('id') as $withdrawal)
                <tr>
                  <td>{{ $count ++ }}</td>
                  <td>{{ $settings->currency_sign . number_format($withdrawal->amount,2) }}</td>
                  <td>
                    <small>
                    <strong style="font-weight: bold;">Reference:</strong> {{ $withdrawal->reference_id }} 
                    @if($withdrawal->withdrawal_method)
                    <br> 
                    <strong style="font-weight: bold;">Method:</strong> {{ $withdrawal->withdrawal_method }} 
                    @endif
                    @if($withdrawal->withdrawal_address)
                    <br> 
                    <strong style="font-weight: bold;">Address: </strong>{{ $withdrawal->withdrawal_address }}
                    @endif
                    </small>
                  </td>
                  <td>{{ $withdrawal->created_at}}</td>
                  <td style="color:{{ $withdrawal->status == 'accepted' ? 'green' : ''}} {{ $withdrawal->status == 'pending' ? '#f38e3f' : ''}} {{ $withdrawal->status == 'rejected' ? 'red' : ''}}">{{ ucfirst($withdrawal->status) }}
                  @if($withdrawal->status != 'pending') <br>
                  <small style="color:blue"> <b>On: </b> {{ $withdrawal->approved_date }}</small>
                  @endif
                  </td>
                </tr>
              @endforeach
            </tbody>
            
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
