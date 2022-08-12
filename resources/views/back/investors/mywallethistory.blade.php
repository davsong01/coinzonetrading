<x-app-layout>
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       {{ __('Wallet history') }}
      </h1>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i>Dashboard</a></li>
      </ol>
    </section>
   
    <!-- Main content -->
   
    <section class="content">
      <!-- START Card With Image -->
      
      <div class="row">
          <div class="col-lg-12 col-12">         
          <div class="box">
            <div class="box-header with-border">
              
            </div>
            <!-- /.box-header -->
            <div class="box-body"> 
              @if($wallets->count() > 0)
              <div class="table-responsive">
                <div id="example_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4">
                  <table id="example" class="table table-bordered responsive table-hover display nowrap margin-top-10 w-p100 dataTable"
                    role="grid" aria-describedby="example_info">
                    <thead>
                      <tr>
                        <th>{{ __('S/N') }}</th>
                        <th>{{ __('Reference ID') }}</th>
                        <th>{{ __('Amount') }}</th>
                        <th>{{ __('Type') }}</th>

                      </tr>
                    </thead>
                    <tbody>
                      @php
                          $count = 1;
                      @endphp
                      @foreach ($wallets as $wallet)
                      <tr>
                        <td>{{ $count ++ }}</td>
                        <td>{{ $wallet->reference }}
                        <small> <br>
                            <strong style="color: #dd3765;">Created on: </strong>{{ $wallet->created_at }} <br>
                        </small>
                        </td>
                        <td>{{ $settings->currency_sign . number_format($wallet->amount) }}</td>
                        <td style="color:{{ $wallet->type == 'credit' ? 'green' : 'red'}}">{{ ucfirst($wallet->type) }}</td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
              @else
              <h4>No wallet history yet!</h4> 
              @endif
            </div>
            <!-- /.box-body -->
            </div>
            <!-- /.box -->       
          </div>
        </div>	
    
    </section>
  </div>
  
</x-app-layout>
