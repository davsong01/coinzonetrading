<x-guest-layout>
  <!---page Title --->
  <x-auth-card :banner="asset('front-end/images/front-end-img/background/bg-8.jpg')" title="Email Verification">

    <!--Page content -->
    <section class="py-50">
      <div class="container">
        <div class="row justify-content-center g-0">
          <div class="col-lg-5 col-md-5 col-12">
            <div class="box box-body">
              <div class="content-top-agile pb-0 pt-20">
                <h2 class="text-primary">{{ __('Verify your email') }}</h2>
              </div>
              <div class="p-40">
                <p class="mb-0">
                  {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
                </p>

                <form method="POST" action="{{ route('password.confirm') }}">
                  @csrf
                  <!-- Session Status -->
                  <x-auth-session-status class="mb-4" :status="session('status')" />

                  <!-- Validation Errors -->
                  <x-auth-validation-errors class="mb-4" :errors="$errors" />
                  <div class="form-group">
                    <div class="input-group mb-15">
                      <span class="input-group-text bg-transparent"><i class="ti-lock"></i></span>
                      <x-form.input id="password" class=" ps-15 bg-transparent" type="password" name="password"
                        autocomplete="current-password" placeholder="Confirm password" required />
                    </div>
                  </div>
                  <div class="col-12 text-center">
                    <x-form.button class="btn-info w-p100 mt-15"> {{ __('Confirm') }}
                    </x-form.button>
                  </div>
                </form>

              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

  </x-auth-card>

</x-guest-layout>
