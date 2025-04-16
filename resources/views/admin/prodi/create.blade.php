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

                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div>
                            <x-input-label for="idProdi" :value="__('ID Prodi')" />
                            <input id="idProdi" name="idProdi" type="text" class="block mt-1 w-full border border-gray-700 rounded-md shadow-sm focus:ring focus:ring-indigo-500 focus:border-indigo-500" :value="old('idProdi')" required />
                            <x-input-error class="mt-2" :messages="$errors->get('idProdi')" />
                        </div>

                        <div>
                            <x-input-label for="nama_prodi" :value="__('Nama Program Studi')" />
                            <input id="nama_prodi" name="nama_prodi" type="text" class="block mt-1 w-full border border-gray-700 rounded-md shadow-sm focus:ring focus:ring-indigo-500 focus:border-indigo-500" :value="old('nama_prodi')" required />
                            <x-input-error :messages="$errors->get('nama_prodi')" class="mt-2" />
                        </div>
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
