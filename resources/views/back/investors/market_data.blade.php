<x-app-layout>
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
     
      <h1>
       {{ __('Market Data') }}
      </h1>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i>Dashboard</a></li>
      </ol>
        @include('back.investors.verification_streak')
    </section>
   
    <!-- Main content -->
   
    <section class="content">
      <div class="row">
        <div class="col-lg-12 col-12">
          <div class="box">
            <div class="box-header with-border">
              <h4 class="box-title">Current Market Data</h4>
            </div>
            <div class="box-body">
              {!! $settings->coin_price_list_widget !!}
            </div>
            <!-- /.box-body -->
            </div>
        </div>
       
      </div>
    </section>
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
