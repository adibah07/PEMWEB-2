<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Dosen;
use Illuminate\Routing\Controller;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }

        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials, $request->filled('remember'))) {
            $request->session()->regenerate();

            // Redirect ke dashboard setelah login berhasil
            return redirect()->intended(route('dashboard'))->with('success', 'Login berhasil!');
        }

        return back()->withErrors([
            'email' => 'Email atau password tidak valid.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Arahkan ke landing page
        return redirect('/')->with('success', 'Logout berhasil!');
    }

    public function dashboard()
    {
        $user = Auth::user();

        // Cek apakah user adalah dosen
        $dosen = Dosen::where('user_id', $user->id)->first();

        if ($dosen) {
            // Statistik untuk dosen
            $totalMatakuliah = $dosen->matakuliah()->count();
            $totalJadwal = $dosen->matakuliah()->with('jadwal')->get()->sum(function($mk) {
                return $mk->jadwal->count();
            });
            $jadwalHariIni = $dosen->matakuliah()
                ->with(['jadwal' => function($query) {
                    $query->whereDate('tanggal', today());
                }])
                ->get()
                ->flatMap(function($mk) {
                    return $mk->jadwal;
                })
                ->count();

            return view('dashboard.dashboard', compact('user', 'dosen', 'totalMatakuliah', 'totalJadwal', 'jadwalHariIni'));
        }

        // Jika bukan dosen, tampilkan dashboard umum
        return view('dashboard.dashboard', compact('user'));
    }
}
