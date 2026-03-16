<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\Surat;
use App\Models\JenisSurat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class SuratController extends Controller
{
    /**
     * Tampilkan form pengajuan surat
     */
    public function create()
    {
        // Ambil semua jenis surat untuk dropdown
        $jenisSurats = JenisSurat::all();

        return view('mahasiswa.surat.create', compact('jenisSurats'));
    }

    /**
     * Simpan pengajuan surat ke database
     */
    public function store(Request $request)
    {
        // 1. Validasi input
        $request->validate([
            'jenis_surat_id' => 'required|exists:jenis_surats,id',
            'keperluan' => 'required|string|max:1000',
            'bukti_pendukung' => 'required|file|mimes:pdf|max:2048',
        ], [
            'jenis_surat_id.required' => 'Jenis surat wajib dipilih',
            'jenis_surat_id.exists' => 'Jenis surat tidak valid',
            'keperluan.required' => 'Keperluan wajib diisi',
            'keperluan.max' => 'Keperluan maksimal 1000 karakter',
            'bukti_pendukung.required' => 'Bukti pendukung wajib diupload',
            'bukti_pendukung.file' => 'File harus berupa PDF',
            'bukti_pendukung.mimes' => 'File harus berformat PDF',
            'bukti_pendukung.max' => 'Ukuran file maksimal 2MB',
        ]);

        // 2. Upload bukti pendukung
        $file = $request->file('bukti_pendukung');
        $fileName = 'bukti_' . Auth::id() . '_' . time() . '.' . $file->getClientOriginalExtension();
        $filePath = $file->storeAs('bukti-pendukung', $fileName, 'public');

        // 3. Simpan ke database
        Surat::create([
            'user_id' => Auth::id(),
            'jenis_surat_id' => $request->jenis_surat_id,
            'keperluan' => $request->keperluan,
            'bukti_pendukung' => $filePath,
            'status' => 'pending_admin',
        ]);

        // 4. Redirect dengan success message
        return redirect()->route('mahasiswa.surat.index')
            ->with('success', 'Surat berhasil diajukan! Status: Pending Admin');
    }

    /**
     * Tampilkan riwayat surat mahasiswa
     */
    public function index()
    {
        // Ambil surat milik user yang login
        $surats = Surat::with('jenisSurat')
            ->where('user_id', Auth::id())
            ->latest()
            ->paginate(10);

        return view('mahasiswa.surat.index', compact('surats'));
    }

    /**
     * Download surat final yang sudah approved
     */
    public function download(Surat $surat)
    {
        // 1. Cek kepemilikan surat
        if ($surat->user_id !== Auth::id()) {
            abort(403, 'Unauthorized access');
        }

        // 2. Cek status surat
        if ($surat->status !== 'approved' || !$surat->file_pdf) {
            return redirect()->back()
                ->with('error', 'Surat belum siap diunduh. Menunggu approval admin.');
        }

        // 3. Download file PDF
        return response()->download(storage_path('app/public/' . $surat->file_pdf));
    }
}
