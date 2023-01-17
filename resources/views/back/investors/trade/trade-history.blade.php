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
                  <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#overview" role="tab"><span class="hidden-sm-up"><i class="ion-home"></i></span> <span class="hidden-xs-down">Overview</span></a> </li>
                  <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#crypto" role="tab"><span class="hidden-sm-up"><i class="icon-grid"></i></span> <span class="hidden-xs-down">Crypto</span></a> </li>
                  <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#wallet" role="tab"><span class="hidden-sm-up"><i class="icon-wallet"></i></span> <span class="hidden-xs-down">History</span></a> </li>
              </ul>
              <!-- Tab panes -->
              <div class="tab-content tabcontent-border">
                  <div class="tab-pane active" id="overview" role="tabpanel">
                    {!! $settings->coin_price_list_widget !!}
                  </div>
                  <div class="tab-pane" role="tabpanel" id="crypto">
                      <div class="row">
                          <div class="col-md-12">
                            <div class="box-body">
                              <div class="form-group row">
                                @if(isset($instrument) && !empty($instrument))
                                <script src="https://widgets.coingecko.com/coingecko-coin-ticker-widget.js"></script>
                                <coingecko-coin-ticker-widget  coin-id="bitcoin" currency="{{ $instrument }}" locale="en"></coingecko-coin-ticker-widget>
                                @else
                                <label class="col-md-2 col-form-label">Select Instrument</label>
                                <div class="col-md-8">
                                  <form action="{{ route('select.instrument') }}">
                                  <select name="instrument" id="instrument" class="form-control" required>
                                    <option value="">Select</option>
                                    @foreach($instruments as $instrument)
                                    <option value="{{ $instrument->symbol }}" >{{ $instrument->name }}</option>
                                    @endforeach
                                  </select>
                                </div>
                                <div class="md-2">
                                  <button class="btn btn bg-blue btn-lg" type="submit">Select</button>
                                </div>
                              </form>
                                @endif
                              </div>
                            </div>
                          </div>
                          {{-- @include('investors.trade-modal') --}}
                          
                      </div>	
                  </div>
              </div>
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
