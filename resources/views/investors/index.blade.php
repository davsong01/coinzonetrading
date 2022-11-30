<x-app-layout>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>{{ request()->routeIs('investors.*') ? 'Investors' : '' }}</h1>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="breadcrumb-item active">{{ __('Investors') }}</li>
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
                        <th>{{ __('Avatar') }}</th>
                        <th>{{ __('Investor') }}</th>
                        <th>{{ __('Wallet') }}</th>
                        <th>{{ __('Packages') }}</th>
                        <th>{{ __('Action') }}</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($investors as $investor)
                        <tr>
                          <td>
                            <a class="avatar avatar-lg status-{{ is_null(app('App\Http\Controllers\FunctionsController')->hasPackages($investor->user)) ? 'danger' : 'success' }}" href="#"><img  src="{{ asset(!empty($investor->profile_picture) ? $investor->profile_picture : 'back-end/images/user2-160x160.jpg') }}" alt="investor-image">  </a> <br>
                            @if(!empty($investor->approved_identification))
                            <small style="color:green"><span><i class="fa fa-check" aria-hidden="true"></i> ID Verified</span></small>
                            @else
                            <small style="color:red"><span><i class="fa fa-times" aria-hidden="true"></i> ID UnVerified</span></small>
                            @endif
                          </td>
                          <td><a href="{{ route('investors.edit', ['investor' => $investor->id, 'hid' => 'profile' ]) }}"> {{ $investor->user->name  ?? 'NOT-SET'}} </a>
                            <small>
                            <br>
                            <i class="fa fa-envelope"></i> {{ $investor->user->email  ?? 'NOT-SET'}} <br>
                            <i class="fa fa-phone"></i> {{ $investor->phone  ?? 'NOT-SET'}} 
                             @if(auth()->user()->admin->level == 'admin')
                             @if(isset( $investor->created_by) && $investor->created_by != 1)
                             <br>
                             <span style="color:blue"><strong>Created By: </strong> {{ $investor->createdBy->name  ?? 'NOT SET'}} <a target="_blank" style="color:blue" href="{{ route('staff.edit', $investor->created_by ) }}"><i class="fa fa-external-link"></i></a></span>
                             @endif
                             @endif
                            </small>
                          </td>
                          <td><a href="{{ route('investors.edit', ['investor' => $investor->id, 'hid' => 'wallet' ]) }}">{{ $settings->currency_sign . number_format($investor->user->walletBalance(), 2) }}</a> <br>
                            <small>
                              <span>Type: </span>{{ ucfirst($investor->wallet_type) }} <br>
                              <span>Address:</span>{{ $investor->wallet_addrress }} 
                            </small>
                          </td>
                          <td><a href="{{ route('investors.edit', ['investor' => $investor->id, 'hid' => 'packages' ]) }}">{{ app('App\Http\Controllers\FunctionsController')->hasPackages($investor->user)->count() }} Package(s)
                            </a> </td>
                          <td style="padding: 10px 15px;width: min-content !important; margin: auto;">
                            <div class="actions" role="group" aria-label="Basic example"
                              style="display: inline-block;">
                              <a target="_blank" href="{{ route('investors.edit', ['investor' => $investor->id, 'hid' => 'profile' ]) }}" class="btn btn-block btn-info btn-xs"> <i class="fa fa-eye"></i>
                                Edit</a>
                              @if(auth()->user()->admin->level == 'admin')
                              <form onsubmit="return confirm('Are you sure you want to delete forever?');" action="{{ route('investors.destroy', $investor->id) }}" method="POST" style="margin-top: 5px;">
                              @csrf
                              @method('DELETE')
                              <button class="btn btn-block btn-danger btn-xs" type="submit"><i class="fa fa-trash"></i> Delete</button>
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
