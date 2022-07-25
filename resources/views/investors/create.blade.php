<x-app-layout>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          {{ __('Create Investors') }}
        </h1>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('investors.index') }}"><i class="fa fa-dashboard"></i>
              {{ __('investors') }}</a></li>
          <li class="breadcrumb-item active"><a href="{{ route('investors.create') }}">{{ __('Create') }}</a></li>
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
                <form novalidate method="POST" action="{{ route('investors.store') }}">
                  @csrf
                  <div class="form-group">
                    <h5>{{ __('Name') }}</h5>
                    <div class="controls">
                      <input type="text" name="name" class="form-control" required
                        data-validation-required-message="This field is required" value="{{ old('name') }}">
                    </div>
                    <div class="form-control-feedback">
                      @error('name')
                        {{ $message }}
                      @enderror
                    </div>
                  </div>
                  <div class="form-group">
                    <h5>{{ __('Phone') }}</h5>
                    <div class="controls">
                      <input type="text" name="phone" class="form-control" required
                        data-validation-required-message="This field is required" value="{{ old('phone') }}">
                    </div>
                    <div class="form-control-feedback">
                      @error('phone')
                        {{ $message }}
                      @enderror
                    </div>
                  </div>
                  <div class="form-group">
                    <h5>{{ __('Wallet Type') }}</h5>
                    <div class="controls">
                      <input type="text" name="name" class="form-control" required
                        data-validation-required-message="This field is required" value="{{ old('wallet_type') }}">
                    </div>
                    <div class="form-control-feedback">
                      @error('wallet_type')
                        {{ $message }}
                      @enderror
                    </div>
                  </div>
                  <div class="form-group">
                    <h5>{{ __('Wallet Address') }}</h5>
                    <div class="controls">
                      <input type="text" name="wallet_address" class="form-control" required
                        data-validation-required-message="This field is required" value="{{ old('wallet_address') }}">
                    </div>
                    <div class="form-control-feedback">
                      @error('wallet_address')
                        {{ $message }}
                      @enderror
                    </div>
                  </div>
                  <div class="text-xs-right">
                    <button type="submit" class="btn btn-info">{{ __('Submit') }}</button>
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
    <!-- /.content -->
</x-app-layout>
