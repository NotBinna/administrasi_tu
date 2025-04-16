<?php

namespace App\Http\Controllers;

use App\Models\Surat;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SuratController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $prodiId = $user->prodi_idProdi;

        if ($user->role_idRole == 1) {
            $aktif = Surat::with('mahasiswa')->where('jenis_surat', 'Aktif')->where('users_idUser', $user->idUser)->get();
            $pengantar = Surat::with('mahasiswa')->where('jenis_surat', 'Pengantar')->where('users_idUser', $user->idUser)->get();
            $lulus = Surat::with('mahasiswa')->where('jenis_surat', 'Lulus')->where('users_idUser', $user->idUser)->get();
            $laporan = Surat::with('mahasiswa')->where('jenis_surat', 'Laporan')->where('users_idUser', $user->idUser)->get();
            return view('mahasiswa.surat.index', compact('aktif', 'pengantar', 'lulus', 'laporan'));
        } elseif ($user->role_idRole == 2) {
            $aktif = Surat::with('mahasiswa')
                ->where('jenis_surat', 'Aktif')
                ->whereHas('mahasiswa', function ($query) use ($prodiId) {
                    $query->where('prodi_idProdi', $prodiId);
                })->get();

            $pengantar = Surat::with('mahasiswa')
                ->where('jenis_surat', 'Pengantar')
                ->whereHas('mahasiswa', function ($query) use ($prodiId) {
                    $query->where('prodi_idProdi', $prodiId);
                })->get();

            $lulus = Surat::with('mahasiswa')
                ->where('jenis_surat', 'Lulus')
                ->whereHas('mahasiswa', function ($query) use ($prodiId) {
                    $query->where('prodi_idProdi', $prodiId);
                })->get();

            $laporan = Surat::with('mahasiswa')
                ->where('jenis_surat', 'Laporan')
                ->whereHas('mahasiswa', function ($query) use ($prodiId) {
                    $query->where('prodi_idProdi', $prodiId);
                })->get();

            return view('kaprodi.surat.index', compact('aktif', 'pengantar', 'lulus', 'laporan'));
        } elseif ($user->role_idRole == 3) {
            $aktif = Surat::with('mahasiswa')
                ->where('jenis_surat', 'Aktif')
                ->whereIn('status_surat', ['Disetujui', 'Selesai'])
                ->whereHas('mahasiswa', function ($query) use ($prodiId) {
                    $query->where('prodi_idProdi', $prodiId);
                })->get();

            $pengantar = Surat::with('mahasiswa')
                ->where('jenis_surat', 'Pengantar')
                ->whereIn('status_surat', ['Disetujui', 'Selesai'])
                ->whereHas('mahasiswa', function ($query) use ($prodiId) {
                    $query->where('prodi_idProdi', $prodiId);
                })->get();

            $lulus = Surat::with('mahasiswa')
                ->where('jenis_surat', 'Lulus')
                ->whereIn('status_surat', ['Disetujui', 'Selesai'])
                ->whereHas('mahasiswa', function ($query) use ($prodiId) {
                    $query->where('prodi_idProdi', $prodiId);
                })->get();

            $laporan = Surat::with('mahasiswa')
                ->where('jenis_surat', 'Laporan')
                ->whereIn('status_surat', ['Disetujui', 'Selesai'])
                ->whereHas('mahasiswa', function ($query) use ($prodiId) {
                    $query->where('prodi_idProdi', $prodiId);
                })->get();

            return view('tu.surat.index', compact('aktif', 'pengantar', 'lulus', 'laporan'));
        }
    }

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

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'jenis_surat' => 'required|string',
        ]);

        $dataSurat = [
            'jenis_surat' => $validatedData['jenis_surat'],
            'tanggal' => now(),
            'status_surat' => 'Diajukan',
            'users_idUser' => auth()->user()->idUser,
        ];

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
                $dataSurat['tujuan'] = null;
                break;

            case 'Laporan':
                $request->validate([
                    'keperluan' => 'required|string',
                ]);
                $dataSurat['tujuan'] = $request->keperluan;
                break;
        }

        Surat::create($dataSurat);

        return redirect()->route('mahasiswa.surat.index')->with('success', 'Surat berhasil diajukan.');
    }


    public function updateStatus(Request $request, $id)
    {
        $surat = Surat::findOrFail($id);

        if (auth()->user()->role_idRole !== 2) {
            return redirect()->route('surat.index')->with('error', 'Akses ditolak.');
        }

        $request->validate([
            'status' => 'required|in:Disetujui,Ditolak',
            'detail_surat' => 'nullable|string|max:255',
        ]);

        $surat->status_surat = $request->status;

        // Tambahkan detail_surat hanya jika Ditolak
        if ($request->status === 'Ditolak') {
            $surat->detail_surat = $request->input('detail_surat');
        } else {
            $surat->detail_surat = null;
        }
        $surat->save();

        return back()->with('success', 'Status surat diperbarui!');
    }


    public function upload(Request $request, $idSurat)
    {
        $request->validate([
            'file_surat' => 'required|mimes:pdf|max:10240',
        ]);

        $surat = Surat::findOrFail($idSurat);

        if ($request->hasFile('file_surat')) {
            $idUser = $surat->users_idUser ?? 'unknown';
            $fileName = $idUser . '_' . $surat->idSurat . '_' . $surat->jenis_surat . '.' . $request->file('file_surat')->extension();

            $path = $request->file('file_surat')->storeAs('surat', $fileName, 'public');

            $surat->file_surat = $path;
            $surat->status_surat = 'Selesai';
            $surat->save();
        }

        return redirect()->route('tu.surat.index')->with('success', 'File surat berhasil di-upload.');
    }

    public function download($id)
    {
        $surat = Surat::findOrFail($id);

        $filePath = storage_path('app/public/' . $surat->file_surat);

        if (file_exists($filePath)) {
            return response()->download($filePath);
        } else {
            return back()->with('error', 'File tidak ditemukan.');
        }
    }
}
