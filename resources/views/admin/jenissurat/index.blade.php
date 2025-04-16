<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Jenis Surat
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <a href="{{ route('admin.prodi.create') }}" class="mt-4 inline-block bg-blue-500 text-white px-4 py-2 rounded">Tambah Program Studi</a>
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg mt-3">
                <table class="table-auto w-full">
                    <thead>
                    <tr>
                        <th class="px-4 py-2">ID</th>
                        <th class="px-4 py-2">Nama Program Studi</th>
                        <th class="px-4 py-2">Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($prodis as $prodi)
                        <tr>
                            <td class="border px-4 py-2">{{ $prodi->idProdi }}</td>
                            <td class="border px-4 py-2">{{ $prodi->nama_prodi }}</td>
                            <td class="border px-4 py-2">
                                <a href="{{ route('admin.prodi.edit', $prodi->idProdi) }}" class="text-blue-500">Edit</a> |
                                <button type="button" class="text-red-500 btn p-0" data-bs-toggle="modal" data-bs-target="#deleteModal-{{ $prodi->idProdi }}">
                                    Hapus
                                </button>

                                <div class="modal fade" id="deleteModal-{{ $prodi->idProdi }}" tabindex="-1" aria-labelledby="deleteModalLabel-{{ $prodi->idProdi }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="deleteModalLabel-{{ $prodi->idProdi }}">Konfirmasi Hapus</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                Apakah Anda yakin ingin menghapus Program Studi <strong>{{ $prodi->nama_prodi }}</strong>?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>

                                                <form action="{{ route('admin.prodi.destroy', $prodi->idProdi) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Hapus</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
