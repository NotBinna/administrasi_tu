<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Daftar Surat') }}
        </h2>
    </x-slot>
    <div class="container text-white">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
            <table class="table">
                <h4>Surat Keterangan Mahasiswa Aktif</h4>
                <thead>
                <tr>
                    <th scope="col" class="px-6 py-3">ID</th>
                    <th scope="col" class="px-6 py-3">NRP</th>
                    <th scope="col" class="px-6 py-3">Nama</th>
                    <th scope="col" class="px-6 py-3">Alamat</th>
                    <th scope="col" class="px-6 py-3">Semester</th>
                    <th scope="col" class="px-6 py-3">Keperluan</th>
                    <th scope="col" class="px-6 py-3">Status</th>
                    <th scope="col" class="px-6 py-3">Aksi</th>
                </tr>
                </thead>
                <tbody>
                @foreach($aktif as $surat)
                    <tr>
                        <td>{{ $surat->idSurat }}</td>
                        <td>{{ $surat->mahasiswa?->idUser }}</td>
                        <td>{{ $surat->mahasiswa?->name }}</td>
                        <td>{{ $surat->mahasiswa?->alamat }}</td>
                        <td>{{ $surat->semester }}</td>
                        <td>{{ $surat->tujuan }}</td>
                        <td>{{ $surat->status_surat }}</td>
                        <td>
                            <form action="{{ route('kaprodi.surat.updateStatus', $surat->idSurat) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="status" value="Disetujui">
                                <button type="submit" class="btn btn-success">Terima</button>
                            </form>
                            <form action="{{ route('kaprodi.surat.updateStatus', $surat->idSurat) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="status" value="Ditolak">
                                <button type="submit" class="btn btn-danger">Tolak</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>


            <table class="table">
                <h4>Surat Pengantar Tugas Mata Kuliah</h4>
                <thead>
                <tr>
                    <th scope="col" class="px-6 py-3">ID</th>
                    <th scope="col" class="px-6 py-3">NRP</th>
                    <th scope="col" class="px-6 py-3">Nama</th>
                    <th scope="col" class="px-6 py-3">Kode MK</th>
                    <th scope="col" class="px-6 py-3">Nama MK</th>
                    <th scope="col" class="px-6 py-3">Tujuan</th>
                    <th scope="col" class="px-6 py-3">Topik</th>
                    <th scope="col" class="px-6 py-3">Aksi</th>
                </tr>
                </thead>
                <tbody>
                @foreach($pengantar as $surat)
                    <tr>
                        <td>{{ $surat->idSurat }}</td>
                        <td>{{ $surat->mahasiswa?->idUser }}</td>
                        <td>{{ $surat->mahasiswa?->name }}</td>
                        <td>{{ $surat->kode_mk }}</td>
                        <td>{{ $surat->nama_mk }}</td>
                        <td>{{ $surat->tujuan }}</td>
                        <td>{{ $surat->topik }}</td>
                        <td>{{ $surat->status_surat }}</td>
                        <td>
                            <form action="{{ route('kaprodi.surat.updateStatus', $surat->idSurat) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="status" value="Disetujui">
                                <button type="submit" class="btn btn-success">Terima</button>
                            </form>
                            <form action="{{ route('kaprodi.surat.updateStatus', $surat->idSurat) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="status" value="Ditolak">
                                <button type="submit" class="btn btn-danger">Tolak</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>



    </div>
</x-app-layout>
