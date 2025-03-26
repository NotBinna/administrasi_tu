<x-app-layout>
    <div class="container mx-auto ">
        <div class="max-w-4xl mx-auto p-6 bg-white shadow-md rounded-lg">
            <h2 class="text-2xl font-bold mb-4">Buat Surat</h2>
            <form action="{{ route('surat.store') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label for="jenis_surat" class="block text-sm font-medium text-gray-700">Jenis Surat</label>
                    <select id="jenis_surat" name="jenis_surat" class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm" onchange="toggleForm()">
                        <option value="Aktif">Surat Keterangan Mahasiswa Aktif</option>
                        <option value="Pengantar">Surat Pengantar Tugas Mata Kuliah</option>
                        <option value="Lulus">Surat Keterangan Lulus</option>
                        <option value="Laporan">Surat Laporan Hasil Studi</option>
                    </select>
                </div>

                <div id="form-container"></div>

                <div>
                    <button type="submit" class="w-full bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600">Ajukan Surat</button>
                </div>
            </form>
        </div>

        <script>
            function toggleForm() {
                const jenisSurat = document.getElementById('jenis_surat').value;
                const formContainer = document.getElementById('form-container');
                let formContent = '';

                switch (jenisSurat) {
                    case 'Aktif':
                        formContent = `
                    <div class="grid grid-cols-2 gap-4">
                        <input type="text" name="semester" placeholder="Semester" class="border p-2 rounded-md">
                        <input type="text" name="keperluan" placeholder="Keperluan Pengajuan" class="border p-2 rounded-md">
                    </div>
                `;
                        break;
                    case 'Pengantar':
                        formContent = `
                    <div class="grid grid-cols-2 gap-4">
                        <input type="text" name="kode_mk" placeholder="Kode Mata Kuliah" class="border p-2 rounded-md">
                        <input type="text" name="nama_mk" placeholder="Nama Mata Kuliah" class="border p-2 rounded-md">
                        <input type="text" name="tujuan" placeholder="Tujuan" class="border p-2 rounded-md">
                        <input type="text" name="topik" placeholder="Topik" class="border p-2 rounded-md">
                    </div>
                `;
                        break;
                    case 'Lulus':
                        formContent = `<p class="text-gray-700">Data diambil dari profil mahasiswa.</p>`;
                        break;
                    case 'Laporan':
                        formContent = `
                    <div>
                        <input type="text" name="keperluan" placeholder="Keperluan" class="border p-2 rounded-md w-full">
                    </div>
                `;
                        break;
                }
                formContainer.innerHTML = formContent;
            }

            // Inisialisasi form saat halaman pertama kali dimuat
            document.addEventListener('DOMContentLoaded', toggleForm);
        </script>

    </div>

</x-app-layout>
