<x-guest-layout>

    <h2 class="text-2xl font-semibold text-gray-900 dark:text-gray-100 mb-4">Edit Pengguna</h2>



    <form method="POST" action="{{ route('admin.users.update', $user->idUser) }}">
        @csrf
        @method('PUT')

        <!-- Id User -->
        <div>
            <x-input-label for="idUser" :value="__('Id User')" />
            <x-text-input id="idUser" class="block mt-1 w-full" type="text" name="idUser" value="{{ $user->idUser }}" required readonly />
            <x-input-error :messages="$errors->get('idUser')" class="mt-2" />
        </div>

        <!-- Name -->
        <div class="mt-4">
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" value="{{ $user->name }}" required />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Alamat -->
        <div class="mt-4">
            <x-input-label for="alamat" :value="__('Alamat')" />
            <x-text-input id="alamat" class="block mt-1 w-full" type="text" name="alamat" value="{{ $user->alamat }}" required />
            <x-input-error :messages="$errors->get('alamat')" class="mt-2" />
        </div>

        <!-- Email -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" value="{{ $user->email }}" required />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Program Studi -->
        <div class="mt-4">
            <x-input-label for="prodi_idProdi" :value="__('Program Studi')" />

            <select id="prodi_idProdi" name="prodi_idProdi" required class="block mt-1 w-full bg-gray-900 border border-gray-700 text-white rounded-md shadow-sm focus:ring focus:ring-indigo-500 focus:border-indigo-500">
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
            <select id="role_idRole" name="role_idRole" class="block mt-1 w-full dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-gray-700 dark:text-gray-300 shadow-sm focus:ring focus:ring-indigo-500 dark:focus:ring-indigo-600">
                @foreach($roles as $id => $roleName)
                    <option value="{{ $id }}" {{ $user->role_idRole == $id ? 'selected' : '' }}>{{ $roleName }}</option>
                @endforeach
            </select>
            <x-input-error :messages="$errors->get('role_idRole')" class="mt-2" />
        </div>

        <div class="flex items-center justify-between mt-4">
            <a href="{{ route('admin.users.index') }}" class="inline-flex items-center px-3 py-1.5 bg-white border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-300 focus:ring-offset-2 transition ease-in-out duration-150">
                &lt; {{ __('Back') }}
            </a>

            <x-primary-button class="ms-3">
                {{ __('Update') }}
            </x-primary-button>
        </div>

    </form>
</x-guest-layout>
