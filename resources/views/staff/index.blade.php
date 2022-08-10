<x-app-layout>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>{{ request()->routeIs('staff.*') ? 'Staff' : '' }}</h1>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="breadcrumb-item active">{{ __('Staff') }}</li>
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
                        <th>{{ __('S/N') }}</th>
                        <th>{{ __('Avatar') }}</th>
                        <th>{{ __('Name') }}</th>
                        <th>{{ __('Email') }}</th>
                        <th>{{ __('Phone') }}</th>
                        <th>{{ __('Level') }}</th>
                        <th>{{ __('Actions') }}</th>
                      </tr>
                    </thead>
                    <tbody>
                      @php
                          $i = 1;
                      @endphp
                      @foreach ($staffs as $staff)
                        <tr>
                          <td>{{ $i++ }}</td>
                          <td><img class="avatar avatar-lg" src="{{ asset(!empty($staff->profile_picture) ? $staff->profile_picture : 'back-end/images/user2-160x160.jpg') }}" alt="investor-image">
                          </td>
                          <td>{{ $staff->user->name }}</td>
                          <td>{{ $staff->user->email }}</td>
                          <td>{{ $staff->phone }}</td>
                          <td>{{ ucfirst($staff->level) }}</td>
                          
                        
                          <td style="padding: 10px 15px;width: min-content !important; margin: auto;">
                            <div class="actions" role="group" aria-label="Basic example"
                              style="display: inline-block;">
                              <a target="_blank" href="{{ route('staff.destroy', $staff->id) }}" class="btn btn-block btn-info btn-xs"> <i class="fa fa-eye"></i>
                                Edit</a>
                              <form onsubmit="return confirm('Are you sure you want to delete forever?');" action="{{ route('staff.destroy', $staff->id) }}" method="POST" style="margin-top: 5px;">
                              @csrf
                              @method('DELETE')
                              <button class="btn btn-block btn-danger btn-xs" type="submit"><i class="fa fa-trash"></i> Delete</button>
                              </form> 

                            </div>
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
