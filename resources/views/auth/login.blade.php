<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

{{--    <form method="POST" action="{{ route('login') }}">--}}
{{--        @csrf--}}

{{--        <!-- idUser -->--}}
{{--        <div>--}}
{{--            <x-input-label for="idUser" :value="__('Id')" />--}}
{{--            <x-text-input id="idUser" class="block mt-1 w-full" type="text" name="idUser" :value="old('idUser')" required autofocus autocomplete="idUser" />--}}
{{--            <x-input-error :messages="$errors->get('idUser')" class="mt-2" />--}}
{{--        </div>--}}

{{--        <!-- Password -->--}}
{{--        <div class="mt-4">--}}
{{--            <x-input-label for="password" :value="__('Password')" />--}}

{{--            <x-text-input id="password" class="block mt-1 w-full"--}}
{{--                            type="password"--}}
{{--                            name="password"--}}
{{--                            required autocomplete="current-password" />--}}

{{--            <x-input-error :messages="$errors->get('password')" class="mt-2" />--}}
{{--        </div>--}}

{{--        <!-- Remember Me -->--}}
{{--        <div class="block mt-4">--}}
{{--            <label for="remember_me" class="inline-flex items-center">--}}
{{--                <input id="remember_me" type="checkbox" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800" name="remember">--}}
{{--                <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>--}}
{{--            </label>--}}
{{--        </div>--}}

{{--        <div class="flex items-center justify-end mt-4">--}}
{{--            @if (Route::has('password.request'))--}}
{{--                <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('password.request') }}">--}}
{{--                    {{ __('Forgot your password?') }}--}}
{{--                </a>--}}
{{--            @endif--}}

{{--            <x-primary-button class="ms-3">--}}
{{--                {{ __('Log in') }}--}}
{{--            </x-primary-button>--}}
{{--        </div>--}}
{{--    </form>--}}


    <div class="auth-main">
        <div class="auth-wrapper v3">
            <div class="auth-form">
                <div class="auth-header">
                    <a href="#"><img src="images/logo-dark.svg" alt="img"></a>
                </div>
                <div class="card my-auto">
                    <div class="card-body">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="d-flex justify-content-between align-items-end mb-4">
                                <h3 class="mb-0"><b>Login</b></h3>
                                <a href="{{ route('register') }}" class="link-primary">Don't have an account?</a>
                            </div>

                            {{-- IdUser --}}
                            <div class="form-group mb-3">
                                <x-input-label for="idUser" :value="__('Id User')" />
                                <x-text-input id="idUser" class="form-control" type="text" name="idUser" :value="old('idUser')"  placeholder="Id User" required autofocus autocomplete="idUser" />
                                <x-input-error :messages="$errors->get('idUser')" class="mt-2" />
                            </div>
                            {{--Password--}}
                            <div class="form-group mb-3">
                                <x-input-label class="form-label" for="password" :value="__('Password')" />

                                <x-text-input id="password" class="form-control"
                                              type="password"
                                              name="password"
                                              required autocomplete="current-password"
                                              placeholder="Password"/>

                                <x-input-error :messages="$errors->get('password')" class="mt-2" />
                            </div>
                            {{--Remember Me--}}
                            <div class="d-flex mt-1 justify-content-between">
{{--                                <label for="remember_me" class="inline-flex items-center">--}}
{{--                                    <input id="remember_me" type="checkbox" class="form-check-input input-primary" name="remember">--}}
{{--                                    <span class="form-check-label text-muted">{{ __('Remember me') }}</span>--}}
{{--                                </label>--}}
                                @if (Route::has('password.request'))
                                    <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('password.request') }}">
                                        {{ __('Forgot your password?') }}
                                    </a>
                                @endif
                            </div>
                            {{--Login Button--}}
                            <div class="d-grid mt-4">
                                <x-primary-button class="btn btn-primary">
                                    {{ __('Log in') }}
                                </x-primary-button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
