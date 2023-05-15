<x-app-layout>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       {{ __('Top Up Wallet') }}
      </h1>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      </ol>
    </section>
	
    <!-- Main content -->
   	<section class="content">

      <div class="row">
        <div class="col-xl-12 col-lg-7">
          <div class="box box-solid bg-black">
			<div class="box-header with-border">
			  <h3 class="box-title">Top Up details</h3>
			</div>
			<!-- /.box-header -->
			<div class="box-body">
			  <div class="row">
				<div class="col-12">
                <form action="{{ route('wallet.topup.process') }}" method="post" style="margin:auto">
                    @csrf
					<div class="form-group row">
					  <label class="col-sm-2 col-form-label">Amount({{ $settings->currency_sign }})</label>
					  <div class="col-sm-10">
						  <input class="form-control" name="amount" type="text" value="{{ old('amount') }}" placeholder="Enter Amount" required>
						  <small style="color:blue">You will be required to make payment to a cryto wallet on the next page</small>
					  </div>
					</div>
					<div class="form-group row">
					  <label class="col-sm-2 col-form-label"></label>
					  <div class="col-sm-10">
						<button type="submit" style="width:100%" class="btn btn-yellow">Pay</button>
					  </div>
					</div>
                </form>
				</div>
				<!-- /.col -->
			  </div>
			  <!-- /.row -->
			</div>
			<!-- /.box-body -->
		  </div>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

	</section>
    <!-- /.content -->
  </div>
</x-app-layout>
