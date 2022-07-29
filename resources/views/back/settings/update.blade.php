<x-app-layout>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       {{ __('App Settings') }}
      </h1>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="breadcrumb-item active">{{ __('Update Settings') }}</li>
      </ol>
    </section>

    <!-- Main content -->
   <section class="content">

      <div class="row">
		<div class="col-xl-6 col-lg-6">
          <div class="box box-solid bg-black">
			<div class="box-header with-border settings1">
			  <h3 class="box-title">App Settings</h3>
			</div>
			<!-- /.box-header -->
			<div class="box-body">
			  <div class="row">
				<div class="col-12">
                <form action="{{ route('setting1.store') }}" method="post" style="margin:auto" enctype="multipart/form-data">
                    @csrf
					<div class="form-container">
						<div class="form-group row">
						<label class="form-label">Official Email</label>
							<input class="form-control" name="official_email" type="text" value="{{ $settings->official_email ?? old('official_email') }}" required>
						</div>
						<div class="form-group row">
						<label class="form-label">Investor Wallet Types (Seperate each by comma) <br> <b style="color:red"> <small>This will determine what type of wallet investors can select when requesting for withdrawal</small> </b></label>
						<textarea class="form-control" name="wallet_types" id="wallet_types" cols="30" rows="3">{{ $settings->wallet_types }}</textarea>
						</div>
						<div class="form-group row">
						<label class="form-label">Currency Sign, e.g. $</label>
							<input class="form-control" name="currency_sign" type="text" value="{{ $settings->currency_sign ?? old('currency_sign') }}" required>
						</div>
					</div>
					<div class="form-group row">
						<button type="submit" class="btn btn-yellow settings1" style="margin: auto;">Update App Settings</button>
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
        </div>
        <!-- /.col -->

        <div class="col-xl-6 col-lg-6">
          <div class="box box-solid bg-black">
			<div class="box-header with-border">
			  <h3 class="box-title">Developer Settings</h3>
			</div>
			<!-- /.box-header -->
			<div class="box-body">
			  <div class="row">
				<div class="col-12">
                <form action="{{ route('setting2.store') }}" method="post" style="margin:auto" enctype="multipart/form-data">
                    @csrf
					<div class="form-container">
						<div class="form-group row">
						<label class="form-label">API key</label>
							<input class="form-control" name="api_key" type="text" value="{{ $settings->api_key ?? old('api_key') }}" required>
						</div>
						<div class="form-group row">
						<label class="form-label">Currency, e.g. USD (Will be used in creating charges)</label>
							<input class="form-control" name="currency" type="text" value="{{ $settings->currency ?? old('currency') }}" required>
						</div>
						<div class="form-group row">
						<label class="form-label">Callback Url <b color:red>Leave this as it is except you know what you are doing</b></label>
							<input class="form-control" name="callback_url" type="text" value="{{ $settings->callback_url ?? old('callback_url') }}" required>
						</div>			
					</div>
							
					<div class="form-group row">
					  <label class="form-label"></label>
						<button type="submit" class="btn btn-yellow settings2" style="border: none;margin: auto;">Update Api settings</button>
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
        </div>
        <!-- /.col -->

		<div class="col-xl-6 col-lg-6">
          <div class="box box-solid bg-black">
			<div class="box-header with-border settings3">
			  <h3 class="box-title">Appearance Settings</h3>
			</div>
			<!-- /.box-header -->
			<div class="box-body">
			  <div class="row">
				<div class="col-12">
                <form action="{{ route('setting3.store') }}" method="post" style="margin:auto" enctype="multipart/form-data">
                    @csrf
					<div class="form-container">
					
						<div class="form-group row">
							<label class="form-label">Replace Favicon <img src="{{ asset($settings->favicon) }}" style="max-width: 20px;margin: 5px;" alt="favicon"></label> 
							<input class="form-control" name="favicon" type="file">
						</div>
						<div class="form-group row">
							<label class="form-label">Logo (light) <img src="{{ asset($settings->light_logo) }}" style="max-width: 80px;margin: 5px;" alt="light_logo"></label>
							<input class="form-control" name="light_logo" type="file">
						</div>
						<div class="form-group row">
							<label class="form-label">Logo (dark) <img src="{{ asset($settings->dark_logo) }}" style="max-width: 80px;margin: 5px;" alt="dark_logo"></label>
							<input class="form-control" name="dark_logo" type="file">
						</div>

						<div class="form-group row">
							<label class="form-label">Page banner <img src="{{ asset($settings->page_banner) }}" style="max-width: 80px;margin: 5px;" alt="page_banner"></label>
							<input class="form-control" name="page_banner" type="file">
						</div>		
					</div>

					<div class="form-group row">
					  <label class="form-label"></label>
						<button type="submit" class="btn btn-yellow settings3" style="border: none;margin: auto;">Update Appearance settings</button>
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
        </div>
      </div>
      <!-- /.row -->

    </section>
    <!-- /.content -->
  </div>
</x-app-layout>
