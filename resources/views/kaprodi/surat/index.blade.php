<x-app-layout>
    <div class="container text-white">
        <h1>Daftar Surat</h1>
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <table class="table">
            <thead>
            <tr>
                <th scope="col" class="px-6 py-3">ID</th>
                <th scope="col" class="px-6 py-3">Jenis Surat</th>
                <th scope="col" class="px-6 py-3">Status</th>
                <th scope="col" class="px-6 py-3">Aksi</th>
            </tr>
            </thead>
            <tbody>
            @foreach($surats as $surat)
                <tr>
                    <td>{{ $surat->idSurat }}</td>
                    <td>{{ $surat->jenis_surat }}</td>
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
