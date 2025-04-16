<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Tambah Program Studi
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form action="{{ route('admin.prodi.store') }}" method="POST">
                    @csrf

                    <div class="mb-4">
                        <x-input-label for="idProdi" :value="__('ID Prodi')" />
                        <x-text-input id="idProdi" name="idProdi" type="text" class="mt-1 block w-full" :value="old('idProdi')" required />
                        <x-input-error class="mt-2" :messages="$errors->get('idProdi')" />
                    </div>

                    <div class="mb-4">
                        <x-input-label for="nama_prodi" :value="__('Nama Program Studi')" />
                        <x-text-input id="nama_prodi" name="nama_prodi" type="text" class="mt-1 block w-full" :value="old('nama_prodi')" required />
                        <x-input-error :messages="$errors->get('nama_prodi')" class="mt-2" />
                    </div>

                    <div class="flex items-center justify-between mt-4">
                        <a class="btn btn-primary" href="{{ route('admin.prodi.index') }}" role="button">
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
</x-app-layout>
