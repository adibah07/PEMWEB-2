<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Matakuliah;
use App\Models\Jadwal;
use App\Models\Absensi;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class MatakuliahController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        if ($user->role !== 'dosen') {
            return redirect()->back()->with('error', 'Akses ditolak. Hanya dosen yang dapat mengakses fitur ini.');
        }

        $dosen = $user->dosen;
        if (!$dosen) {
            return redirect()->back()->with('error', 'Data dosen tidak ditemukan.');
        }

        // Ambil mata kuliah yang diampu oleh dosen dengan statistik
        $matakuliahList = Matakuliah::where('dosen_id', $dosen->id)
            ->withCount([
                'jadwal as total_jadwal',
                'jadwal as total_mahasiswa' => function ($query) {
                    $query->join('jadwal_mahasiswa', 'jadwal.id', '=', 'jadwal_mahasiswa.jadwal_id')
                          ->selectRaw('COUNT(DISTINCT jadwal_mahasiswa.mahasiswa_id)');
                }
            ])
            ->get();

        // Hitung statistik tambahan untuk setiap mata kuliah
        foreach ($matakuliahList as $matakuliah) {
            // Total absensi hari ini untuk mata kuliah ini
            $absensiHariIni = Absensi::whereHas('jadwal', function ($query) use ($matakuliah) {
                $query->where('matakuliah_id', $matakuliah->id);
            })
            ->whereDate('tanggal', today())
            ->count();

            $matakuliah->absensi_hari_ini = $absensiHariIni;
        }

        return view('dashboard.matakuliah.index', compact('dosen', 'matakuliahList'));
    }

    public function show(Matakuliah $matakuliah)
    {
        $user = Auth::user();
        
        if ($user->role !== 'dosen') {
            return redirect()->back()->with('error', 'Akses ditolak. Hanya dosen yang dapat mengakses fitur ini.');
        }

        $dosen = $user->dosen;
        if (!$dosen || $matakuliah->dosen_id !== $dosen->id) {
            return redirect()->back()->with('error', 'Anda tidak memiliki akses ke mata kuliah ini.');
        }

        // Ambil jadwal untuk mata kuliah ini dengan relasi mahasiswa
        $jadwalList = $matakuliah->jadwal()
            ->with([
                'mahasiswa.user',
                'qrcodes' => function ($query) {
                    $query->where('is_active', true)->latest();
                }
            ])
            ->withCount('mahasiswa')
            ->orderBy('tanggal')
            ->orderBy('jam_mulai')
            ->get();

        // Statistik kehadiran untuk mata kuliah ini
        $totalMahasiswa = $jadwalList->sum('mahasiswa_count');
        $totalAbsensi = Absensi::whereHas('jadwal', function ($query) use ($matakuliah) {
            $query->where('matakuliah_id', $matakuliah->id);
        })->count();

        $absensiHadir = Absensi::whereHas('jadwal', function ($query) use ($matakuliah) {
            $query->where('matakuliah_id', $matakuliah->id);
        })->where('status', 'hadir')->count();

        $absensiIzin = Absensi::whereHas('jadwal', function ($query) use ($matakuliah) {
            $query->where('matakuliah_id', $matakuliah->id);
        })->where('status', 'izin')->count();

        $absensiSakit = Absensi::whereHas('jadwal', function ($query) use ($matakuliah) {
            $query->where('matakuliah_id', $matakuliah->id);
        })->where('status', 'sakit')->count();

        $absensiAlfa = Absensi::whereHas('jadwal', function ($query) use ($matakuliah) {
            $query->where('matakuliah_id', $matakuliah->id);
        })->where('status', 'alfa')->count();

        $persentaseKehadiran = $totalAbsensi > 0 ? round(($absensiHadir / $totalAbsensi) * 100, 1) : 0;

        // Absensi hari ini
        $absensiHariIni = Absensi::whereHas('jadwal', function ($query) use ($matakuliah) {
            $query->where('matakuliah_id', $matakuliah->id);
        })
        ->whereDate('tanggal', today())
        ->with(['mahasiswa.user', 'jadwal'])
        ->orderBy('created_at', 'desc')
        ->get();

        $statistik = [
            'total_mahasiswa' => $totalMahasiswa,
            'total_absensi' => $totalAbsensi,
            'hadir' => $absensiHadir,
            'izin' => $absensiIzin,
            'sakit' => $absensiSakit,
            'alfa' => $absensiAlfa,
            'persentase_kehadiran' => $persentaseKehadiran,
            'absensi_hari_ini' => $absensiHariIni->count()
        ];

        return view('dashboard.matakuliah.show', compact('dosen', 'matakuliah', 'jadwalList', 'statistik', 'absensiHariIni'));
    }
}
