<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\QrCode;
use App\Models\Absensi;
use App\Models\Mahasiswa;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use Illuminate\Routing\Controller;

class ScanController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        if ($user->role !== 'mahasiswa') {
            return redirect()->back()->with('error', 'Akses ditolak. Hanya mahasiswa yang dapat mengakses fitur ini.');
        }

        $mahasiswa = $user->mahasiswa;
        if (!$mahasiswa) {
            return redirect()->back()->with('error', 'Data mahasiswa tidak ditemukan.');
        }

        return view('dashboard.scan.index', compact('mahasiswa'));
    }

    public function scan(Request $request)
    {
        try {
            $user = Auth::user();
            
            if ($user->role !== 'mahasiswa') {
                return response()->json(['success' => false, 'message' => 'Akses ditolak. Hanya mahasiswa yang dapat mengakses fitur ini.']);
            }            $mahasiswa = $user->mahasiswa;
            if (!$mahasiswa) {
                return response()->json(['success' => false, 'message' => 'Data mahasiswa tidak ditemukan.']);
            }

            // Get and clean QR code input
            $qrCodeInput = $request->input('qr_code', '');
            $qrCode = strtoupper(trim($qrCodeInput));
              // Debug log
            Log::info('QR Scan attempt', [
                'raw_input' => $qrCodeInput,
                'cleaned' => $qrCode,
                'length' => strlen($qrCode),
                'pattern_match' => preg_match('/^[A-Z]{4}[0-9]{4}$/', $qrCode)
            ]);

            // Manual validation with better error handling
            if (empty($qrCode)) {
                return response()->json(['success' => false, 'message' => 'Kode QR harus diisi.']);
            }
            
            if (strlen($qrCode) !== 8) {
                return response()->json(['success' => false, 'message' => 'Kode QR harus tepat 8 karakter. Diterima: ' . strlen($qrCode) . ' karakter.']);
            }
            
            if (!preg_match('/^[A-Z]{4}[0-9]{4}$/', $qrCode)) {
                return response()->json(['success' => false, 'message' => 'Format kode QR tidak valid. Harus 4 huruf diikuti 4 angka (contoh: ABCD1234). Diterima: ' . $qrCode]);
            }
            
            // Cari QR Code yang aktif
            $qrCodeData = QrCode::where('kode_qr', $qrCode)
                                ->where('is_active', true)
                                ->first();
              if (!$qrCodeData) {
                return response()->json(['success' => false, 'message' => 'QR Code tidak valid atau sudah tidak aktif.']);
            }

            // Cek apakah QR Code sudah kedaluwarsa
            if ($qrCodeData->isExpired()) {
                return response()->json(['success' => false, 'message' => 'QR Code sudah kedaluwarsa.']);
            }

            $jadwal = $qrCodeData->jadwal;
            if (!$jadwal) {
                return response()->json(['success' => false, 'message' => 'Jadwal tidak ditemukan untuk QR Code ini.']);
            }

            // Cek apakah mahasiswa terdaftar di jadwal ini
            $isEnrolled = $jadwal->mahasiswa()->where('mahasiswa_id', $mahasiswa->id)->exists();
            if (!$isEnrolled) {
                return response()->json(['success' => false, 'message' => 'Anda tidak terdaftar di jadwal kuliah ini.']);
            }

            // Cek apakah sudah absen hari ini untuk jadwal ini
            $today = Carbon::today();
            $existingAbsensi = Absensi::where('mahasiswa_id', $mahasiswa->id)
                                    ->where('jadwal_id', $jadwal->id)
                                    ->whereDate('tanggal', $today)
                                    ->first();
              if ($existingAbsensi) {
                return response()->json(['success' => false, 'message' => 'Anda sudah melakukan absensi untuk jadwal ini hari ini.']);
            }
            
            // Simpan absensi
            $absensi = Absensi::create([
                'mahasiswa_id' => $mahasiswa->id,
                'jadwal_id' => $jadwal->id,
                'qrcode_id' => $qrCodeData->id,
                'status' => 'hadir',
                'tanggal' => $today,
                'waktu_absen' => Carbon::now(),
                'keterangan' => 'Hadir via QR Code'
            ]);

            return response()->json([
                'success' => true, 
                'message' => 'Absensi berhasil dicatat!',
                'data' => [
                    'matakuliah' => $jadwal->matakuliah->nama,
                    'tanggal' => $jadwal->tanggal->format('d/m/Y'),
                    'tanggal_formatted' => $jadwal->tanggal->format('d/m/Y') . ' (' . $jadwal->tanggal->format('l') . ')',
                    'jam' => $jadwal->jam_mulai . ' - ' . $jadwal->jam_selesai,
                    'ruangan' => $jadwal->ruangan,
                    'waktu_absen' => Carbon::now('Asia/Jakarta')->format('H:i:s')
                ]
            ]);
            
        } catch (\Exception $e) {
            Log::error('Error in scan method: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Terjadi kesalahan sistem: ' . $e->getMessage()]);
        }
    }

    public function jadwal()
    {
        $user = Auth::user();
        
        if ($user->role !== 'mahasiswa') {
            return redirect()->back()->with('error', 'Akses ditolak. Hanya mahasiswa yang dapat mengakses fitur ini.');
        }

        $mahasiswa = $user->mahasiswa;
        if (!$mahasiswa) {
            return redirect()->back()->with('error', 'Data mahasiswa tidak ditemukan.');
        }

        // Ambil semua jadwal yang diikuti mahasiswa dengan relasi yang diperlukan
        $jadwalList = $mahasiswa->jadwal()
            ->with([
                'matakuliah.dosen.user',
                'absensi' => function($query) use ($mahasiswa) {
                    $query->where('mahasiswa_id', $mahasiswa->id);
                }
            ])
            ->orderBy('tanggal')
            ->orderBy('jam_mulai')
            ->get();

        // Hitung statistik kehadiran untuk setiap jadwal
        $statistik = [];
        foreach ($jadwalList as $jadwal) {
            $totalAbsensi = $jadwal->absensi->count();
            $hadir = $jadwal->absensi->where('status', 'hadir')->count();
            $izin = $jadwal->absensi->where('status', 'izin')->count();
            $sakit = $jadwal->absensi->where('status', 'sakit')->count();
            $alfa = $jadwal->absensi->where('status', 'alfa')->count();
            
            $persentaseKehadiran = $totalAbsensi > 0 ? round(($hadir / $totalAbsensi) * 100, 1) : 0;
            
            $statistik[$jadwal->id] = [
                'total' => $totalAbsensi,
                'hadir' => $hadir,
                'izin' => $izin,
                'sakit' => $sakit,
                'alfa' => $alfa,
                'persentase' => $persentaseKehadiran
            ];
        }

        return view('dashboard.mahasiswa.jadwal', compact('mahasiswa', 'jadwalList', 'statistik'));
    }

    public function riwayat()
    {
        $user = Auth::user();
        
        if ($user->role !== 'mahasiswa') {
            return redirect()->back()->with('error', 'Akses ditolak. Hanya mahasiswa yang dapat mengakses fitur ini.');
        }

        $mahasiswa = $user->mahasiswa;
        if (!$mahasiswa) {
            return redirect()->back()->with('error', 'Data mahasiswa tidak ditemukan.');
        }

        // Ambil riwayat absensi mahasiswa
        $riwayatAbsensi = Absensi::where('mahasiswa_id', $mahasiswa->id)
                                ->with(['jadwal.matakuliah.dosen.user'])
                                ->orderBy('tanggal', 'desc')
                                ->orderBy('created_at', 'desc')
                                ->paginate(20);        return view('dashboard.scan.riwayat', compact('mahasiswa', 'riwayatAbsensi'));
    }
    
    public function absenAnggota(Request $request)
    {
        $user = Auth::user();
        
        if ($user->role !== 'mahasiswa') {
            return redirect()->back()->with('error', 'Akses ditolak. Hanya mahasiswa yang dapat mengakses fitur ini.');
        }

        $mahasiswa = $user->mahasiswa;
        if (!$mahasiswa) {
            return redirect()->back()->with('error', 'Data mahasiswa tidak ditemukan.');
        }

        // Ambil parameter filter dari request
        $tanggalFilter = $request->get('tanggal', Carbon::today('Asia/Jakarta')->format('Y-m-d'));
        $sortBy = $request->get('sort_by', 'tanggal');
        $sortOrder = $request->get('sort_order', 'asc');

        // Validasi tanggal filter
        try {
            $tanggalFilterCarbon = Carbon::parse($tanggalFilter);
        } catch (\Exception $e) {
            $tanggalFilterCarbon = Carbon::today('Asia/Jakarta');
            $tanggalFilter = $tanggalFilterCarbon->format('Y-m-d');
        }

        // Query builder untuk jadwal
        $jadwalQuery = \App\Models\Jadwal::with(['matakuliah.dosen.user']);

        // Filter berdasarkan tanggal jika ada
        if ($tanggalFilter) {
            $jadwalQuery->whereDate('tanggal', $tanggalFilterCarbon);
        }

        // Sorting
        if ($sortBy === 'tanggal') {
            $jadwalQuery->orderBy('tanggal', $sortOrder);
        } elseif ($sortBy === 'jam_mulai') {
            $jadwalQuery->orderBy('jam_mulai', $sortOrder);
        } elseif ($sortBy === 'matakuliah') {
            $jadwalQuery->join('matakuliah', 'jadwal.matakuliah_id', '=', 'matakuliah.id')
                       ->orderBy('matakuliah.nama', $sortOrder)
                       ->select('jadwal.*');
        }

        // Ambil jadwal berdasarkan filter
        $jadwalList = $jadwalQuery->get()
            ->map(function($jadwal) {
                $now = Carbon::now('Asia/Jakarta');
                
                // Cek apakah jadwal untuk hari ini
                $isToday = $jadwal->tanggal->isToday();
                
                // Cek waktu dengan parsing yang lebih aman
                try {
                    // Ambil jam dalam format string dan pastikan formatnya benar
                    $jamMulaiStr = is_string($jadwal->jam_mulai) ? $jadwal->jam_mulai : $jadwal->jam_mulai->format('H:i:s');
                    $jamSelesaiStr = is_string($jadwal->jam_selesai) ? $jadwal->jam_selesai : $jadwal->jam_selesai->format('H:i:s');
                    
                    // Parse jam dengan try-catch
                    $jamMulai = Carbon::createFromFormat('H:i:s', $jamMulaiStr);
                    $jamSelesai = Carbon::createFromFormat('H:i:s', $jamSelesaiStr);
                    $waktuSekarang = Carbon::now('Asia/Jakarta')->format('H:i:s');
                    
                    // Validasi jadwal yang tidak valid (jam selesai < jam mulai)
                    if ($jamSelesai->format('H:i:s') <= $jamMulai->format('H:i:s')) {
                        $jadwal->status_waktu = 'jadwal_tidak_valid';
                        $isWaktuAbsen = false;
                    } else {
                        // Logika akses: bisa diakses 15 menit sebelum jam mulai sampai jam selesai (sama seperti absenAnggotaJadwal)
                        $jamMulaiToleransi = Carbon::createFromFormat('H:i:s', $jamMulaiStr)->subMinutes(15);
                        $isWaktuAbsen = $isToday && 
                            $waktuSekarang >= $jamMulaiToleransi->format('H:i:s') && 
                            $waktuSekarang <= $jamSelesai->format('H:i:s');
                        
                        // Status untuk display
                        if (!$isToday) {
                            if ($jadwal->tanggal->isPast()) {
                                $jadwal->status_waktu = 'sudah_lewat';
                            } else {
                                $jadwal->status_waktu = 'akan_datang';
                            }
                        } else if ($waktuSekarang > $jamSelesai->format('H:i:s')) {
                            $jadwal->status_waktu = 'sudah_selesai';
                        } else if ($waktuSekarang >= $jamMulaiToleransi->format('H:i:s')) {
                            // Jika sudah bisa absen (15 menit sebelum jam mulai), set tersedia
                            $jadwal->status_waktu = 'tersedia';
                        } else {
                            // Jika belum bisa absen
                            $jadwal->status_waktu = 'belum_mulai';
                        }
                    }
                } catch (\Exception $e) {
                    // Jika parsing gagal, set default
                    $isWaktuAbsen = false;
                    $jadwal->status_waktu = 'error_parsing';
                }
                
                $jadwal->is_today = $isToday;
                $jadwal->is_waktu_absen = $isWaktuAbsen;
                
                return $jadwal;
            });

        // Statistik untuk info
        $totalJadwal = $jadwalList->count();
        $jadwalTersedia = $jadwalList->where('is_waktu_absen', true)->count();
        $jadwalAkanDatang = $jadwalList->where('status_waktu', 'akan_datang')->count();
        $jadwalSudahLewat = $jadwalList->where('status_waktu', 'sudah_lewat')->count();

        return view('dashboard.scan.absen-anggota', compact(
            'mahasiswa', 
            'jadwalList', 
            'totalJadwal',
            'jadwalTersedia',
            'jadwalAkanDatang', 
            'jadwalSudahLewat',
            'tanggalFilter',
            'sortBy',
            'sortOrder'
        ));
    }

    public function absenAnggotaJadwal($jadwalId)
    {
        $user = Auth::user();
        
        if ($user->role !== 'mahasiswa') {
            return redirect()->back()->with('error', 'Akses ditolak. Hanya mahasiswa yang dapat mengakses fitur ini.');
        }

        $mahasiswa = $user->mahasiswa;
        if (!$mahasiswa) {
            return redirect()->back()->with('error', 'Data mahasiswa tidak ditemukan.');
        }

        $jadwal = \App\Models\Jadwal::with(['matakuliah.dosen.user'])
            ->findOrFail($jadwalId);

        // Validasi waktu - gunakan timezone Asia/Jakarta
        $now = Carbon::now('Asia/Jakarta');
        
        // Cek apakah jadwal untuk hari ini berdasarkan tanggal
        $isToday = $jadwal->tanggal->isToday();
        
        try {
            // Parse jam dengan handling yang lebih aman
            $jamMulaiStr = is_string($jadwal->jam_mulai) ? $jadwal->jam_mulai : $jadwal->jam_mulai->format('H:i:s');
            $jamSelesaiStr = is_string($jadwal->jam_selesai) ? $jadwal->jam_selesai : $jadwal->jam_selesai->format('H:i:s');
            
            $jamMulai = Carbon::createFromFormat('H:i:s', $jamMulaiStr);
            $jamSelesai = Carbon::createFromFormat('H:i:s', $jamSelesaiStr);
            $waktuSekarang = Carbon::now()->format('H:i:s');
            
            // Validasi jadwal yang tidak valid (jam selesai <= jam mulai)
            if ($jamSelesai->format('H:i:s') <= $jamMulai->format('H:i:s')) {
                return redirect()->route('mahasiswa.absen-anggota')->with('error', 'Jadwal kuliah ini tidak valid (jam selesai kurang dari atau sama dengan jam mulai).');
            }
            
            // Logika akses: bisa diakses 15 menit sebelum jam mulai sampai jam selesai
            $jamMulaiToleransi = Carbon::createFromFormat('H:i:s', $jamMulaiStr)->subMinutes(15);
            $isWaktuAbsen = $isToday && 
                $waktuSekarang >= $jamMulaiToleransi->format('H:i:s') && 
                $waktuSekarang <= $jamSelesai->format('H:i:s');
        } catch (\Exception $e) {
            // Jika parsing gagal, set tidak bisa absen
            $isWaktuAbsen = false;
        }

        if (!$isWaktuAbsen) {
            return redirect()->route('mahasiswa.absen-anggota')->with('error', 'Absensi hanya dapat dilakukan pada waktu jadwal kuliah.');
        }

        // Ambil mahasiswa yang terdaftar di mata kuliah dan kelas yang sama
        $mahasiswaKelas = \App\Models\Mahasiswa::where('kelas', $mahasiswa->kelas)
            ->with('user')
            ->get();

        // Ambil data absensi yang sudah ada untuk hari ini
        $absensiHariIni = \App\Models\Absensi::where('jadwal_id', $jadwal->id)
            ->whereDate('tanggal', Carbon::today('Asia/Jakarta'))
            ->pluck('mahasiswa_id')
            ->toArray();

        return view('dashboard.scan.kelola-absen-anggota', compact('jadwal', 'mahasiswaKelas', 'absensiHariIni', 'mahasiswa'));
    }

    public function storeAbsenAnggota(Request $request, $jadwalId)
    {
        $user = Auth::user();
        
        if ($user->role !== 'mahasiswa') {
            return response()->json(['success' => false, 'message' => 'Akses ditolak.']);
        }

        $mahasiswa = $user->mahasiswa;
        if (!$mahasiswa) {
            return response()->json(['success' => false, 'message' => 'Data mahasiswa tidak ditemukan.']);
        }

        $jadwal = \App\Models\Jadwal::findOrFail($jadwalId);

        // Validasi waktu lagi - gunakan timezone Asia/Jakarta
        $now = Carbon::now('Asia/Jakarta');
        
        // Cek apakah jadwal untuk hari ini berdasarkan tanggal
        $isToday = $jadwal->tanggal->isToday();
        
        try {
            // Parse jam dengan handling yang lebih aman
            $jamMulaiStr = is_string($jadwal->jam_mulai) ? $jadwal->jam_mulai : $jadwal->jam_mulai->format('H:i:s');
            $jamSelesaiStr = is_string($jadwal->jam_selesai) ? $jadwal->jam_selesai : $jadwal->jam_selesai->format('H:i:s');
            
            $jamMulai = Carbon::createFromFormat('H:i:s', $jamMulaiStr);
            $jamSelesai = Carbon::createFromFormat('H:i:s', $jamSelesaiStr);
            $waktuSekarang = Carbon::now()->format('H:i:s');
            
            $isWaktuAbsen = $isToday && 
                $waktuSekarang >= $jamMulai->format('H:i:s') && 
                $waktuSekarang <= $jamSelesai->format('H:i:s');
        } catch (\Exception $e) {
            // Jika parsing gagal, set tidak bisa absen
            $isWaktuAbsen = false;
        }

        if (!$isWaktuAbsen) {
            return response()->json(['success' => false, 'message' => 'Absensi hanya dapat dilakukan pada waktu jadwal kuliah.']);
        }

        $request->validate([
            'absensi' => 'required|array',
            'absensi.*' => 'required|in:hadir,izin,sakit,alpa'
        ]);

        try {
            $absensiData = $request->input('absensi');
            $saved = 0;

            foreach ($absensiData as $mahasiswaId => $status) {
                // Cek apakah sudah ada absensi hari ini
                $existingAbsensi = \App\Models\Absensi::where('jadwal_id', $jadwal->id)
                    ->where('mahasiswa_id', $mahasiswaId)
                    ->whereDate('tanggal', Carbon::today('Asia/Jakarta'))
                    ->first();

                if (!$existingAbsensi) {
                    \App\Models\Absensi::create([
                        'jadwal_id' => $jadwal->id,
                        'mahasiswa_id' => $mahasiswaId,
                        'status' => $status,
                        'tanggal' => Carbon::today('Asia/Jakarta'),
                        'waktu_absen' => Carbon::now('Asia/Jakarta'),
                        'keterangan' => 'Absen manual oleh anggota kelas'
                    ]);
                    $saved++;
                }
            }

            return response()->json([
                'success' => true, 
                'message' => "Berhasil menyimpan {$saved} data absensi."
            ]);

        } catch (\Exception $e) {
            Log::error('Error saving absensi anggota: ' . $e->getMessage());
            return response()->json([
                'success' => false, 
                'message' => 'Gagal menyimpan data absensi.'
            ]);
        }
    }
}
