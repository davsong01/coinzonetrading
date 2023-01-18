<x-app-layout>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
       {{ __('Trade requests') }}
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
                        <th>{{ __('Investor') }}</th>
                        <th>{{ __('Trade Id') }}</th>
                        <th>{{ __('Amount') }}</th>
                        <th>{{ __('Instrument') }}</th>
                        <th>{{ __('Status') }}</th>
                        <th>{{ __('Action') }}</th>
                      </tr>
                    </thead>
                    <tbody>
                      @php
                          $count = 1;
                      @endphp
                      @foreach ($histories as $history)
                      <tr>
                        <td>{{ $count++ }}</td>
                        <td>{{ $history->investor->user->name ?? null }} <br> <small>{{ $history->investor->user->email ?? null }} <br>
                          @if($history->status == 'Initiated' || $history->status == 'In Progress')
                          <span style="color:blue">Wallet Balance : ${{  number_format($history->investor->user->walletBalance(), 2) }}</span>
                          @endif
                        </small> </td>
                        <td>{{ $history->trade_id }}
                          @if($history->status == 'Complete')
                          <p>
                          <small>Type: </small><small style="color:{{ $history->type=='loss' ? 'red':'green' }}">{{ $history->type }}</small><br>
                          <small>Percent: </small><small style="color:{{ $history->type=='loss' ? 'red':'green' }}">{{ $history->percent }}%</small><br>
                          </p>
                          @endif
                        </td>
                        <td>{{ $settings->currency_sign. number_format($history->amount, 2) }}
                          @if($history->status == 'Complete') <br>
                          <small style="color:{{ $history->type=='loss' ? 'red':'green' }}">${{ $history->bonus['bonus'] .' '. $history->bonus['type']}}</small>
                          @endif
                        </td>
                        <td>{{ $history->instrument}}</td>
                        <td>{{ $history->status}} 
                          
                          @if($history->status == 'Initiated') <br>
                          <small class="sm">On:  {{date("F dS, Y", strtotime($history->created_at))}}, {{date("h:ia", strtotime($history->created_at))}}</small>
                          @endif
                          @if($history->status == 'In Progress') <br>
                          <small class="sm">Updated by: {{ $history->admin->user->name ?? null}} <br>
                          On:   {{date("F dS, Y", strtotime($history->approved_date))}}, {{date("h:ia", strtotime($history->approved_date))}}
                          </small>
                          @endif
                          @if($history->status == 'Closed') <br>
                            @if(is_null($history->admin_id))
                            <small class="sm">By: Investor</small>
                            @else
                            <small class="sm">By: {{ $history->admin->user->name ?? null}}</small>
                            @endif
                          @endif
                        </td>
                        <td>
                        @if($history->status == 'Initiated')
                        <a class="btn btn-primary" style="margin-top: 5px;"  href="{{ route('admin.approve.request', $history->id) }}" onclick="return confirm('You are about to approve this request?');">Start Trade</a>
                        <a class="btn btn-danger" style="margin-top: 5px;" href="{{ route('admin.close.request', $history->id) }}" onclick="return confirm('You are about to close this request?');"><i class="fa fa-times"></i> Cancel</a> 
                        @endif
                        @if($history->status == 'In Progress')
                        <a data-toggle="modal" data-target="#complete-{{ $history->id }}" class="btn btn-success" style="margin-top: 5px;"><i class="fa fa-check"></i> Complete Trade</a>
                        <div class="modal fade" id="complete-{{ $history->id }}" tabindex="-1" role="dialog">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span class="ti-close" aria-hidden="true"></span></button>
                                        <p>
                                          <strong class="bold">Trade ID :</strong> {{ $history->trade_id }}<br>
                                          <strong class="bold">Trade Amount :</strong> ${{ number_format($history->amount, 2) }}
                                        </p>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row no-gutters">
                                          <!-- /.box-header -->
                                          <div class="box-body">
                                            <div class="row">
                                              <div class="col-md-12">
                                                <form method="POST" action="{{ route('admin.complete.request', $history->id) }}"  onsubmit="return confirm('You are about to complete this request, action cannot be undone');">
                                                  @csrf
                                                  <div class="form-group">
                                                    <h5 class="" style="margin-left: 9px;">Select Type</h5>
                                                    <div class="controls">
                                                      <select name="type" id="" class="form-control" required>
                                                        <option value="" selected>Select Type</option>
                                                        <option value="profit" {{ old('type') == 'profit' ? 'selected' : '' }}>Profit</option>
                                                        <option value="loss" {{  old('type') == 'loss' ? 'selected' : ''}}>Loss</option>
                                                      </select>
                                                    </div>
                                                  </div>
                                                  <div class="form-group">
                                                    <h5 class="" style="margin-left: 9px;">Percentage Profit/Loss</h5>
                                                    <div class="controls">
                                                      <input type="number" name="percent" class="form-control" step=".01" required value="{{ old('profit') }}">
                                                    </div>
                                                  </div>
                                                  <div class="text-xs-right">
                                                    <button style="margin: auto;display: flex;" type="submit" class="btn btn-info">{{ __('Submit') }}</button>
                                                  </div>
                                                </form>

                                              </div>
                                              <!-- /.col -->
                                            </div>
                                            <!-- /.row -->
                                          </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                          {{-- href="{{ route('admin.complete.request', $history->id) }} --}}
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
