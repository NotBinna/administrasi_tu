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
                    <th scope="col" class="px-6 py-3">Action</th>
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
                            <form action="{{ route('kaprodi.surat.updateStatus', $surat->idSurat) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="status" value="Disetujui">
                                <button type="submit" class="btn btn-success"
                                        @if(in_array($surat->status_surat, ['Disetujui', 'Selesai'])) disabled @endif>
                                    Terima
                                </button>
                            </form>
                            <button type="button" @if(in_array($surat->status_surat, ['Ditolak', 'Selesai'])) disabled @endif class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#tolakModal-{{ $surat->idSurat }}">
                                Tolak
                            </button>

                            <div class="modal fade" id="tolakModal-{{ $surat->idSurat }}" tabindex="-1" aria-labelledby="tolakModalLabel-{{ $surat->idSurat }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <form method="POST" action="{{ route('kaprodi.surat.updateStatus', $surat->idSurat) }}">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="tolakModalLabel-{{ $surat->idSurat }}">Alasan Penolakan</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body">
                                                <input type="hidden" name="status" value="Ditolak">
                                                <div class="mb-3">
                                                    <label for="detail_surat_{{ $surat->idSurat }}">Alasan Penolakan</label>
                                                    <textarea class="form-control" name="detail_surat" id="detail_surat_{{ $surat->idSurat }}" required></textarea>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-danger">Tolak Surat</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
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
                    <th scope="col" class="px-6 py-3">Action</th>
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
                            <form action="{{ route('kaprodi.surat.updateStatus', $surat->idSurat) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="status" value="Disetujui">
                                <button type="submit" class="btn btn-success"
                                        @if(in_array($surat->status_surat, ['Disetujui', 'Selesai'])) disabled @endif>
                                    Terima
                                </button>
                            </form>
                            <button type="button" @if(in_array($surat->status_surat, ['Ditolak', 'Selesai'])) disabled @endif class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#tolakModal-{{ $surat->idSurat }}">
                                Tolak
                            </button>

                            <div class="modal fade" id="tolakModal-{{ $surat->idSurat }}" tabindex="-1" aria-labelledby="tolakModalLabel-{{ $surat->idSurat }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <form method="POST" action="{{ route('kaprodi.surat.updateStatus', $surat->idSurat) }}">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="tolakModalLabel-{{ $surat->idSurat }}">Alasan Penolakan</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body">
                                                <input type="hidden" name="status" value="Ditolak">
                                                <div class="mb-3">
                                                    <label for="detail_surat_{{ $surat->idSurat }}">Alasan Penolakan</label>
                                                    <textarea class="form-control" name="detail_surat" id="detail_surat_{{ $surat->idSurat }}" required></textarea>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-danger">Tolak Surat</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
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
                    <th scope="col" class="px-6 py-3">Action</th>
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
                            <form action="{{ route('kaprodi.surat.updateStatus', $surat->idSurat) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="status" value="Disetujui">
                                <button type="submit" class="btn btn-success"
                                        @if(in_array($surat->status_surat, ['Disetujui', 'Selesai'])) disabled @endif>
                                    Terima
                                </button>
                            </form>
                            <button type="button" @if(in_array($surat->status_surat, ['Ditolak', 'Selesai'])) disabled @endif class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#tolakModal-{{ $surat->idSurat }}">
                                Tolak
                            </button>

                            <div class="modal fade" id="tolakModal-{{ $surat->idSurat }}" tabindex="-1" aria-labelledby="tolakModalLabel-{{ $surat->idSurat }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <form method="POST" action="{{ route('kaprodi.surat.updateStatus', $surat->idSurat) }}">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="tolakModalLabel-{{ $surat->idSurat }}">Alasan Penolakan</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body">
                                                <input type="hidden" name="status" value="Ditolak">
                                                <div class="mb-3">
                                                    <label for="detail_surat_{{ $surat->idSurat }}">Alasan Penolakan</label>
                                                    <textarea class="form-control" name="detail_surat" id="detail_surat_{{ $surat->idSurat }}" required></textarea>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-danger">Tolak Surat</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

                <h4>Surat Laporan Hasil Studi</h4>
            <table id="tabel-surat" class="table mb-5">
                <thead>
                <tr class="bg-gray-400">
                    <th scope="col" class="px-6 py-3">ID</th>
                    <th scope="col" class="px-6 py-3">NRP</th>
                    <th scope="col" class="px-6 py-3">Nama</th>
                    <th scope="col" class="px-6 py-3">Keperluan</th>
                    <th scope="col" class="px-6 py-3">Status</th>
                    <th scope="col" class="px-6 py-3">Action</th>
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
                            <form action="{{ route('kaprodi.surat.updateStatus', $surat->idSurat) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="status" value="Disetujui">
                                <button type="submit" class="btn btn-success"
                                        @if(in_array($surat->status_surat, ['Disetujui', 'Selesai'])) disabled @endif>
                                    Terima
                                </button>
                            </form>
                            <button type="button" @if(in_array($surat->status_surat, ['Ditolak', 'Selesai'])) disabled @endif class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#tolakModal-{{ $surat->idSurat }}">
                                Tolak
                            </button>

                            <div class="modal fade" id="tolakModal-{{ $surat->idSurat }}" tabindex="-1" aria-labelledby="tolakModalLabel-{{ $surat->idSurat }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <form method="POST" action="{{ route('kaprodi.surat.updateStatus', $surat->idSurat) }}">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="tolakModalLabel-{{ $surat->idSurat }}">Alasan Penolakan</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body">
                                                <input type="hidden" name="status" value="Ditolak">
                                                <div class="mb-3">
                                                    <label for="detail_surat_{{ $surat->idSurat }}">Alasan Penolakan</label>
                                                    <textarea class="form-control" name="detail_surat" id="detail_surat_{{ $surat->idSurat }}" required></textarea>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-danger">Tolak Surat</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

    </div>
</x-app-layout>
