<x-app-layout>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>{{ request()->routeIs('packages.*') ? 'Packages' : '' }}</h1>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="breadcrumb-item active">{{ __('Packages') }}</li>
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
                        <th>{{ __('Name') }}</th>
                        <th>{{ __('Amount') }}</th>
                        <th>{{ __('Max Amount') }}</th>
                        <th>{{ __('Daily ROI %') }}</th>
                        <th>{{ __('Validity Period') }}</th>
                        <th>{{ __('Status') }}</th>
                        <th>{{ __('Investors') }}</th>
                        <th>{{ __('Action') }}</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($packages as $package)
                        <tr>
                          <td>{{ $package->name }}</td>
                          <td>{{ $setting->currency_sign . number_format($package->amount) }}</td>
                          <td>{{ $setting->currency_sign . number_format($package->max_amount) }}</td>
                          <td>{{ $package->daily_roi }}%</td>
                          <td>{{ $package->validity_period }} days</td>
                          <td style="color:{{ $package->status == 'published' ? 'green' : 'red' }}">{{ ucfirst($package->status) }}</td>
                          <td>{{ $package->users_count }}</td>
                          <td style="padding: 10px 15px;width: min-content !important; margin: auto;">
                            <div class="actions" role="group" aria-label="Basic example"
                              style="display: inline-block;">
                              <a href="{{ route('packages.edit', $package->id) }}" class="btn btn-block btn-primary btn-xs"> <i class="fa fa-eye"></i>
                                Edit</a>
                              @if(auth()->user()->admin->level == 'admin')
                              <form action="{{ route('packages.destroy', $package->id) }}" method="POST" style="margin-top: 5px;">
                              @csrf
                              @method('DELETE')
                              <button class="btn btn-block btn-info btn-xs" type="submit"><i class="fa fa-trash"></i> Delete</button>
                              </form>
                              @endif
                            </div>
                          </td>
                        </tr>
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
