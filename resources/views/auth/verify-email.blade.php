<x-guest-layout>
  <!---page Title --->
  <x-auth-card :banner="asset('front-end/images/front-end-img/background/bg-8.jpg')" title="Email Verification ">

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
                  {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
                </p>
                @if (session('status') == 'verification-link-sent')
                  <div class="mb-4 font-medium text-sm text-green-600">
                    {{ __('A new verification link has been sent to the email address you provided during registration.') }}
                  </div>
                @endif
                <form method="POST" action="{{ route('verification.send') }}">
                  @csrf

                  <div class="col-12 text-center">
                    <x-form.button class="btn-info w-p100 mt-15"> {{ __('Resend Verification Email') }}
                    </x-form.button>
                  </div>
                </form>
                <form method="POST" action="{{ route('logout') }}">
                  @csrf
                    <x-form.button type="submit" class="btn-danger w-p100 mt-15"> {{  __('Log Out') }}
                    </x-form.button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

  </x-auth-card>

</x-guest-layout>
