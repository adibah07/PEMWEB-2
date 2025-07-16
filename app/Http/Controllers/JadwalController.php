<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use App\Models\Matakuliah;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class JadwalController extends Controller
{
    public function index()
    {
        // Ambil dosen yang sedang login
        $user = Auth::user();
        $dosen = $user->dosen;

        if (!$dosen) {
            return redirect()->back()->with('error', 'Anda tidak memiliki akses sebagai dosen.');
        }

        // Ambil semua jadwal dari mata kuliah yang diampu dosen ini
        $jadwals = Jadwal::whereHas('matakuliah', function ($query) use ($dosen) {
            $query->where('dosen_id', $dosen->id);
        })
        ->with(['matakuliah'])
        ->orderBy('tanggal')
        ->orderBy('jam_mulai')
        ->get();

        return view('dashboard.jadwal.index', compact('jadwals', 'dosen'));
    }

    public function create()
    {
        $user = Auth::user();
        $dosen = $user->dosen;

        if (!$dosen) {
            return redirect()->back()->with('error', 'Anda tidak memiliki akses sebagai dosen.');
        }

        // Ambil mata kuliah yang diampu dosen ini
        $matakuliahs = Matakuliah::where('dosen_id', $dosen->id)->get();

        if ($matakuliahs->isEmpty()) {
            return redirect()->route('jadwal.index')->with('error', 'Anda belum memiliki mata kuliah. Silakan hubungi admin.');
        }

        // Ambil semua mahasiswa untuk dipilih
        $mahasiswas = Mahasiswa::with('user')->get();

        return view('dashboard.jadwal.create', compact('matakuliahs', 'mahasiswas'));
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        $dosen = $user->dosen;

        if (!$dosen) {
            return redirect()->back()->with('error', 'Anda tidak memiliki akses sebagai dosen.');
        }

        $request->validate([
            'matakuliah_id' => 'required|exists:matakuliah,id',
            'tanggal' => 'required|date',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required|after:jam_mulai',
            'ruangan' => 'nullable|string|max:50',
            'mahasiswa_ids' => 'nullable|array',
            'mahasiswa_ids.*' => 'exists:mahasiswa,id',
        ]);

        // Pastikan mata kuliah yang dipilih adalah milik dosen yang login
        $matakuliah = Matakuliah::where('id', $request->matakuliah_id)
                                ->where('dosen_id', $dosen->id)
                                ->first();

        if (!$matakuliah) {
            return redirect()->back()->with('error', 'Mata kuliah tidak valid.');
        }

        // Cek konflik jadwal
        $konflik = Jadwal::whereHas('matakuliah', function ($query) use ($dosen) {
            $query->where('dosen_id', $dosen->id);
        })
        ->where('tanggal', $request->tanggal)
        ->where(function ($query) use ($request) {
            $query->where(function ($q) use ($request) {
                // Jadwal baru dimulai di tengah jadwal yang ada
                $q->where('jam_mulai', '<', $request->jam_mulai)
                  ->where('jam_selesai', '>', $request->jam_mulai);
            })
            ->orWhere(function ($q) use ($request) {
                // Jadwal baru berakhir di tengah jadwal yang ada
                $q->where('jam_mulai', '<', $request->jam_selesai)
                  ->where('jam_selesai', '>', $request->jam_selesai);
            })
            ->orWhere(function ($q) use ($request) {
                // Jadwal baru menutupi jadwal yang ada
                $q->where('jam_mulai', '>=', $request->jam_mulai)
                  ->where('jam_selesai', '<=', $request->jam_selesai);
            })
            ->orWhere(function ($q) use ($request) {
                // Jadwal yang ada menutupi jadwal baru
                $q->where('jam_mulai', '<=', $request->jam_mulai)
                  ->where('jam_selesai', '>=', $request->jam_selesai);
            });
        })
        ->exists();

        if ($konflik) {
            return redirect()->back()->with('error', 'Jadwal bertabrakan dengan jadwal yang sudah ada.')->withInput();
        }

        // Simpan jadwal
        $jadwal = Jadwal::create([
            'matakuliah_id' => $request->matakuliah_id,
            'tanggal' => $request->tanggal,
            'jam_mulai' => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai,
            'ruangan' => $request->ruangan,
        ]);

        // Assign mahasiswa ke jadwal jika ada yang dipilih
        if ($request->has('mahasiswa_ids') && is_array($request->mahasiswa_ids)) {
            $jadwal->mahasiswa()->sync($request->mahasiswa_ids);
        }

        return redirect()->route('jadwal.index')->with('success', 'Jadwal berhasil dibuat.');
    }    public function show(Jadwal $jadwal)
    {
        $user = Auth::user();
        $dosen = $user->dosen;

        // Pastikan jadwal ini milik dosen yang login
        if ($jadwal->matakuliah->dosen_id !== $dosen->id) {
            return redirect()->route('jadwal.index')->with('error', 'Anda tidak memiliki akses ke jadwal ini.');
        }        // Load relasi mahasiswa dengan user
        $jadwal->load(['mahasiswa.user']);

        return view('dashboard.jadwal.show', compact('jadwal'));
    }    public function edit(Jadwal $jadwal)
    {
        $user = Auth::user();
        $dosen = $user->dosen;

        // Pastikan jadwal ini milik dosen yang login
        if ($jadwal->matakuliah->dosen_id !== $dosen->id) {
            return redirect()->route('jadwal.index')->with('error', 'Anda tidak memiliki akses ke jadwal ini.');
        }

        $matakuliahs = Matakuliah::where('dosen_id', $dosen->id)->get();

        // Ambil semua mahasiswa untuk dipilih
        $mahasiswas = Mahasiswa::with('user')->get();

        // Ambil mahasiswa yang sudah terdaftar di jadwal ini
        $selectedMahasiswas = $jadwal->mahasiswa->pluck('id')->toArray();

        return view('dashboard.jadwal.edit', compact('jadwal', 'matakuliahs', 'mahasiswas', 'selectedMahasiswas'));
    }

    public function update(Request $request, Jadwal $jadwal)
    {
        $user = Auth::user();
        $dosen = $user->dosen;

        // Pastikan jadwal ini milik dosen yang login
        if ($jadwal->matakuliah->dosen_id !== $dosen->id) {
            return redirect()->route('jadwal.index')->with('error', 'Anda tidak memiliki akses ke jadwal ini.');
        }        
        
        $request->validate([
            'matakuliah_id' => 'required|exists:matakuliah,id',
            'tanggal' => 'required|date',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required|after:jam_mulai',
            'ruangan' => 'nullable|string|max:50',
            'mahasiswa_ids' => 'nullable|array',
            'mahasiswa_ids.*' => 'exists:mahasiswa,id',
        ]);

        // Pastikan mata kuliah yang dipilih adalah milik dosen yang login
        $matakuliah = Matakuliah::where('id', $request->matakuliah_id)
                                ->where('dosen_id', $dosen->id)
                                ->first();

        if (!$matakuliah) {
            return redirect()->back()->with('error', 'Mata kuliah tidak valid.');
        }

        // Cek konflik jadwal (kecuali jadwal yang sedang diedit)
        // Hanya cek konflik jika jadwal benar-benar berubah
        $isScheduleChanged = (
            $jadwal->tanggal != $request->tanggal ||
            $jadwal->jam_mulai != $request->jam_mulai ||
            $jadwal->jam_selesai != $request->jam_selesai
        );

        if ($isScheduleChanged) {
            $konflik = Jadwal::whereHas('matakuliah', function ($query) use ($dosen) {
                $query->where('dosen_id', $dosen->id);
            })
            ->where('id', '!=', $jadwal->id)
            ->where('tanggal', $request->tanggal)
            ->where(function ($query) use ($request) {
                $query->where(function ($q) use ($request) {
                    // Jadwal baru dimulai di tengah jadwal yang ada
                    $q->where('jam_mulai', '<', $request->jam_mulai)
                      ->where('jam_selesai', '>', $request->jam_mulai);
                })
                ->orWhere(function ($q) use ($request) {
                    // Jadwal baru berakhir di tengah jadwal yang ada
                    $q->where('jam_mulai', '<', $request->jam_selesai)
                      ->where('jam_selesai', '>', $request->jam_selesai);
                })
                ->orWhere(function ($q) use ($request) {
                    // Jadwal baru menutupi jadwal yang ada
                    $q->where('jam_mulai', '>=', $request->jam_mulai)
                      ->where('jam_selesai', '<=', $request->jam_selesai);
                })
                ->orWhere(function ($q) use ($request) {
                    // Jadwal yang ada menutupi jadwal baru
                    $q->where('jam_mulai', '<=', $request->jam_mulai)
                      ->where('jam_selesai', '>=', $request->jam_selesai);
                });
            })
            ->exists();

            if ($konflik) {
                return redirect()->back()->with('error', 'Jadwal bertabrakan dengan jadwal yang sudah ada.')->withInput();
            }
        }        $jadwal->update([
            'matakuliah_id' => $request->matakuliah_id,
            'tanggal' => $request->tanggal,
            'jam_mulai' => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai,
            'ruangan' => $request->ruangan,
        ]);

        // Update mahasiswa assignment
        if ($request->has('mahasiswa_ids') && is_array($request->mahasiswa_ids)) {
            $jadwal->mahasiswa()->sync($request->mahasiswa_ids);
        } else {
            // Jika tidak ada mahasiswa yang dipilih, hapus semua assignment
            $jadwal->mahasiswa()->sync([]);
        }

        return redirect()->route('jadwal.show', $jadwal)->with('success', 'Jadwal berhasil diupdate.');
    }

    public function destroy(Jadwal $jadwal)
    {
        $user = Auth::user();
        $dosen = $user->dosen;

        // Pastikan jadwal ini milik dosen yang login
        if ($jadwal->matakuliah->dosen_id !== $dosen->id) {
            return redirect()->route('jadwal.index')->with('error', 'Anda tidak memiliki akses ke jadwal ini.');
        }

        $jadwal->delete();

        return redirect()->route('jadwal.index')->with('success', 'Jadwal berhasil dihapus.');
    }
}
