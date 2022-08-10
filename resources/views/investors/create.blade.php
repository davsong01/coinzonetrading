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
                    <h5>{{ __('Email') }}</h5>
                    <div class="controls">
                      <input type="email" name="email" class="form-control" required value="{{ old('email') }}">
                    </div>
                    
                  </div>
                  <div class="form-group">
                    <h5>{{ __('Name') }}</h5>
                    <div class="controls">
                      <input type="text" name="name" class="form-control" required value="{{ old('name') }}">
                    </div>
                    
                  </div>
                  <div class="form-group">
                    <h5>{{ __('Phone') }} (Optional)</h5>
                    <div class="controls">
                      <input type="text" name="phone" class="form-control" value="{{ old('phone') }}">
                    </div>
                    
                  </div>
                  <div class="form-group">
                    <h5>{{ __('Profile Picture') }}</h5>
                    <div class="controls">
                      <input type="file" name="profile_picture" class="form-control" value="{{ old('profile_picture') }}">
                    </div>
                  </div>
                  <div class="form-group">
                    <h5>{{ __('Password') }} (Leave blank to use 12345678 as default password)</h5>
                    <div class="controls">
                      <input class="form-control" name="password" type="text" value="{{ old('password') }}" placeholder="Enter password">
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
