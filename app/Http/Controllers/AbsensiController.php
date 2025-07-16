<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controller;
use App\Models\Jadwal;
use App\Models\Absensi;
use App\Models\Mahasiswa;
use App\Models\QrCode;
use Carbon\Carbon;

class AbsensiController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $dosen = $user->dosen;

        if (!$dosen) {
            return redirect()->back()->with('error', 'Anda tidak memiliki akses sebagai dosen.');
        }

        // Ambil parameter sorting
        $sortBy = $request->get('sort_by', 'tanggal');
        $sortOrder = $request->get('sort_order', 'desc');
        $filterTanggal = $request->get('tanggal');

        // Query builder untuk jadwal
        $query = Jadwal::whereHas('matakuliah', function ($query) use ($dosen) {
            $query->where('dosen_id', $dosen->id);
        })->with(['matakuliah', 'mahasiswa.user']);

        // Filter berdasarkan tanggal jika ada
        if ($filterTanggal) {
            $query->whereDate('tanggal', $filterTanggal);
        }

        // Sorting
        if ($sortBy === 'tanggal') {
            $query->orderBy('tanggal', $sortOrder);
        } elseif ($sortBy === 'mata_kuliah') {
            $query->join('matakuliah', 'jadwal.matakuliah_id', '=', 'matakuliah.id')
                  ->orderBy('matakuliah.nama', $sortOrder)
                  ->select('jadwal.*');
        } elseif ($sortBy === 'waktu') {
            $query->orderBy('jam_mulai', $sortOrder);
        }

        // Tambahan sorting untuk konsistensi
        if ($sortBy !== 'tanggal') {
            $query->orderBy('tanggal', 'desc');
        }
        
        $jadwals = $query->get();

        return view('dashboard.absensi.index', compact('jadwals', 'sortBy', 'sortOrder', 'filterTanggal'));
    }

    public function show(Jadwal $jadwal)
    {
        $user = Auth::user();
        $dosen = $user->dosen;

        // Pastikan jadwal ini milik dosen yang login
        if ($jadwal->matakuliah->dosen_id !== $dosen->id) {
            return redirect()->route('absensi.index')->with('error', 'Anda tidak memiliki akses ke jadwal ini.');
        }

        // Load relasi yang diperlukan
        $jadwal->load(['matakuliah', 'mahasiswa.user']);

        // Ambil absensi hari ini untuk jadwal ini
        $today = Carbon::today();
        $absensiToday = Absensi::where('jadwal_id', $jadwal->id)
            ->whereDate('created_at', $today)
            ->with('mahasiswa.user')
            ->get()
            ->keyBy('mahasiswa_id');

        // Ambil QR Code aktif untuk jadwal ini
        $activeQrCode = QrCode::where('jadwal_id', $jadwal->id)
            ->where('is_active', true)
            ->where('expired_at', '>', now())
            ->first();

        return view('dashboard.absensi.show', compact('jadwal', 'absensiToday', 'activeQrCode'));
    }

    public function store(Request $request, Jadwal $jadwal)
    {
        $user = Auth::user();
        $dosen = $user->dosen;

        // Pastikan jadwal ini milik dosen yang login
        if ($jadwal->matakuliah->dosen_id !== $dosen->id) {
            return redirect()->route('absensi.index')->with('error', 'Anda tidak memiliki akses ke jadwal ini.');
        }        $request->validate([
            'mahasiswa_ids' => 'required|array|min:1',
            'mahasiswa_ids.*' => 'exists:mahasiswa,id',
            'status' => 'required|in:hadir,izin,sakit,alpa',
            'keterangan' => 'nullable|string|max:255',
        ]);

        $today = Carbon::today();
        $successCount = 0;
        $duplicateCount = 0;

        foreach ($request->mahasiswa_ids as $mahasiswaId) {
            // Cek apakah mahasiswa sudah absen hari ini
            $existingAbsensi = Absensi::where('jadwal_id', $jadwal->id)
                ->where('mahasiswa_id', $mahasiswaId)
                ->whereDate('created_at', $today)
                ->first();

            if (!$existingAbsensi) {
                // Pastikan mahasiswa terdaftar di jadwal ini
                if ($jadwal->mahasiswa()->where('mahasiswa_id', $mahasiswaId)->exists()) {                    Absensi::create([
                        'jadwal_id' => $jadwal->id,
                        'mahasiswa_id' => $mahasiswaId,
                        'status' => $request->status,
                        'keterangan' => $request->keterangan,
                        'tanggal' => $today,
                        'waktu_absen' => now(),
                    ]);
                    $successCount++;
                }
            } else {
                $duplicateCount++;
            }
        }

        $message = "Berhasil menambahkan {$successCount} absensi.";
        if ($duplicateCount > 0) {
            $message .= " {$duplicateCount} mahasiswa sudah absen hari ini.";
        }

        return redirect()->route('absensi.show', $jadwal)->with('success', $message);
    }

    public function update(Request $request, Jadwal $jadwal, Absensi $absensi)
    {
        $user = Auth::user();
        $dosen = $user->dosen;

        // Pastikan jadwal ini milik dosen yang login
        if ($jadwal->matakuliah->dosen_id !== $dosen->id) {
            return redirect()->route('absensi.index')->with('error', 'Anda tidak memiliki akses ke jadwal ini.');
        }

        // Pastikan absensi ini untuk jadwal yang benar
        if ($absensi->jadwal_id !== $jadwal->id) {
            return redirect()->route('absensi.show', $jadwal)->with('error', 'Absensi tidak valid.');
        }        $request->validate([
            'status' => 'required|in:hadir,izin,sakit,alpa',
            'keterangan' => 'nullable|string|max:255',
        ]);

        $absensi->update([
            'status' => $request->status,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->route('absensi.show', $jadwal)->with('success', 'Status absensi berhasil diupdate.');
    }

    public function destroy(Jadwal $jadwal, Absensi $absensi)
    {
        $user = Auth::user();
        $dosen = $user->dosen;

        // Pastikan jadwal ini milik dosen yang login
        if ($jadwal->matakuliah->dosen_id !== $dosen->id) {
            return redirect()->route('absensi.index')->with('error', 'Anda tidak memiliki akses ke jadwal ini.');
        }

        // Pastikan absensi ini untuk jadwal yang benar
        if ($absensi->jadwal_id !== $jadwal->id) {
            return redirect()->route('absensi.show', $jadwal)->with('error', 'Absensi tidak valid.');
        }

        $absensi->delete();

        return redirect()->route('absensi.show', $jadwal)->with('success', 'Absensi berhasil dihapus.');
    }

    // Fungsi untuk scan QR Code (untuk mahasiswa)
    public function scan($code)
    {
        $qrcode = QrCode::where('kode_qr', $code)->first();

        if (!$qrcode) {
            return view('absensi.invalid', [
                'message' => 'QR Code tidak valid atau tidak ditemukan.'
            ]);
        }

        if (now() > $qrcode->expired_at) {
            return view('absensi.invalid', [
                'message' => 'QR Code sudah expired. Silakan minta QR Code baru kepada dosen.'
            ]);
        }

        $jadwal = $qrcode->jadwal;
        
        return view('absensi.scan', compact('qrcode', 'jadwal'));
    }

    // Fungsi untuk proses absensi via QR Code
    public function scanStore(Request $request, $code)
    {
        $qrcode = QrCode::where('kode_qr', $code)->first();

        if (!$qrcode) {
            return redirect()->back()->with('error', 'QR Code tidak valid.');
        }

        if (now() > $qrcode->expired_at) {
            return redirect()->back()->with('error', 'QR Code sudah expired.');
        }

        $request->validate([
            'nim' => 'required|string',
            'nama' => 'required|string|max:255',
        ]);

        // Cek apakah mahasiswa sudah absen untuk jadwal ini hari ini
        $today = Carbon::today();
        $existingAbsensi = Absensi::where('jadwal_id', $qrcode->jadwal_id)
            ->where('nim', $request->nim)
            ->whereDate('created_at', $today)
            ->first();

        if ($existingAbsensi) {
            return redirect()->back()->with('error', 'Anda sudah melakukan absensi untuk mata kuliah ini hari ini.');
        }        // Simpan absensi
        Absensi::create([
            'jadwal_id' => $qrcode->jadwal_id,
            'qrcode_id' => $qrcode->id,
            'nim' => $request->nim,
            'nama' => $request->nama,
            'tanggal' => $today,
            'waktu_absen' => now(),
            'status' => 'hadir',
        ]);

        return redirect()->route('absensi.success')->with('success', 'Absensi berhasil dicatat!');
    }

    public function success()
    {
        return view('absensi.success');
    }
}
