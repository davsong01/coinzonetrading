<x-app-layout>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       {{ __('My Profile') }}
      </h1>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      </ol>
    </section>

    <!-- Main content -->
   	<section class="content">

      <div class="row">
        <div class="col-xl-4 col-lg-5">

          <!-- Profile Image -->
          <div class="box bg-yellow bg-deathstar-dark">
            <div class="box-body box-profile">
            <img class="profile-user-img rounded img-fluid mx-auto d-block"  src="
			@if(auth()->user()->role == 'admin' || auth()->user()->role == 'staff')
			{{ asset(!empty(auth()->user()->admin->profile_picture) ? auth()->user()->admin->profile_picture : 'back-end/images/user2-160x160.jpg') }}
			@else
			{{ asset(!empty(auth()->user()->investor->profile_picture) ? auth()->user()->investor->profile_picture : 'back-end/images/user2-160x160.jpg') }}
			@endif
			" alt="User Image">
              <h2 class="profile-username text-center mb-0">{{ auth()->user()->name }}</h2>
              <h4 class="text-center mt-0"><i class="fa fa-envelope-o mr-10"></i>{{ auth()->user()->email }}</h4>
              <div class="form-group row"> <br><br>
                <form action="{{ route('replaceavatar') }}" method="post" enctype="multipart/form-data" style="margin:auto">
                    @csrf
                    <label class="col-sm-12 col-form-label" style="text-align: center">Replace profile picture</label>
                    <div class="col-sm-12">
                    <input class="form-control" type="file" name="profile_picture">
                    </div> <br>
                    <div class="form-group row" style="text-align: center">
					  <div class="col-sm-12">
						<button type="submit" class="btn btn-yellow">Replace</button>
					  </div>
					</div>
                </form>
                </div>  
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->

        <div class="col-xl-8 col-lg-7">
          <div class="box box-solid bg-black">
			<div class="box-header with-border">
			  <h3 class="box-title">Personal details</h3>
			</div>
			<!-- /.box-header -->
			<div class="box-body">
			  <div class="row">
				<div class="col-12">
                <form action="{{ route('profile.store') }}" method="post" style="margin:auto">
                    @csrf
					<div class="form-group row">
					  <label class="col-sm-2 col-form-label">Full Name</label>
					  <div class="col-sm-10">
						<input class="form-control" name="name" type="text" value="{{ auth()->user()->name ?? old('name') }}" placeholder="Full name" required>
					  </div>
					</div>
                    <div class="form-group row">
					  <label class="col-sm-2 col-form-label">Phone number</label>
					  <div class="col-sm-10">
						<input class="form-control" name="phone" type="text" value="{{ (auth()->user()->role == 'admin' || auth()->user()->role == 'staff') ? (auth()->user()->admin->phone ?? old('phone') ): (auth()->user()->investor->phone ?? old('phone')) }}"
						 placeholder="Phone number" required>
					  </div>
					</div>
					
					<div class="form-group row">
					  <label class="col-sm-2 col-form-label"></label>
					  <div class="col-sm-10">
						<button type="submit" class="btn btn-yellow">Submit</button>
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
		  <!-- /.box -->
		  @if(auth()->user()->role == 'investor')
          <div class="box box-solid bg-black">
			<div class="box-header with-border">
			  <h3 class="box-title">Wallet details</h3>
			</div>
			<!-- /.box-header -->
			<div class="box-body">
			  <div class="row">
				<div class="col-12">
                    <?php 
                    $types = app('App\Http\Controllers\Controller')->walletTypes(); 
					  
                    ?>
                    <form action="{{ route('profile.store') }}" method="post" style="margin:auto">
                   @csrf
					<div class="form-group row">
					  <label class="col-sm-2 col-form-label">Wallet Type</label>
					  <div class="col-sm-10">
                        <select name="wallet_type" id="wallet_type" class="form-control" required>
							<option value="">Select</option>
                            @foreach($types as $type)
                            <option value="{{ $type }}" {{ auth()->user()->investor->wallet_type == $type ? 'selected' : '' }}>{{ $type }}</option>
                            @endforeach
                        </select>
						
					  </div>
					</div>
                    
					<div class="form-group row">
					  <label class="col-sm-2 col-form-label">Wallet address (Used for withdrawal requests)</label>
                     
					  <div class="col-sm-10">
						<input class="form-control" type="text" name="wallet_address" value="{{ auth()->user()->investor->wallet_addrress ?? old('wallet_address') }}" required>
					  </div>
					</div>
					<div class="form-group row">
					  <label class="col-sm-2 col-form-label"></label>
					  <div class="col-sm-10">
						<button type="submit" class="btn btn-yellow">Submit</button>
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
		  @endif
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

	</section>
    <!-- /.content -->
  </div>
</x-app-layout>
