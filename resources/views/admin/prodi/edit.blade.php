<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Program Studi
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <form action="{{ route('admin.prodi.update', $prodi->idProdi) }}" method="POST">
                @csrf
                @method('PUT')
                <div>
                    <x-input-label for="nama_prodi" :value="__('Nama Program Studi')" />
                    <x-text-input id="nama_prodi" name="nama_prodi" type="text" class="mt-1 block w-full" value="{{ old('nama_prodi', $prodi->nama_prodi) }}" required />
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
</x-app-layout>
