<x-app-layout>

    <div class="container-xl p-4">
        <div class="row">
            <div class="col-lg-4 offset-lg-4">
                <div class="card">
                    <div class="card-header text-center">
                        <h5>User Login</h5>
                    </div>
                    <div class="card-body m-3">
                        <form action="{{ route('login') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <x-input-label for="email" :value="__('Email')" />
                                <x-text-input id="email" type="email" name="email" :value="old('email')" placeholder="Enter Email" />
                                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                            </div>
                            <div class="mb-3">
                                <x-input-label for="password" :value="__('Password')" />
                                <x-text-input id="password" type="password" name="password" :value="old('password')" placeholder="Enter Password" />
                                <x-input-error :messages="$errors->get('password')" class="mt-2" />
                            </div>
                            <div class="mb-3 form-check">
                                <x-input-checkbox class="form-check-input" name="remember" id="auth-remember-check" :value="__('Remember Me')" />
                            </div>
                            <div class="mb-3">
                                <a href="#">Forgot Your Password?</a>
                            </div>
                            <div class="d-grid">
                                <x-primary-button>
                                    {{ __('Login') }}
                                </x-primary-button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
