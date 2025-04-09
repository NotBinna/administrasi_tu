<x-app-layout>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <h2 class="text-2xl font-semibold text-gray-900 dark:text-gray-100 mb-4 ms-4">Edit Pengguna</h2>
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 ">
                    <form method="POST" action="{{ route('tu.users.update', $user->idUser) }}" class="">
                        @csrf
                        @method('PUT')

                        <!-- Id User -->
                        <div>
                            <x-input-label for="idUser" :value="__('Id User')" />
                            <input id="idUser" class="block mt-1 w-full border border-gray-700  rounded-md shadow-sm focus:ring focus:ring-indigo-500 focus:border-indigo-500" type="text" name="idUser" value="{{ $user->idUser }}" required readonly />
                            <x-input-error :messages="$errors->get('idUser')" class="mt-2" />
                        </div>

                        <!-- Name -->
                        <div class="mt-4">
                            <x-input-label for="name" :value="__('Name')" />
                            <input id="name" class="block mt-1 w-full border border-gray-700  rounded-md shadow-sm focus:ring focus:ring-indigo-500 focus:border-indigo-500" type="text" name="name" value="{{ $user->name }}" required />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <!-- Alamat -->
                        <div class="mt-4">
                            <x-input-label for="alamat" :value="__('Alamat')" />
                            <input id="alamat" class="block mt-1 w-full border border-gray-700  rounded-md shadow-sm focus:ring focus:ring-indigo-500 focus:border-indigo-500" type="text" name="alamat" value="{{ $user->alamat }}" required />
                            <x-input-error :messages="$errors->get('alamat')" class="mt-2" />
                        </div>

                        <!-- Email -->
                        <div class="mt-4">
                            <x-input-label for="email" :value="__('Email')" />
                            <input id="email" class="block mt-1 w-full border border-gray-700  rounded-md shadow-sm focus:ring focus:ring-indigo-500 focus:border-indigo-500" type="email" name="email" value="{{ $user->email }}" required />
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        <!-- Program Studi -->
                        <div class="mt-4">
                            <x-input-label for="prodi_idProdi" :value="__('Program Studi')" />

                            <select id="prodi_idProdi" name="prodi_idProdi" required class="block mt-1 w-full border border-gray-700  rounded-md shadow-sm focus:ring focus:ring-indigo-500 focus:border-indigo-500">
                                <option value="" disabled selected>Pilih Program Studi</option>
                                @foreach($prodis as $id => $prodi)
                                    <option value="{{ $id }}" {{ $user->prodi_idProdi == $id ? 'selected' : '' }}>{{ $prodi }}</option>
                                @endforeach
                            </select>

                            <x-input-error :messages="$errors->get('prodi_idProdi')" class="mt-2" />
                        </div>

                        <!-- Role -->
                        <div class="mt-4">
                            <x-input-label for="role_idRole" :value="__('Role')" />
                            <select id="role_idRole" name="role_idRole" class="block mt-1 w-full border border-gray-700  rounded-md shadow-sm focus:ring focus:ring-indigo-500 focus:border-indigo-500">
                                @foreach($roles as $id => $roleName)
                                    <option value="{{ $id }}" {{ $user->role_idRole == $id ? 'selected' : '' }}>{{ $roleName }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('role_idRole')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-between mt-4">
                            <a class="btn btn-primary" href="{{ route('tu.users.index') }}" role="button">
                                &lt; {{ __('Back') }}
                            </a>
                            <button class="btn btn-primary" type="submit">
                                {{ __('Update') }}
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>


</x-app-layout>
