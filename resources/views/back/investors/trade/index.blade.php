<x-app-layout>
  @section('css')
  @endsection
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
      {{ __('Trade') }}
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
            <div class="box-body">
              <ul class="nav nav-tabs" role="tablist">
                  <li class="nav-item"> <a class="nav-link {{ !empty($active) && $active == 'overview' ? 'active' :'' }}" href="{{ route('trade.overview') }}" role="tab"><span class="hidden-sm-up"><i class="ion-home"></i></span> <span class="hidden-xs-down">Overview</span></a> </li>
                  <li class="nav-item"> <a class="nav-link {{ !empty($active) && $active == 'crypto' ? 'active' :'' }}" href="{{ route('trade.crypto') }}" role="tab"><span class="hidden-sm-up"><i class="icon-grid"></i></span> <span class="hidden-xs-down">Crypto</span></a> </li>
                  <li class="nav-item"> <a class="nav-link {{ !empty($active) && $active == 'history' ? 'active' :'' }}" href="{{ route('trade.history') }}" role="tab"><span class="hidden-sm-up"><i class="icon-wallet"></i></span> <span class="hidden-xs-down">History</span></a> </li>
              </ul>
              <!-- Tab panes -->
              @yield('body')
            </div>
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
    <script src="{{ asset('back-end/assets/vendor_plugins/DataTables-1.10.15/media/js/jquery.dataTables.min.js') }} ">
    </script>
    <script src="{{ asset('back-end/assets/vendor_plugins/DataTables-1.10.15/extensions/Buttons/js/dataTables.buttons.min.js') }} ">
    </script>
    <script src="{{ asset('back-end/assets/vendor_plugins/DataTables-1.10.15/extensions/Buttons/js/buttons.flash.min.js') }}">
    </script>
    <script src="{{ asset('back-end/assets/vendor_plugins/DataTables-1.10.15/ex-js/jszip.min.js') }}"></script>
    <script src="{{ asset('back-end/assets/vendor_plugins/DataTables-1.10.15/ex-js/pdfmake.min.js') }}"></script>
    <script src="{{ asset('back-end/assets/vendor_plugins/DataTables-1.10.15/ex-js/vfs_fonts.js') }}"></script>
    <script src="{{ asset('back-end/assets/vendor_plugins/DataTables-1.10.15/extensions/Buttons/js/buttons.html5.min.js') }}">
    </script>
    <script src="{{ asset('back-end/assets/vendor_plugins/DataTables-1.10.15/extensions/Buttons/js/buttons.print.min.js') }}">
    </script>
    <script src="{{ asset('back-end/js/pages/data-table.js') }}"></script>
  </x-slot>
</x-app-layout>
