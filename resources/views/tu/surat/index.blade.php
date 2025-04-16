<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Daftar Surat') }}
        </h2>
    </x-slot>
    <div class="container text-white mt-4">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
            <table class="table mb-5">
                <h4>Surat Keterangan Mahasiswa Aktif</h4>
                <thead>
                <tr class="bg-gray-400">
                    <th scope="col" class="px-6 py-3">ID</th>
                    <th scope="col" class="px-6 py-3">NRP</th>
                    <th scope="col" class="px-6 py-3">Nama</th>
                    <th scope="col" class="px-6 py-3">Alamat</th>
                    <th scope="col" class="px-6 py-3">Semester</th>
                    <th scope="col" class="px-6 py-3">Keperluan</th>
                    <th scope="col" class="px-6 py-3">Status</th>
                    <th scope="col" class="px-6 py-3">File</th>
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
                        <td>
                            @if ($surat->status_surat == 'Diajukan')
                                <i class="fas fa-circle text-warning f-10 me-1"></i>
                            @elseif ($surat->status_surat == 'Ditolak')
                                <i class="fas fa-circle text-danger f-10 me-1"></i>
                            @elseif ($surat->status_surat == 'Disetujui')
                                <i class="fas fa-circle text-success f-10 me-1"></i>
                            @elseif ($surat->status_surat == 'Selesai')
                                <i class="fas fa-circle text-primary f-10 me-1"></i>
                            @endif
                            {{ $surat->status_surat }}
                        </td>
                        <td>
                            @if ($surat->file_surat)
                                <strong>Nama File:</strong> {{ basename($surat->file_surat) }}
                            @endif
                            @if (!$surat->file_surat)
                                <form action="{{ route('tu.surat.upload', $surat->idSurat) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="input-group mb-3">
                                        <input type="file" class="form-control" name="file_surat" id="file_surat" accept="application/pdf" required>
                                        <button type="submit" class="input-group-text" for="file_surat">
                                            {{ __('Upload') }}
                                        </button>
                                    </div>
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>


            <table class="table mb-5">
                <h4>Surat Pengantar Tugas Mata Kuliah</h4>
                <thead>
                <tr class="bg-gray-400">
                    <th scope="col" class="px-6 py-3">ID</th>
                    <th scope="col" class="px-6 py-3">NRP</th>
                    <th scope="col" class="px-6 py-3">Nama</th>
                    <th scope="col" class="px-6 py-3">Kode MK</th>
                    <th scope="col" class="px-6 py-3">Nama MK</th>
                    <th scope="col" class="px-6 py-3">Tujuan</th>
                    <th scope="col" class="px-6 py-3">Topik</th>
                    <th scope="col" class="px-6 py-3">Status</th>
                    <th scope="col" class="px-6 py-3">File</th>
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
                        <td>
                            @if ($surat->status_surat == 'Diajukan')
                                <i class="fas fa-circle text-warning f-10 me-1"></i>
                            @elseif ($surat->status_surat == 'Ditolak')
                                <i class="fas fa-circle text-danger f-10 me-1"></i>
                            @elseif ($surat->status_surat == 'Disetujui')
                                <i class="fas fa-circle text-success f-10 me-1"></i>
                            @elseif ($surat->status_surat == 'Selesai')
                                <i class="fas fa-circle text-primary f-10 me-1"></i>
                            @endif
                            {{ $surat->status_surat }}
                        </td>
                        <td>
                            @if ($surat->file_surat)
                                <strong>Nama File:</strong> {{ basename($surat->file_surat) }}
                            @endif
                            @if (!$surat->file_surat)
                                <form action="{{ route('tu.surat.upload', $surat->idSurat) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="input-group mb-3">
                                        <input type="file" class="form-control" name="file_surat" id="file_surat" accept="application/pdf" required>
                                        <button type="submit" class="input-group-text" for="file_surat">
                                            {{ __('Upload') }}
                                        </button>
                                    </div>
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            <table class="table mb-5">
                <h4>Surat Keterangan Lulus</h4>
                <thead>
                <tr class="bg-gray-400">
                    <th scope="col" class="px-6 py-3">ID</th>
                    <th scope="col" class="px-6 py-3">NRP</th>
                    <th scope="col" class="px-6 py-3">Nama</th>
                    <th scope="col" class="px-6 py-3">Status</th>
                    <th scope="col" class="px-6 py-3">File</th>
                </tr>
                </thead>
                <tbody>
                @foreach($lulus as $surat)
                    <tr>
                        <td>{{ $surat->idSurat }}</td>
                        <td>{{ $surat->mahasiswa?->idUser }}</td>
                        <td>{{ $surat->mahasiswa?->name }}</td>
                        <td>
                            @if ($surat->status_surat == 'Diajukan')
                                <i class="fas fa-circle text-warning f-10 me-1"></i>
                            @elseif ($surat->status_surat == 'Ditolak')
                                <i class="fas fa-circle text-danger f-10 me-1"></i>
                            @elseif ($surat->status_surat == 'Disetujui')
                                <i class="fas fa-circle text-success f-10 me-1"></i>
                            @elseif ($surat->status_surat == 'Selesai')
                                <i class="fas fa-circle text-primary f-10 me-1"></i>
                            @endif
                            {{ $surat->status_surat }}
                        </td>
                        <td>
                            @if ($surat->file_surat)
                                <strong>Nama File:</strong> {{ basename($surat->file_surat) }}
                            @endif
                            @if (!$surat->file_surat)
                                <form action="{{ route('tu.surat.upload', $surat->idSurat) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="input-group mb-3">
                                        <input type="file" class="form-control" name="file_surat" id="file_surat" accept="application/pdf" required>
                                        <button type="submit" class="input-group-text" for="file_surat">
                                            {{ __('Upload') }}
                                        </button>
                                    </div>
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            <table class="table mb-5">
                <h4>Surat Laporan Hasil Studi</h4>
                <thead>
                <tr class="bg-gray-400">
                    <th scope="col" class="px-6 py-3">ID</th>
                    <th scope="col" class="px-6 py-3">NRP</th>
                    <th scope="col" class="px-6 py-3">Nama</th>
                    <th scope="col" class="px-6 py-3">Keperluan</th>
                    <th scope="col" class="px-6 py-3">Status</th>
                    <th scope="col" class="px-6 py-3">File</th>
                </tr>
                </thead>
                <tbody>
                @foreach($laporan as $surat)
                    <tr>
                        <td>{{ $surat->idSurat }}</td>
                        <td>{{ $surat->mahasiswa?->idUser }}</td>
                        <td>{{ $surat->mahasiswa?->name }}</td>
                        <td>{{ $surat->tujuan }}</td>
                        <td>
                            @if ($surat->status_surat == 'Diajukan')
                                <i class="fas fa-circle text-warning f-10 me-1"></i>
                            @elseif ($surat->status_surat == 'Ditolak')
                                <i class="fas fa-circle text-danger f-10 me-1"></i>
                            @elseif ($surat->status_surat == 'Disetujui')
                                <i class="fas fa-circle text-success f-10 me-1"></i>
                            @elseif ($surat->status_surat == 'Selesai')
                                <i class="fas fa-circle text-primary f-10 me-1"></i>
                            @endif
                            {{ $surat->status_surat }}
                        </td>
                        <td>
                            @if ($surat->file_surat)
                                <strong>Nama File:</strong> {{ basename($surat->file_surat) }}
                            @endif
                            @if (!$surat->file_surat)
                                <form action="{{ route('tu.surat.upload', $surat->idSurat) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="input-group mb-3">
                                        <input type="file" class="form-control" name="file_surat" id="file_surat" accept="application/pdf" required>
                                        <button type="submit" class="input-group-text" for="file_surat">
                                            {{ __('Upload') }}
                                        </button>
                                    </div>
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

    </div>
</x-app-layout>
