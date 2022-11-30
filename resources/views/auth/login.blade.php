<x-guest-layout>
  <!---page Title --->
  <x-auth-card :banner="asset('front-end/images/front-end-img/background/bg-8.jpg')" title="Register & Login">

    <!--Page content -->

    <section class="py-50">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-6 col-12">
            <div class="box box-body">
              <ul class="nav nav-tabs nav-fill" role="tablist">
                <li class="nav-item"> <a class="nav-link active py-10 rounded" data-bs-toggle="tab" href="#login"
                    role="tab">Login</a> </li>
                <li class="nav-item"> <a class="nav-link py-10 rounded" data-bs-toggle="tab" href="#register"
                    role="tab">Register</a> </li>
              </ul>
            </div>
            <div class="box box-body mb-0">
              <div class="tab-content">
                <div class="tab-pane active" id="login" role="tabpanel">
                  <div>
                    <div class="content-top-agile pb-0 pt-20">
                      <h2 class="text-primary">Let's Get Started</h2>
                      <p class="mb-0">Sign in to continue to {{ env('APP_NAME') }}</p>
                    </div>
                    <div class="p-40">
                      <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <!-- Session Status -->
                        <x-auth-session-status class="mb-4 session-status" :status="session('status')" />

                        <!-- Validation Errors -->
                        <x-auth-validation-errors class="mb-4 validation-errors" :errors="$errors" />

                        <!-- Username -->
                        <div class="form-group">
                          <div class="input-group mb-15">
                            <span class="input-group-text bg-transparent"><i class="ti-user"></i></span>
                            <x-form.input id="email" class="ps-15 bg-transparent" type="email" name="email"
                              :value="old('email')" placeholder="Email" required autofocus />
                          </div>
                        </div>
                        <!-- Password-->
                        <div class="form-group">
                          <div class="input-group mb-15">
                            <span class="input-group-text bg-transparent"><i class="ti-lock"></i></span>
                            <x-form.input id="password" class="ps-15 bg-transparent" type="password" name="password"
                              placeholder="Password" required autofocus />
                          </div>
                        </div>

                        <div class="row">
                          <div class="col-md-6">
                            <div class="checkbox ms-5">
                              <input type="checkbox" id="basic_checkbox_1">
                              <label for="basic_checkbox_1" class="form-label remember">{{ __('Remember Me') }}</label>
                            </div>
                          </div>
                          <!-- /.col -->
                          @if (Route::has('password.request'))
                            <div class="col-md-6">
                              <div class="fog-pwd">
                                <a href="{{ route('password.request') }}" class="hover-warning remember"><i
                                    class="ion ion-locked"></i>{{ __(' Forgot your password?') }}</a><br>
                              </div>
                            </div>
                          @endif
                          <!-- /.col -->
                          <div class="col-12 text-center">
                            <x-form.button class="btn-info w-p100 mt-15 submit-button">
                              {{ __('SIGN IN') }}
                            </x-form.button>
                          </div>
                          <!-- /.col -->
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
                <div class="tab-pane" id="register" role="tabpanel">
                  <div>
                    <div class="content-top-agile pb-0 pt-20">
                      <h2 class="text-primary">Get started with Us</h2>
                      <p class="mb-0">Create an account</p>
                    </div>
                    <div class="p-40">
                      <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="form-group">
                          <div class="input-group mb-15">
                            <span class="input-group-text bg-transparent"><i class="ti-user"></i></span>
                            <x-form.input id="first_name" class="ps-15 bg-transparent" type="text" name="first_name"
                              :value="old('first_name')" placeholder="Enter your first name" required autofocus />
                          </div>
                        </div>
                        <div class="form-group">
                          <div class="input-group mb-15">
                            <span class="input-group-text bg-transparent"><i class="ti-user"></i></span>
                            <x-form.input id="last_name" class="ps-15 bg-transparent" type="text" name="last_name"
                              :value="old('last_name')" placeholder="Enter your last name" required autofocus />
                          </div>
                        </div>
                        <div class="form-group">
                          <div class="input-group mb-15">
                            <span class="input-group-text bg-transparent"><i class="ti-email"></i></span>
                            <x-form.input id="email" class="ps-15 bg-transparent" type="email" name="email"
                              :value="old('email')" placeholder="Email" required autofocus />
                          </div>
                        </div>
                        <div class="form-group">
                          <div class="input-group mb-15">
                            <span class="input-group-text bg-transparent"><i class="ti-lock"></i></span>
                            <x-form.input id="password" class="ps-15 bg-transparent" type="password" name="password"
                              placeholder="Password" required autofocus />
                          </div>
                        </div>
                        <div class="form-group">
                          <div class="input-group mb-15">
                            <span class="input-group-text bg-transparent"><i class="ti-lock"></i></span>
                            <x-form.input id="password_confirmation" class=" ps-15 bg-transparent" type="password"
                              name="password_confirmation" placeholder="Confirm password" required />
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-12">
                            <div class="checkbox ms-5">
                              <input type="checkbox" id="basic_checkbox_22" name="agreement" required>
                              <label for="basic_checkbox_22" class="form-label remember">{{ __('I agree to the ') }}<a
                                  target="_blank" href="{{ route('rules') }}"
                                  class="text-warning"><b>{{ __('Terms') }}</b></a>
                              </label>
                            </div>
                          </div>
                          <!-- /.col -->
                          <div class="col-12 text-center">
                            <x-form.button class="btn-info w-p100 mt-15">
                              {{ __('REGISTER') }} </x-form.button>
                          </div>
                          <!-- /.col -->
                        </div>
                      </form>
                      <div class="text-center">
                        <p class="mt-15 mb-0">{{ __('Already registered?') }}<a href="{{ route('login') }}#login"
                            class="text-danger ms-5">
                            {{ __('Login') }}</a>
                        </p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </x-auth-card>

</x-guest-layout>
