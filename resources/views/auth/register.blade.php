<x-guest-layout>
    <div class="auth-main">
        <div class="auth-wrapper v3">
            <div class="auth-form">
                <div class="auth-header">
                    <a href="#"><img src="images/logo-dark.svg" alt="img"></a>
                </div>
                <div class="card my-auto">
                    <div class="card-body">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf
                            <div class="d-flex justify-content-between align-items-end mb-4">
                                <h3 class="mb-0"><b>Register</b></h3>
                                <a href="{{ route('login') }}" class="link-primary">{{ __('Already registered?') }}</a>
                            </div>

                            <!-- idUser -->
                            <div class="form-group mb-3">
                                <x-input-label for="idUser" :value="__('Id')" />
                                <x-text-input id="idUser" class="form-control" type="text" name="idUser" :value="old('idUser')" placeholder="NRP/NIP" required autofocus autocomplete="idUser" />
                                <x-input-error :messages="$errors->get('idUser')" class="mt-2" />
                            </div>

                            <!-- Name -->
                            <div class="form-group mb-3">
                                <x-input-label for="name" :value="__('Name')" />
                                <x-text-input id="name" class="form-control" type="text" name="name" :value="old('name')" placeholder="Name" required autocomplete="name" />
                                <x-input-error :messages="$errors->get('name')" class="mt-2" />
                            </div>

                            {{-- Alamat --}}
                            <div class="form-group mb-3">
                                <x-input-label for="alamat" :value="__('Alamat')" />
                                <x-text-input id="alamat" class="form-control" type="text" name="alamat" :value="old('alamat')" placeholder="Alamat" required autocomplete="alamat" />
                                <x-input-error :messages="$errors->get('alamat')" class="mt-2" />
                            </div>

                            <!-- Email Address -->
                            <div class="form-group mb-3">
                                <x-input-label for="email" :value="__('Email')" />
                                <x-text-input id="email" class="form-control" type="email" name="email" :value="old('email')"  placeholder="Email Address" required autocomplete="email" />
                                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                            </div>

                            <!-- Password -->
                            <div class="form-group mb-3">
                                <x-input-label for="password" :value="__('Password')" />

                                <x-text-input id="password" class="form-control"
                                              type="password"
                                              name="password"
                                              required autocomplete="new-password" />

                                <x-input-error :messages="$errors->get('password')" class="mt-2" />
                            </div>

                            <!-- Confirm Password -->
                            <div class="form-group mb-3">
                                <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

                                <x-text-input id="password_confirmation" class="form-control"
                                              type="password"
                                              name="password_confirmation" required autocomplete="new-password" />

                                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                            </div>

                            <!-- Program Studi -->
                            <div class="form-group mb-3">
                                <x-input-label for="prodi_idProdi" :value="__('Program Studi')" />

                                <select id="prodi_idProdi" name="prodi_idProdi" required class="form-control">
                                    <option value="" disabled selected>Pilih Program Studi</option>
                                    <option value="1">Teknik Informatika</option>
                                    <option value="2">Sistem Informasi</option>
                                </select>
                                <x-input-error :messages="$errors->get('prodi_idProdi')" class="mt-2" />
                            </div>

                            {{-- Register Button --}}
                            <p class="mt-4 text-sm text-muted">By Signing up, you agree to our <a href="#" class="text-primary"> Terms of Service </a> and <a href="#" class="text-primary"> Privacy Policy</a></p>
                            <div class="d-grid mt-3">
                                <x-primary-button class="btn btn-primary">
                                    {{ __('Register') }}
                                </x-primary-button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
