<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah User') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 ">
                    <form method="POST" action="{{ route('admin.users.store') }}">
                        @csrf

                        <!-- ID User -->
                        <div>
                            <x-input-label for="idUser" :value="__('ID User')" />
                            <input id="idUser" class="block mt-1 w-full border border-gray-700 rounded-md shadow-sm focus:ring focus:ring-indigo-500 focus:border-indigo-500" type="text" name="idUser" required />
                            <x-input-error :messages="$errors->get('idUser')" class="mt-2" />
                        </div>

                        <!-- Name -->
                        <div class="mt-4">
                            <x-input-label for="name" :value="__('Name')" />
                            <input id="name" class="block mt-1 w-full border border-gray-700 rounded-md shadow-sm focus:ring focus:ring-indigo-500 focus:border-indigo-500" type="text" name="name" required />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <!-- Alamat -->
                        <div class="mt-4">
                            <x-input-label for="alamat" :value="__('Alamat')" />
                            <input id="alamat" class="block mt-1 w-full border border-gray-700 rounded-md shadow-sm focus:ring focus:ring-indigo-500 focus:border-indigo-500" type="text" name="alamat" required />
                            <x-input-error :messages="$errors->get('alamat')" class="mt-2" />
                        </div>

                        <!-- Email -->
                        <div class="mt-4">
                            <x-input-label for="email" :value="__('Email')" />
                            <input id="email" class="block mt-1 w-full border border-gray-700 rounded-md shadow-sm focus:ring focus:ring-indigo-500 focus:border-indigo-500" type="email" name="email" required />
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        <!-- Password -->
                        <div class="mt-4">
                            <x-input-label for="password" :value="__('Password')" />
                            <input id="password" class="block mt-1 w-full border border-gray-700 rounded-md shadow-sm focus:ring focus:ring-indigo-500 focus:border-indigo-500" type="password" name="password" required />
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>

                        <!-- Confirm Password -->
                        <div class="mt-4">
                            <x-input-label for="password_confirmation" :value="__('Konfirmasi Password')" />
                            <input id="password_confirmation" class="block mt-1 w-full border border-gray-700 rounded-md shadow-sm focus:ring focus:ring-indigo-500 focus:border-indigo-500" type="password" name="password_confirmation" required />
                            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                        </div>

                        <!-- Program Studi -->
                        <div class="mt-4">
                            <x-input-label for="prodi_idProdi" :value="__('Program Studi')" />
                            <select name="prodi_idProdi" class="form-control">
                                <option disabled selected value="">Pilih Program Studi</option>
                                @foreach ($prodis as $prodi)
                                    <option value="{{ $prodi->idProdi }}">{{ $prodi->nama_prodi }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('prodi_idProdi')" class="mt-2" />
                        </div>

                        <!-- Role -->
                        <div class="mt-4">
                            <x-input-label for="role_idRole" :value="__('Role')" />
                            <select name="role_idRole" class="form-control">
                                <option disabled value="">Pilih Role</option>
                                @foreach ($roles as $role)
                                    <option value="{{ $role->idRole }}">{{ $role->role_name }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('role_idRole')" class="mt-2" />
                        </div>

                        <!-- Button Section -->
                        <div class="flex items-center justify-between mt-4">
                            <a href="{{ route('admin.users.index') }}" class="btn btn-primary" role="button">
                                &lt; {{ __('Back') }}
                            </a>
                            <button class="btn btn-primary" type="submit">
                                {{ __('Tambah User') }}
                            </button>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>

</x-app-layout>
