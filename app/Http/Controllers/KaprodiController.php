<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Surat;

class KaprodiController extends Controller
{
    public function updateStatus(Request $request, $id)
    {
        $surat = Surat::findOrFail($id);
        $surat->status_surat = $request->status;
        $surat->save();

        return redirect()->back()->with('success', 'Status surat berhasil diperbarui.');
    }
}
