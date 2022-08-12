<x-app-layout>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       {{ __('Edit Package') }}
      </h1>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('packages.index') }}"><i class="fa fa-dashboard"></i> Packages</a></li>
        <li class="breadcrumb-item active">{{ __('Create Package') }}</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Basic Forms -->
      <div class="box">
        <!-- /.box-header -->
        <div class="box-body">
          <div class="row">
            <div class="col">
              <form novalidate method="POST" action="{{ route('packages.update', ['package' => $package->id]) }}">
                @csrf
                @method('PUT')
                <div class="form-group">
                  <h5>{{ __('Name') }}</h5>
                  <div class="controls">
                    <input type="text" name="name" class="form-control" required
                      data-validation-required-message="This field is required" value="{{ old('name') ?? $package->name }}">
                  </div>
                  <div class="form-control-feedback">@error('name') {{ $message }} @enderror</div>
                </div>
                <div class="form-group">
                  <h5>{{ __('Short Description') }}</h5>
                  <div class="controls">
                    <textarea name="short_description" id="short_description" class="form-control" required placeholder="Short Description">{{ old('short_description') ?? $package->short_description }}</textarea>
                  </div>
                </div>
                <div class="form-group">
                  <h5>{{ __('Amount') }}</h5>
                  <div class="controls">
                    <input type="number" name="amount" class="form-control" required
                      data-validation-required-message="This field is required" min="0" value="{{ old('amount') ?? $package->amount }}" step=".01">
                  </div>
                  <div class="form-control-feedback">@error('amount'){{$message}}@enderror</div>
                </div>
                <div class="form-group">
                  <h5>{{ __('Max Amount') }}</h5>
                  <div class="controls">
                    <input type="number" name="max_amount" class="form-control" required
                      data-validation-required-message="This field is required" min="0" value="{{ old('max_amount') ?? $package->max_amount }}" step=".01">
                  </div>
                  <div class="form-control-feedback">@error('amount'){{$message}}@enderror</div>
                </div>
                 <div class="form-group">
                  <h5>{{ __('Daily ROI %') }}</h5>
                  <div class="controls">
                    <input type="number" name="daily_roi" class="form-control" required
                      data-validation-required-message="This field is required" step=".01" value="{{ old('daily_roi') ?? $package->daily_roi }}" min="1" max="100">
                  </div>
                  <div class="form-control-feedback">@error('daily_roi') {{ $message }} @enderror</div>
                </div>
                
                 <div class="form-group">
                  <h5>{{ __('Validity Period') }}</h5>
                  <div class="controls">
                    <input type="number" name="validity_period" class="form-control" required
                      data-validation-required-message="This field is required" min="1" max="31" value="{{ old('validity_period') ?? $package->validity_period }}">
                  </div>
                  <div class="form-control-feedback">@error('validity_period') {{ $message }} @enderror</div>
                </div>
                <div class="text-xs-right">
                  <button type="submit" class="btn btn-info">{{ __('Update') }}</button>
                </div>
              </form>

            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->

    </section>
    <!-- /.content -->
  </div>
</x-app-layout>
