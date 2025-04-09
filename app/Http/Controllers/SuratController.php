<?php

namespace App\Http\Controllers;

use App\Models\Surat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SuratController extends Controller
{
    // Menampilkan daftar surat
    public function index()
    {
        $user = auth()->user();

        if ($user->role_idRole == 1) {
            $aktif = Surat::with('mahasiswa')->where('jenis_surat', 'Aktif')->where('users_idUser', $user->idUser)->get();
            $pengantar = Surat::with('mahasiswa')->where('jenis_surat', 'Pengantar')->where('users_idUser', $user->idUser)->get();
            $lulus = Surat::with('mahasiswa')->where('jenis_surat', 'Lulus')->where('users_idUser', $user->idUser)->get();
            $laporan = Surat::with('mahasiswa')->where('jenis_surat', 'Laporan')->where('users_idUser', $user->idUser)->get();
            return view('mahasiswa.surat.index', compact('aktif', 'pengantar', 'lulus', 'laporan'));
        } elseif ($user->role_idRole == 3) {
            $aktif = Surat::with('mahasiswa')->where('jenis_surat', 'Aktif')->where('status_surat', 'Disetujui')->get();
            $pengantar = Surat::with('mahasiswa')->where('jenis_surat', 'Pengantar')->where('status_surat', 'Disetujui')->get();
            $lulus = Surat::with('mahasiswa')->where('jenis_surat', 'Lulus')->where('status_surat', 'Disetujui')->get();
            $laporan = Surat::with('mahasiswa')->where('jenis_surat', 'Laporan')->where('status_surat', 'Disetujui')->get();
            return view('tu.surat.index', compact('aktif', 'pengantar', 'lulus', 'laporan'));
        } else {
            $aktif = Surat::with('mahasiswa')->where('jenis_surat', 'Aktif')->get();
            $pengantar = Surat::with('mahasiswa')->where('jenis_surat', 'Pengantar')->get();
            $lulus = Surat::with('mahasiswa')->where('jenis_surat', 'Lulus')->get();
            $laporan = Surat::with('mahasiswa')->where('jenis_surat', 'Laporan')->get();
            return view('kaprodi.surat.index', compact('aktif', 'pengantar', 'lulus', 'laporan'));
        }
    }

    // Menampilkan form pengajuan surat (hanya mahasiswa)

    public function show($id)
    {
        $surat = Surat::findOrFail($id);
        return view('surat.show', compact('surat'));
    }

    public function create()
    {
        if (auth()->user()->role_idRole !== 1) {
            return redirect()->route('surat.index')->with('error', 'Akses ditolak.');
        }
        $jenisSurat = ['Aktif', 'Pengantar', 'Lulus', 'Laporan'];
        return view('surat.create', compact('jenisSurat'));
    }

    // Menyimpan pengajuan surat baru (hanya mahasiswa)
    public function store(Request $request)
    {
        // Validasi umum
        $validatedData = $request->validate([
            'jenis_surat' => 'required|string',
        ]);

        // Buat array data surat
        $dataSurat = [
            'jenis_surat' => $validatedData['jenis_surat'],
            'tanggal' => now(),  // Isi tanggal otomatis saat pengajuan
            'status_surat' => 'Diajukan',
            'users_idUser' => auth()->user()->idUser,
        ];

        // Tambahkan validasi dan data khusus berdasarkan jenis surat
        switch ($validatedData['jenis_surat']) {
            case 'Aktif':
                $request->validate([
                    'semester' => 'required|integer',
                    'keperluan' => 'required|string',
                ]);
                $dataSurat['semester'] = $request->semester;
                $dataSurat['tujuan'] = $request->keperluan;
                break;

            case 'Pengantar':
                $request->validate([
                    'kode_mk' => 'required|string',
                    'nama_mk' => 'required|string',
                    'tujuan' => 'required|string',
                    'topik' => 'required|string',
                ]);
                $dataSurat['kode_mk'] = $request->kode_mk;
                $dataSurat['nama_mk'] = $request->nama_mk;
                $dataSurat['tujuan'] = $request->tujuan;
                $dataSurat['topik'] = $request->topik;
                break;

            case 'Lulus':
                $dataSurat['tujuan'] = 'Data diambil dari profil mahasiswa';
                break;

            case 'Laporan':
                $request->validate([
                    'keperluan' => 'required|string',
                ]);
                $dataSurat['tujuan'] = $request->keperluan;
                break;
        }

        // Simpan data ke tabel surat
        Surat::create($dataSurat);

        // Redirect dengan pesan sukses
        return redirect()->route('dashboard')->with('success', 'Surat berhasil diajukan.');
    }


    // Menyetujui atau menolak pengajuan oleh Kaprodi
    public function updateStatus(Request $request, Surat $surat)
    {
        if (auth()->user()->role_idRole !== 2) {
            return redirect()->route('surat.index')->with('error', 'Akses ditolak.');
        }

        $request->validate(['status_surat' => 'required']);
        $surat->update(['status_surat' => $request->status_surat]);
        return back()->with('success', 'Status surat diperbarui!');
    }

    // Mengunggah file surat oleh TU
    public function uploadSurat(Request $request, Surat $surat)
    {
        if (auth()->user()->role_idRole !== 3 || $surat->status_surat !== 'Disetujui') {
            return redirect()->route('surat.index')->with('error', 'Akses ditolak atau surat belum disetujui.');
        }

        $request->validate(['file_surat' => 'required|file|mimes:pdf']);
        $path = $request->file('file_surat')->store('surat');
        $surat->update(['file_surat' => $path, 'status_surat' => 'Selesai']);
        return back()->with('success', 'Surat berhasil diunggah!');
    }

    // Mengunduh file surat oleh mahasiswa hanya jika status selesai
    public function downloadSurat(Surat $surat)
    {
        if (auth()->user()->role_idRole !== 1 || $surat->users_idUser !== auth()->user()->idUser || $surat->status_surat !== 'Selesai') {
            return back()->with('error', 'Akses ditolak atau surat belum tersedia.');
        }

        if (!$surat->file_surat) {
            return back()->with('error', 'Surat belum tersedia.');
        }
        return Storage::download($surat->file_surat);
    }
}
