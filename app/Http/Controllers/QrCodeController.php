<?php

namespace App\Http\Controllers;

use App\Models\QrCode;
use App\Models\Jadwal;
use App\Models\Dosen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Routing\Controller;
use Carbon\Carbon;
use BaconQrCode\Renderer\ImageRenderer;
use BaconQrCode\Renderer\Image\SvgImageBackEnd;
use BaconQrCode\Renderer\RendererStyle\RendererStyle;
use BaconQrCode\Writer;

class QrCodeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Generate QR Code untuk jadwal tertentu
     */
    public function generate(Jadwal $jadwal)
    {
        $user = Auth::user();
        $dosen = $user->dosen;

        if (!$dosen) {
            return redirect()->back()->with('error', 'Anda tidak memiliki akses sebagai dosen.');
        }

        // Pastikan jadwal ini milik dosen yang login
        if ($jadwal->matakuliah->dosen_id !== $dosen->id) {
            return redirect()->back()->with('error', 'Anda tidak memiliki akses ke jadwal ini.');
        }

        return view('dashboard.qrcode.generate', compact('jadwal', 'dosen'));
    }

    /**
     * Store QR Code baru
     */
    public function store(Request $request, Jadwal $jadwal)
    {
        $user = Auth::user();
        $dosen = $user->dosen;

        if (!$dosen) {
            return redirect()->back()->with('error', 'Anda tidak memiliki akses sebagai dosen.');
        }

        // Pastikan jadwal ini milik dosen yang login
        if ($jadwal->matakuliah->dosen_id !== $dosen->id) {
            return redirect()->back()->with('error', 'Anda tidak memiliki akses ke jadwal ini.');
        }        $request->validate([
            'expired_minutes' => 'required|integer|min:5|max:180',
        ]);        // Generate unique 8-character code (4 letters + 4 numbers)
        do {
            // Generate 4 random uppercase letters only
            $letters = '';
            for ($i = 0; $i < 4; $i++) {
                $letters .= chr(rand(65, 90)); // A-Z
            }
            
            // Generate 4 random numbers
            $numbers = str_pad(rand(0, 9999), 4, '0', STR_PAD_LEFT);
            $code = $letters . $numbers;
        } while (QrCode::where('kode_qr', $code)->exists()); // Ensure uniqueness
        
        // Calculate expiry time
        $expiredAt = Carbon::now()->addMinutes((int) $request->expired_minutes);

        // Create QR Code record
        $qrCode = QrCode::create([
            'jadwal_id' => $jadwal->id,
            'kode_qr' => $code,
            'expired_at' => $expiredAt,
        ]);

        return redirect()->route('qrcode.show', $qrCode)->with('success', 'QR Code berhasil dibuat!');
    }

    /**
     * Show QR Code
     */
    public function show(QrCode $qrcode)
    {
        $user = Auth::user();
        $dosen = $user->dosen;

        if (!$dosen) {
            return redirect()->back()->with('error', 'Anda tidak memiliki akses sebagai dosen.');
        }

        // Pastikan QR Code ini milik dosen yang login
        if ($qrcode->jadwal->matakuliah->dosen_id !== $dosen->id) {
            return redirect()->back()->with('error', 'Anda tidak memiliki akses ke QR Code ini.');
        }

        return view('dashboard.qrcode.show', compact('qrcode', 'dosen'));
    }

    /**
     * List all QR Codes for a schedule
     */
    public function index(Jadwal $jadwal)
    {
        $user = Auth::user();
        $dosen = $user->dosen;

        if (!$dosen) {
            return redirect()->back()->with('error', 'Anda tidak memiliki akses sebagai dosen.');
        }

        // Pastikan jadwal ini milik dosen yang login
        if ($jadwal->matakuliah->dosen_id !== $dosen->id) {
            return redirect()->back()->with('error', 'Anda tidak memiliki akses ke jadwal ini.');
        }

        $qrcodes = $jadwal->qrcodes()->orderBy('created_at', 'desc')->get();

        return view('dashboard.qrcode.index', compact('jadwal', 'qrcodes', 'dosen'));
    }

    /**
     * Delete QR Code
     */
    public function destroy(QrCode $qrcode)
    {
        $user = Auth::user();
        $dosen = $user->dosen;

        if (!$dosen) {
            return redirect()->back()->with('error', 'Anda tidak memiliki akses sebagai dosen.');
        }

        // Pastikan QR Code ini milik dosen yang login
        if ($qrcode->jadwal->matakuliah->dosen_id !== $dosen->id) {
            return redirect()->back()->with('error', 'Anda tidak memiliki akses ke QR Code ini.');
        }

        $jadwal = $qrcode->jadwal;
        $qrcode->delete();

        return redirect()->route('qrcode.index', $jadwal)->with('success', 'QR Code berhasil dihapus.');
    }

    /**
     * Generate QR Code SVG
     */
    public function generateQrSvg(QrCode $qrcode)
    {
        $user = Auth::user();
        $dosen = $user->dosen;

        if (!$dosen) {
            return response('Unauthorized', 401);
        }

        // Pastikan QR Code ini milik dosen yang login
        if ($qrcode->jadwal->matakuliah->dosen_id !== $dosen->id) {
            return response('Unauthorized', 401);
        }        // Generate QR Code URL
        $url = url('/absensi/' . $qrcode->kode_qr);

        // Create QR Code
        $renderer = new ImageRenderer(
            new RendererStyle(300),
            new SvgImageBackEnd()
        );
        $writer = new Writer($renderer);
        
        $qrCodeSvg = $writer->writeString($url);

        return response($qrCodeSvg, 200)
            ->header('Content-Type', 'image/svg+xml')
            ->header('Cache-Control', 'no-cache, no-store, must-revalidate')
            ->header('Pragma', 'no-cache')
            ->header('Expires', '0');
    }
}
