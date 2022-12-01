<x-guest-layout>
  <!---page Title --->
    <x-auth-card :banner="asset('front-end/images/front-end-img/background/bg-8.jpg')" title="Email Verification">
    <section class="py-50">
        <div class="container">
            <div class="row justify-content-center">
            <div class="col-lg-6 col-12">
                <div class="box box-body mb-0">
                <form method="POST" action="{{ route('password.update') }}">
                        @csrf
                          <!-- Password Reset Token -->
                        <input type="hidden" name="token" value="{{ $request->route('token') }}">

                        <!-- Session Status -->
                        <x-auth-session-status class="mb-4 session-status" :status="session('status')" />

                        <!-- Validation Errors -->
                        <x-auth-validation-errors class="mb-4 validation-errors" :errors="$errors" />

                        <!-- Username -->
                        <div class="form-group">
                            <label style="color:black;font-size:normal" for="">Email Address</label>
                            <div class="input-group mb-15">
                                <x-form.input id="email" class="ps-15 bg-transparent" type="email" name="email"
                                :value="old('email', $request->email)" placeholder="Email" required autofocus />
                            </div>
                        </div>
                       
                        <!-- Password -->
                        <div class="form-group">
                            <label style="color:black;font-size:normal;" for="">Password</label>
                            <div class="input-group mb-15">
                                <x-form.input id="password" class="block mt-1 w-full" type="password" name="password" required />
                            </div>
                        </div>
                        <div class="form-group">
                            <label style="color:black;font-size:normal;" for="">Confirm Password</label>
                            <div class="input-group mb-15">
                                <x-form.input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required />
                            </div>
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <div class="col-12 text-center">
                                <x-form.button class="btn-info w-p100 mt-15 submit-button">
                                {{ __('Reset Password') }}
                                </x-form.button>
                            </div>
                        
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    </x-auth-card>

</x-guest-layout>
