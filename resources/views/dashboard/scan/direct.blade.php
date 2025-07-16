@extends('dashboard.layout.index')

@section('content')
<div class="container mx-auto max-w-2xl">
    <!-- Header -->
    <div class="bg-white rounded-lg shadow-md p-6 mb-6">
        <div class="text-center">
            <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path>
                </svg>
            </div>
            <h1 class="text-2xl font-bold text-gray-800">QR Code Absensi</h1>
            <p class="text-gray-600 mt-1">Verifikasi Kehadiran</p>
        </div>
    </div>

    <!-- QR Code Info -->
    <div class="bg-gray-50 rounded-lg p-4 mb-6">
        <div class="text-center">
            <p class="text-sm text-gray-600">Kode QR:</p>
            <p class="font-mono text-2xl font-bold text-gray-900 tracking-widest">
                {{ substr($code, 0, 4) }} {{ substr($code, 4, 4) }}
            </p>
        </div>
    </div>

    @if(isset($error))
        <!-- Error State -->
        <div class="bg-red-100 border border-red-400 text-red-700 rounded-lg p-6 mb-6">
            <div class="flex items-center mb-4">
                <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5C3.312 18.333 4.274 20 5.814 20z"></path>
                </svg>
                <span class="font-semibold">Gagal Melakukan Absensi</span>
            </div>
            <p class="mb-4">{{ $error }}</p>
            
            @if(isset($jadwal))
                <div class="bg-white rounded-lg p-4 border border-red-300">
                    <h4 class="font-semibold text-red-800 mb-2">Informasi Jadwal:</h4>
                    <div class="text-sm space-y-1">
                        <p><strong>Mata Kuliah:</strong> {{ $jadwal->matakuliah->nama }}</p>
                        <p><strong>Tanggal:</strong> {{ $jadwal->tanggal ? $jadwal->tanggal->format('d/m/Y') . ' (' . $jadwal->tanggal->format('l') . ')' : 'Belum diatur' }}</p>
                        <p><strong>Waktu:</strong> {{ $jadwal->jam_mulai }} - {{ $jadwal->jam_selesai }}</p>
                        <p><strong>Ruangan:</strong> {{ $jadwal->ruangan ?: 'Tidak ditentukan' }}</p>
                    </div>
                </div>
            @endif
        </div>
        
        <div class="text-center space-y-3">
            <a href="{{ route('dashboard') }}" class="block w-full bg-gray-500 hover:bg-gray-700 text-white font-bold py-3 px-4 rounded-lg">
                Kembali ke Dashboard
            </a>
            @auth
                @if(auth()->user()->role === 'mahasiswa')
                    <a href="{{ route('scan.index') }}" class="block w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-3 px-4 rounded-lg">
                        Coba Scan Lagi
                    </a>
                @endif
            @endauth
        </div>

    @elseif(isset($success) && $success)
        <!-- Success State - Confirmation -->
        <div class="bg-green-100 border border-green-400 text-green-700 rounded-lg p-6 mb-6">
            <div class="flex items-center mb-4">
                <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <span class="font-semibold">QR Code Valid</span>
            </div>
            <p class="mb-4">Konfirmasi untuk melakukan absensi pada jadwal berikut:</p>
            
            <div class="bg-white rounded-lg p-4 border border-green-300 mb-4">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                    <div>
                        <p class="text-gray-600">Mahasiswa:</p>
                        <p class="font-semibold">{{ $mahasiswa->user->name }}</p>
                        <p class="text-gray-500">{{ $mahasiswa->nim }}</p>
                    </div>
                    <div>
                        <p class="text-gray-600">Kelas:</p>
                        <p class="font-semibold">{{ $mahasiswa->kelas }}</p>
                    </div>
                    <div>
                        <p class="text-gray-600">Mata Kuliah:</p>
                        <p class="font-semibold">{{ $jadwal->matakuliah->nama }}</p>
                        <p class="text-gray-500">{{ $jadwal->matakuliah->kode }}</p>
                    </div>
                    <div>
                        <p class="text-gray-600">Dosen:</p>
                        <p class="font-semibold">{{ $jadwal->matakuliah->dosen->user->name }}</p>
                    </div>                    <div>
                        <p class="text-gray-600">Tanggal & Waktu:</p>
                        <p class="font-semibold">{{ $jadwal->tanggal ? $jadwal->tanggal->format('d/m/Y') . ' (' . $jadwal->tanggal->format('l') . ')' : 'Belum diatur' }}</p>
                        <p class="text-gray-500">{{ $jadwal->jam_mulai }} - {{ $jadwal->jam_selesai }}</p>
                    </div>
                    <div>
                        <p class="text-gray-600">Ruangan:</p>
                        <p class="font-semibold">{{ $jadwal->ruangan ?: 'Tidak ditentukan' }}</p>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Confirmation Buttons -->
        <div class="space-y-3">
            <form action="{{ route('scan.process') }}" method="POST" class="w-full">
                @csrf
                <input type="hidden" name="qr_code" value="{{ $code }}">
                <button type="submit" class="w-full bg-green-500 hover:bg-green-700 text-white font-bold py-4 px-4 rounded-lg text-lg">
                    <span class="flex items-center justify-center">
                        <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Konfirmasi Absensi
                    </span>
                </button>
            </form>
            
            <a href="{{ route('dashboard') }}" class="block w-full bg-gray-500 hover:bg-gray-700 text-white font-bold py-3 px-4 rounded-lg text-center">
                Batal
            </a>
        </div>
    @endif

    <!-- Instructions -->
    <div class="mt-8 bg-blue-50 border border-blue-200 rounded-lg p-4">
        <h3 class="font-semibold text-blue-800 mb-2">Catatan:</h3>
        <ul class="text-blue-700 text-sm space-y-1">
            <li>• Pastikan Anda sudah login sebagai mahasiswa</li>
            <li>• QR Code hanya berlaku selama waktu yang ditentukan dosen</li>
            <li>• Setiap mahasiswa hanya bisa absen sekali per hari per jadwal</li>
            <li>• Pastikan Anda terdaftar di jadwal yang bersangkutan</li>
        </ul>
    </div>
</div>

@if(isset($success) && $success)
<script>
// Handle form submission with loading state
document.querySelector('form').addEventListener('submit', function(e) {
    const button = this.querySelector('button[type="submit"]');
    button.disabled = true;
    button.innerHTML = '<span class="flex items-center justify-center"><svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>Memproses...</span>';
});
</script>
@endif
@endsection
