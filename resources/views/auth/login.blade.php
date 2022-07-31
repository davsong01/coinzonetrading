<x-guest-layout>
  <x-auth-card :banner="asset('front-end/images/front-end-img/background/bg-8.jpg')" title="Login"> 
    <!---page Title --->
	<section class="bg-img pt-150 pb-20" data-overlay="7" style="background-image: url(../images/front-end-img/background/bg-8.jpg);">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<div class="text-center">						
						<h2 class="page-title text-white">Register & Login</h2>
						<ol class="breadcrumb bg-transparent justify-content-center">
							<li class="breadcrumb-item"><a href="#" class="text-white-50"><i class="mdi mdi-home-outline"></i></a></li>
							<li class="breadcrumb-item text-white active" aria-current="page">Register & Login</li>
						</ol>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!--Page content -->
	
	<section class="py-50">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-lg-6 col-12">
					<div class="box box-body">
						<ul class="nav nav-tabs nav-fill" role="tablist">
							<li class="nav-item"> <a class="nav-link active py-10 rounded" data-bs-toggle="tab" href="#login" role="tab">Login</a> </li>
							<li class="nav-item"> <a class="nav-link py-10 rounded" data-bs-toggle="tab" href="#register" role="tab">Register</a> </li>
						</ul>
					</div>
					<div class="box box-body mb-0">
						<div class="tab-content">
							<div class="tab-pane active" id="login" role="tabpanel">
								<div>				
									<div class="content-top-agile pb-0 pt-20">
										<h2 class="text-primary">Let's Get Started</h2>
										<p class="mb-0">Sign in to continue to CryptoCurrency.</p>							
									</div>
									<div class="p-40">
										<form action="index.html" method="post">
											<div class="form-group">
												<div class="input-group mb-15">
													<span class="input-group-text bg-transparent"><i class="ti-user"></i></span>
													<input type="text" class="form-control ps-15 bg-transparent" placeholder="Username">
												</div>
											</div>
											<div class="form-group">
												<div class="input-group mb-15">
													<span class="input-group-text  bg-transparent"><i class="ti-lock"></i></span>
													<input type="password" class="form-control ps-15 bg-transparent" placeholder="Password">
												</div>
											</div>
											  <div class="row">
												<div class="col-6">
												  <div class="checkbox ms-5">
													<input type="checkbox" id="basic_checkbox_1">
													<label for="basic_checkbox_1" class="form-label">Remember Me</label>
												  </div>
												</div>
												<!-- /.col -->
												<div class="col-6">
												 <div class="fog-pwd text-end">
													<a href="javascript:void(0)" class="hover-warning"><i class="ion ion-locked"></i> Forgot pwd?</a><br>
												  </div>
												</div>
												<!-- /.col -->
												<div class="col-12 text-center">
												  <button type="submit" class="btn btn-info w-p100 mt-15">SIGN IN</button>
												</div>
												<!-- /.col -->
											  </div>
										</form>	
										<div class="text-center">
											<p class="mt-15 mb-0">Don't have an account? <a href="register.html" class="text-warning ms-5">Register</a></p>
										</div>	
									</div>
									<div class="text-center">
									  <p>- Login With -</p>
									  <p class="d-flex gap-items-2 mb-20 justify-content-center">
										  <a class="btn btn-social-icon btn-round btn-facebook" href="#"><i class="fa fa-facebook"></i></a>
										  <a class="btn btn-social-icon btn-round btn-twitter" href="#"><i class="fa fa-twitter"></i></a>
										  <a class="btn btn-social-icon btn-round btn-instagram" href="#"><i class="fa fa-instagram"></i></a>
										</p>	
									</div>
								</div>
							</div>
							<div class="tab-pane" id="register" role="tabpanel">
								<div>									
									<div class="content-top-agile pb-0 pt-20">
										<h2 class="text-primary">Get started with Us</h2>
										<p class="mb-0">Register a New Membership</p>							
									</div>
									<div class="p-40">
										<form action="index.html" method="post">
											<div class="form-group">
												<div class="input-group mb-15">
													<span class="input-group-text bg-transparent"><i class="ti-user"></i></span>
													<input type="text" class="form-control ps-15 bg-transparent" placeholder="Full Name">
												</div>
											</div>
											<div class="form-group">
												<div class="input-group mb-15">
													<span class="input-group-text bg-transparent"><i class="ti-email"></i></span>
													<input type="email" class="form-control ps-15 bg-transparent" placeholder="Email">
												</div>
											</div>
											<div class="form-group">
												<div class="input-group mb-15">
													<span class="input-group-text bg-transparent"><i class="ti-lock"></i></span>
													<input type="password" class="form-control ps-15 bg-transparent" placeholder="Password">
												</div>
											</div>
											<div class="form-group">
												<div class="input-group mb-15">
													<span class="input-group-text bg-transparent"><i class="ti-lock"></i></span>
													<input type="password" class="form-control ps-15 bg-transparent" placeholder="Retype Password">
												</div>
											</div>
											  <div class="row">
												<div class="col-12">
												  <div class="checkbox ms-5">
													<input type="checkbox" id="basic_checkbox_22">
													<label for="basic_checkbox_22" class="form-label">I agree to the <a href="#" class="text-warning"><b>Terms</b></a></label>
												  </div>
												</div>
												<!-- /.col -->
												<div class="col-12 text-center">
												  <button type="submit" class="btn btn-info w-p100 mt-15">Register</button>
												</div>
												<!-- /.col -->
											  </div>
										</form>				
										<div class="text-center">
											<p class="mt-15 mb-0">Already have an account?<a href="login.html" class="text-danger ms-5"> Log In</a></p>
										</div>
									</div>

									<div class="text-center">
									  <p>- Register With -</p>
									  <p class="d-flex gap-items-2 mb-20 justify-content-center">
										  <a class="btn btn-social-icon btn-round btn-facebook" href="#"><i class="fa fa-facebook"></i></a>
										  <a class="btn btn-social-icon btn-round btn-twitter" href="#"><i class="fa fa-twitter"></i></a>
										  <a class="btn btn-social-icon btn-round btn-instagram" href="#"><i class="fa fa-instagram"></i></a>
										</p>	
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>			
	</section>	
    <section class="py-50">
      <div class="container">
        <div class="row justify-content-center g-0">
          <div class="col-lg-5 col-md-5 col-12">
            <div class="box box-body">
              <div class="content-top-agile pb-0 pt-20">
                <h2 class="text-primary">{{__("Let's Get Started")}}</h2>
                <p class="mb-0">{{__('Sign in to continue to CryptoCurrency.')}}</p>
              </div>
              <div class="p-40">
                <form method="POST" action="{{ route('login') }}">
									 @csrf
                    <!-- Session Status -->
                   <x-auth-session-status class="mb-4" :status="session('status')" />

                  <!-- Validation Errors -->
                  <x-auth-validation-errors class="mb-4" :errors="$errors" />

									 <!-- Username -->
                  <div class="form-group">
                    <div class="input-group mb-15">
											<span class="input-group-text bg-transparent"><i class="ti-user"></i></span>
                    	<x-form.input id="email" class="ps-15 bg-transparent" type="email" name="email"
                      :value="old('email')" placeholder="email" required autofocus />
                    </div>
                  </div>
									<!-- Password-->
                  <div class="form-group">
                    <div class="input-group mb-15">
                      <span class="input-group-text bg-transparent"><i class="ti-lock"></i></span>
											<x-form.input id="password" class="ps-15 bg-transparent" type="password" name="password"
                       placeholder="password" required autofocus />
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-6">
                      <div class="checkbox ms-5">
                        <input type="checkbox" id="basic_checkbox_1">
                        <label for="basic_checkbox_1" class="form-label">{{__('Remember Me')}}</label>
                      </div>
                    </div>
                    <!-- /.col -->
										 @if (Route::has('password.request'))
										 <div class="col-6">
											 <div class="fog-pwd text-end">
												 <a href="{{ route('password.request') }}" class="hover-warning"><i class="ion ion-locked"></i>{{ __(' Forgot your password?') }}</a><br>
											 </div>
										 </div>
                    @endif
                    <!-- /.col -->
                    <div class="col-12 text-center">
											<x-form.button class="btn-info w-p100 mt-15">
                      {{ __('SIGN IN') }}
                    </x-form.button>
                    </div>
                    <!-- /.col -->
                  </div>
                </form>
                {{-- <div class="text-center">
                  <p class="mt-15 mb-0">{{__("Don't have an account?")}} <a href="{{route('register')}}"
                      class="text-warning ms-5">{{__('Register')}}</a></p>
                </div> --}}
              </div>
            </div>

           
          </div>
        </div>
      </div>
    </section>
  </x-auth-card>
</x-guest-layout>
