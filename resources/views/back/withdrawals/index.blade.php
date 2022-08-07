<x-app-layout>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
       {{ __('Withdraws') }}
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
                        <th>{{ __('S/N') }}</th>
                        <th>{{ __('Amount') }}</th>
                        <th>{{ __('Reference ID') }}</th>
                        <th>{{ __('Requested By') }}</th>
                        <th>{{ __('Status') }}</th>
                        <th>{{ __('Action') }}</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($withdrawals as $withdrawal)
                      <tr>
                        <td>{{ $loop->index }}</td>
                        <td>{{ $settings->currency_sign. number_format($withdrawal->amount) }}</td>
                        <td>{{ $withdrawal->reference_id }}</td>
                        
                        <td>{{ $withdrawal->requestedBy->name }} <br>
                          <small style="color:blue">{{ $withdrawal->requestedBy->email }}</small> <br>
                          <small>{{ $withdrawal->created_at }}</small>
                        </td>
                        <td style="color:{{ $withdrawal->status == 'accepted' ? 'green' : ''}} {{ $withdrawal->status == 'pending' ? '#f38e3f' : ''}} {{ $withdrawal->status == 'rejected' ? 'red' : ''}}">{{ ucfirst($withdrawal->status) }}</td>
                        <td style="padding: 10px 15px;width: min-content !important; margin: auto;">

                            <div class="actions" role="group" aria-label="Basic example"
                              style="display: inline-block;">
                              @if(auth()->user()->admin->level == 'admin')
                                @if($withdrawal->status == 'accepted' || $withdrawal->status == 'rejected')
                                <small><b>By: </b><span class="approved_by">{{ $withdrawal->approvedBy->name }}</></span> </small> <br>
                                <small style="color:blue"> <b>On: </b> {{ $withdrawal->approved_date }}</small>
                                @endif

                                <form action="{{ route('withdrawal.update', ['withdrawal' => $withdrawal->id ]) }}" method="post">
                                  @csrf
                                  @method('PATCH')
                                  <input type="hidden" name="status" value="rejected">
                                  <button type="submit" class="btn btn-block btn-danger btn-xs my-2"> <i class="fa fa-trash"></i>
                                  Reject</button>
                                </form>

                                <form action="{{ route('withdrawal.update', ['withdrawal' => $withdrawal->id ]) }}" method="post">
                                  @csrf
                                  @method('PATCH')
                                  <input type="hidden" name="status" value="accepted">
                                  <button type="submit" class="btn btn-block btn-success btn-xs my-2"> <i class="fa fa-checked"></i>
                                  Accept</button>
                                </form>
                              @else
                              @if($withdrawal->status == 'pending')
                              <form action="{{ route('withdrawal.update', ['withdrawal' => $withdrawal->id ]) }}" method="post">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="status" value="rejected">
                                <button type="submit" class="btn btn-block btn-danger btn-xs my-2"> <i class="fa fa-trash"></i>
                                Reject</button>
                              </form>

                              <form action="{{ route('withdrawal.update', ['withdrawal' => $withdrawal->id ]) }}" method="post">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="status" value="accepted">
                                <button type="submit" class="btn btn-block btn-success btn-xs my-2"> <i class="fa fa-checked"></i>
                                Accept</button>
                              </form>
                              @else
                              @if($withdrawal->status == 'accepted' || $withdrawal->status == 'rejected')
                              <small> <b>By: </b><span class="approved_by">{{ $withdrawal->approvedBy->name }}</></span> </small><br>
                              <small style="color:blue"> <b>On: </b> {{ $withdrawal->approved_date }}</small>
                              @endif
                              @endif
                              @endif
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
