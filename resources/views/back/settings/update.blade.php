@section('css')
<link rel="stylesheet" href="{{ asset('back-end/assets/vendor_plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.css')}}">
@endsection
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
				<div class="col-md-3">
					<div class="box-body">
						<a data-toggle="tooltip" data-placement="top" title="This feature clears the site's cache" class="btn btn-info" href="{{ route('cache.clear') }}">
							<i class="fa fa-refresh"></i> Clear App Cache
						</a>
					</div>
				</div>
				<div class="col-md-3">
					<div class="box-body">
						<a data-toggle="tooltip" data-placement="top" title="This feature resolves investors whose wallets have not been credited, it handles 500 requests at a time" class="btn btn-success" href="{{ route('wallet.resolve') }}">
							<i class="fa fa-refresh"></i> <i class="icon-wallet"></i> Run wallet cron
						</a>
					</div>
				</div>
			</div>

			<div class="row">
				@if(auth()->user()->admin->level == 'admin')

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
											<div class="form-group row">
												<label class="form-label">Allow wallet buy</label>
												<select name="allow_wallet_buy" id="allow_wallet_buy" class="form-control" required>
													<option value="active" {{ 'active' == $settings->allow_wallet_buy ? 'selected' : '' }}>Active</option>
													<option value="inactive" {{ 'inactive' == $settings->allow_wallet_buy ? 'selected' : '' }}>Inactive</option>
												</select>
											</div>
											<div class="form-group row">
												<label class="form-label">Coin Price List Widget for trade</label>
												<textarea class="form-control" name="coin_price_list_widget" id="" cols="30" rows="10" value="{!! old('coin_price_list_widget') ?? $settings->coin_price_list_widget !!}">{!! $settings->coin_price_list_widget !!}</textarea>
												
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
				@endif
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
				@if(auth()->user()->admin->level == 'admin')

				<div class="col-xl-6 col-lg-6">
					<div class="box box-solid bg-black">
						<div class="box-header with-border settings4">
							<h3 class="box-title">Other Settings</h3>
						</div>
						<!-- /.box-header -->
						<div class="box-body">
							<div class="row">
								<div class="col-md-12" style="margin-top: -14px;">
									<form action="{{ route('setting4.store') }}" method="post" style="margin:auto" enctype="multipart/form-data">
										@csrf
										<div class="form-container">
											<div class="form-group">
												<div class="col-md-6 column">
													<label class="form-label" data-toggle="tooltip" data-placement="top" title="Investor must have up to this amount in wallet before they can create request to withdraw">Minimum Withdrawal Amount</label>
													<input class="form-control" name="minimum_withdrawal_amount" type="number" value="{{ $settings->minimum_withdrawal_amount ?? old('minimum_withdrawal_amount') }}" required>
												</div>
											</div>
											<div class="form-group">
												<div class="col-md-6 column">
													<label class="form-label" data-toggle="tooltip" data-placement="top" title="Investor cannot request more than this amount for withdrawal. If left blank, investor will be able to withdraw evrything in their wallet">Maximum Withdrawal Amount</label>
													<input class="form-control" name="maximum_withdrawal_amount" type="number" value="{{ $settings->maximum_withdrawal_amount ?? old('maximum_withdrawal_amount') }}" required>
												</div>
											</div>
											<div class="form-group">
												<div class="col-md-6 column">
													<label class="form-label" data-toggle="tooltip" data-placement="top" title="This controls the cycle of withdrawal for investors. e.g 30 means investor can only request for withdrawal once in 30 days">Withdrawal frequency</label>
													<input class="form-control" name="withdrawal_frequency" type="number" value="{{ $settings->withdrawal_frequency ?? old('withdrawal_frequency') }}" required>
												</div>
											</div>
											<div class="form-group">
												<div class="col-md-6 column">
													<label class="form-label">Facebook link</label>
													<input class="form-control" name="facebook" type="url" value="{{ $settings->facebook ?? old('facebook') }}">
												</div>
											</div>
											<div class="form-group">
												<div class="col-md-6 column">
													<label class="form-label">Twitter link</label>
													<input class="form-control" name="twitter" type="url" value="{{ $settings->twitter ?? old('twitter') }}">
												</div>
											</div>
											<div class="form-group">
												<div class="col-md-6 column">
													<label class="form-label">Instagram link</label>
													<input class="form-control" name="instagram" type="url" value="{{ $settings->instagram ?? old('instagram') }}">
												</div>
											</div>
											<div class="form-group">
												<div class="col-md-6 column">
													<label class="form-label">Youtube link</label>
													<input class="form-control" name="youtube" type="url" value="{{ $settings->youtube ?? old('youtube') }}">
												</div>
											</div>
											<div class="form-group">
												<div class="col-md-6 column">
													<label class="form-label">Linkedin link</label>
													<input class="form-control" name="linkedin" type="url" value="{{ $settings->linkedin ?? old('linkedin') }}">
												</div>
											</div>
										</div>
										<div class="form-group row">
											<label class="form-label"></label>
											<button type="submit" class="btn btn-yellow settings4" style="border: none;margin: auto;">Update Appearance settings</button>
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

				<div class="col-xl-12 col-lg-12">
					<div class="box box-solid bg-black">
						<div class="box-header with-border settings5">
							<h3 class="box-title">Pages Settings</h3>
						</div>
						<!-- /.box-header -->
						<div class="box-body">
							<div class="row">
								<div class="col-md-12" style="margin-top: -14px;">
									<form action="{{ route('setting5.store') }}" method="post" style="margin:auto" enctype="multipart/form-data">
										@csrf
										<div class="form-container">
											<div class="form-group">
												<div class="col-md-12">
													<label class="form-label">Privacy Policy Content</label>
													<textarea id="editor1" name="privacy_policy" rows="20" cols="80">
														{!! $settings->privacy_policy !!}
													</textarea>
												</div>

												<div class="col-md-12">
													<label class="form-label">Terms and Conditions</label>
													<textarea id="editor2" name="rules" rows="20" cols="80">
														{!! $settings->rules !!}
													</textarea>
												</div>

											</div>
											<div class="form-group row">
												<label class="form-label"></label>
												<button type="submit" class="btn btn-yellow settings4" style="border: none;margin: auto;">Update CMS settings</button>
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
				@endif
			</div>
			<!-- /.row -->

		</section>
		<!-- /.content -->
	</div>
<script src="{{ asset('back-end/assets/vendor_components/jquery/dist/jquery.min.js')}}"></script>
<!-- CK Editor -->
<script src="{{ asset('back-end/assets/vendor_components/ckeditor/ckeditor.js')}}"></script>
<!-- Crypto_Admin for editor -->
<script src="{{ asset('back-end/js/pages/editor.js') }}"></script>
 <script src="https://cdn.ckeditor.com/ckeditor5/12.0.0/classic/ckeditor.js"></script>
<script>
	CKEDITOR.replace( 'editor2' );
	CKEDITOR.on( 'instanceReady', function( evt )
	{
		var editor = evt.editor;
	
		editor.on('change', function (e) { 
			var contentSpace = editor.ui.space('contents');
			var ckeditorFrameCollection = contentSpace.$.getElementsByTagName('iframe');
			var ckeditorFrame = ckeditorFrameCollection[0];
			var innerDoc = ckeditorFrame.contentDocument;
			var innerDocTextAreaHeight = $(innerDoc.body).height();
			console.log(innerDocTextAreaHeight);
		});
	 });
    </script>
</x-app-layout>
