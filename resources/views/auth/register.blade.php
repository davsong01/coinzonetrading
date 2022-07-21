<x-guest-layout>
  <x-auth-card :banner="asset('front-end/images/front-end-img/background/bg-8.jpg')" title="Register">
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <!-- Validation Errors -->
    <x-auth-validation-errors class="mb-4" :errors="$errors" />

    <section class="py-50">
      <div class="container">
        <div class="row justify-content-center g-0">
          <div class="col-lg-5 col-md-5 col-12">
            <div class="box box-body">
              <div class="content-top-agile pb-0 pt-20">
                <h2 class="text-primary">Get started with Us</h2>
                <p class="mb-0">Register a New Membership</p>
              </div>
              <div class="p-40">
                <form method="POST" action="{{ route('register') }}">
                  @csrf
                  <div class="form-group">
                    <div class="input-group mb-15">
                      <span class="input-group-text bg-transparent"><i class="ti-user"></i></span>
                      <x-form.input id="name" class="ps-15 bg-transparent" type="text" name="name"
                        :value="old('name')" placeholder="name" required autofocus />
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
                        <input type="checkbox" id="basic_checkbox_1">
                        <label for="basic_checkbox_1" class="form-label">{{ __('I agree to the ') }}<a href="#"
                            class="text-warning"><b>{{ __('Terms') }}</b></a></label>
                      </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-12 text-center">
                      <x-form.button class="btn-info w-p100 mt-15"> {{ __('REGISTER') }} </x-form.button>

                    </div>
                    <!-- /.col -->
                  </div>
                </form>
                <div class="text-center">
                  <p class="mt-15 mb-0">{{ __('Already registered?') }}<a href="{{ route('login') }}"
                      class="text-danger ms-5"> {{ __('Logn') }}</a></p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

  </x-auth-card>
</x-guest-layout>
