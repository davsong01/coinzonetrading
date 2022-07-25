<x-app-layout>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>{{ request()->routeIs('packages.*') ? 'Packages' : '' }}</h1>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#"><i class="fa fa-dashboard"></i> {{ __('Packages') }}</a></li>
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
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>{{ __('Name') }}</th>
                      <th>{{ __('Short Description') }}</th>
                      <th>{{ __('Amount') }}</th>
                      <th>{{ __('Daily ROI') }}</th>
                      <th>{{ __('Monthly ROI') }}</th>
                      <th>{{ __('Validity Period') }}</th>
                      <th>{{ __('Action') }}</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($packages as $package)
                      <tr>
                      <td>{{ $package->name }}</td>
                      <td>{{ $package->short_description }}</td>
                      <td>{{ number_format($package->amount) }}</td>
                      <td>{{ $package->daily_roi }}</td>
                      <td>{{ $package->monthly_roi }}</td>
                      <td>{{ $package->validity_period }}</td>
                      <td style="padding: 10px 15px;width: min-content !important; margin: auto;">
                        <div class="actions" role="group" aria-label="Basic example" style="display: inline-block;">
                          <button type="button" class="btn btn-block btn-info btn-xs"> <i class="fa fa-eye"></i> View</button>
                          <button type="button" class="btn btn-block btn-danger btn-xs"> <i class="fa fa-trash"></i> Delete</button>
                        </div>
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                  <tfoot>
                    <tr>
                      <th>{{ __('Name') }}</th>
                      <th>{{ __('Short Description') }}</th>
                      <th>{{ __('Amount') }}</th>
                      <th>{{ __('Daily ROI') }}</th>
                      <th>{{ __('Monthly ROI') }}</th>
                      <th>{{ __('Validity Period') }}</th>
                    </tr>
                  </tfoot>
                </table>
              </div>
            </div>
            <!-- /.box-body -->
          </div>
        </div>
      </div>
    </section>

    <!-- /.content -->
  </div>
</x-app-layout>
