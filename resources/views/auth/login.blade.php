<x-guest-layout>
  <x-auth-card :banner="asset('front-end/images/front-end-img/background/bg-8.jpg')" title="Login">

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
