@extends('dashboard.layout.index')

@section('content')
<div class="container mx-auto">
    <!-- Header -->
    <div class="bg-white rounded-lg shadow-md p-6 mb-6">
        <div class="flex items-center justify-between">
            <div class="flex items-center">
                <a href="{{ route('jadwal.show', $qrcode->jadwal) }}" class="mr-4 text-gray-600 hover:text-gray-800">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                </a>
                <div>
                    <h1 class="text-2xl font-bold text-gray-800">QR Code Absensi</h1>
                    <p class="text-gray-600 mt-1">{{ $qrcode->jadwal->matakuliah->nama }}</p>
                </div>
            </div>
            <div class="flex space-x-2">
                <a href="{{ route('qrcode.generate', $qrcode->jadwal) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg">
                    <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    QR Baru
                </a>
                <form action="{{ route('qrcode.destroy', $qrcode) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus QR Code ini?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-lg">
                        <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                        </svg>
                        Hapus
                    </button>
                </form>
            </div>
        </div>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            {{ session('error') }}
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- QR Code Display -->
        <div class="lg:col-span-2 bg-white rounded-lg shadow-md p-6">
            <div class="text-center">                <!-- Status QR Code -->
                <div class="mb-6 qr-status">
                    @if(now() > $qrcode->expired_at)
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg">
                            <div class="flex items-center justify-center">
                                <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5C3.312 18.333 4.274 20 5.814 20z"></path>
                                </svg>
                                <span class="font-semibold">QR Code Expired</span>
                            </div>
                            <p class="mt-2">QR Code ini sudah tidak dapat digunakan. Silakan buat QR Code baru.</p>
                        </div>
                    @else
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg">
                            <div class="flex items-center justify-center">
                                <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <span class="font-semibold">QR Code Aktif</span>
                            </div>
                            <p class="mt-2">QR Code siap digunakan untuk absensi mahasiswa.</p>
                        </div>
                    @endif
                </div>                <!-- QR Code Image -->
                <div class="mb-6">
                    <div class="bg-white border-2 border-gray-300 rounded-lg p-8 inline-block">
                        <!-- Using Bacon QR Code -->
                        <div class="w-72 h-72 flex items-center justify-center">
                            @if(now() <= $qrcode->expired_at)
                                <iframe 
                                    src="{{ route('qrcode.svg', $qrcode) }}" 
                                    width="300" 
                                    height="300" 
                                    frameborder="0"
                                    id="qrcode-frame">
                                </iframe>
                            @else
                                <div class="text-center text-gray-500">
                                    <svg class="w-24 h-24 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5C3.312 18.333 4.274 20 5.814 20z"></path>
                                    </svg>
                                    <p>QR Code Expired</p>
                                </div>
                            @endif
                        </div>
                    </div>
                    
                    <!-- Manual Code Display -->
                    @if(now() <= $qrcode->expired_at)                        <div class="mt-4 bg-blue-50 border-2 border-blue-200 rounded-lg p-4">
                            <p class="text-sm font-medium text-blue-800 mb-2">Kode Manual untuk Input:</p>
                            <div class="bg-white rounded-lg p-4 border border-blue-300">
                                <p class="font-mono text-4xl font-bold text-center text-blue-900 tracking-widest">
                                    {{ $qrcode->kode_qr }}
                                </p>
                                <p class="text-center text-sm text-blue-600 mt-2">Mahasiswa dapat mengetik kode ini di halaman scan</p>
                            </div>
                        </div>
                    @endif
                </div>

                <!-- QR Code URL -->
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">URL Absensi:</label>                    <div class="flex items-center space-x-2">
                        <input 
                            type="text" 
                            value="{{ url('/absensi/' . $qrcode->kode_qr) }}" 
                            class="flex-1 px-3 py-2 border border-gray-300 rounded-lg bg-gray-50" 
                            readonly
                            id="qr-url"
                        >
                        <button 
                            onclick="copyToClipboard()" 
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg"
                        >
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Download/Print Actions -->
                <div class="flex justify-center space-x-4">
                    <button 
                        onclick="downloadQR()" 
                        class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-lg"
                    >
                        <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        Download
                    </button>
                    <button 
                        onclick="printQR()" 
                        class="bg-purple-500 hover:bg-purple-700 text-white font-bold py-2 px-4 rounded-lg"
                    >
                        <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path>
                        </svg>
                        Print
                    </button>
                </div>
            </div>
        </div>

        <!-- Info Sidebar -->
        <div class="space-y-6">
            <!-- QR Code Info -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <h3 class="text-lg font-bold text-gray-800 mb-4">Informasi QR Code</h3>
                <div class="space-y-3">
                    <div>
                        <span class="text-sm text-gray-600">Dibuat:</span>
                        <p class="font-medium text-gray-900">{{ $qrcode->created_at->format('d/m/Y H:i') }}</p>
                    </div>
                    <div>
                        <span class="text-sm text-gray-600">Expired:</span>
                        <p class="font-medium text-gray-900">{{ $qrcode->expired_at->format('d/m/Y H:i') }}</p>
                    </div>
                    <div>
                        <span class="text-sm text-gray-600">Status:</span>
                        @if(now() > $qrcode->expired_at)
                            <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">
                                Expired
                            </span>
                        @else
                            <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                Aktif
                            </span>
                        @endif
                    </div>                    <div>
                        <span class="text-sm text-gray-600">Kode:</span>
                        <p class="font-mono text-2xl font-bold text-gray-900 tracking-widest">
                            {{ $qrcode->kode_qr }}
                        </p>
                        <p class="text-xs text-gray-500 mt-1">4 Huruf + 4 Angka (tanpa spasi)</p>
                    </div>
                </div>
            </div>

            <!-- Schedule Info -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <h3 class="text-lg font-bold text-gray-800 mb-4">Detail Jadwal</h3>
                <div class="space-y-3">
                    <div>
                        <span class="text-sm text-gray-600">Mata Kuliah:</span>
                        <p class="font-medium text-gray-900">{{ $qrcode->jadwal->matakuliah->nama }}</p>
                    </div>
                    <div>
                        <span class="text-sm text-gray-600">Kode:</span>
                        <p class="font-medium text-gray-900">{{ $qrcode->jadwal->matakuliah->kode }}</p>
                    </div>                    <div>
                        <span class="text-sm text-gray-600">Tanggal:</span>
                        <p class="font-medium text-gray-900">{{ $qrcode->jadwal->tanggal ? $qrcode->jadwal->tanggal->format('d/m/Y') . ' (' . $qrcode->jadwal->tanggal->format('l') . ')' : 'Belum diatur' }}</p>
                    </div>
                    <div>
                        <span class="text-sm text-gray-600">Waktu:</span>
                        <p class="font-medium text-gray-900">
                            {{ date('H:i', strtotime($qrcode->jadwal->jam_mulai)) }} - {{ date('H:i', strtotime($qrcode->jadwal->jam_selesai)) }}
                        </p>
                    </div>
                    <div>
                        <span class="text-sm text-gray-600">Ruangan:</span>
                        <p class="font-medium text-gray-900">{{ $qrcode->jadwal->ruangan ?: 'Tidak ditentukan' }}</p>
                    </div>
                </div>
            </div>

            <!-- Countdown Timer -->
            @if(now() < $qrcode->expired_at)
                <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-6">
                    <h3 class="text-lg font-bold text-yellow-800 mb-4">Countdown</h3>
                    <div id="countdown" class="text-center">
                        <div class="text-2xl font-bold text-yellow-900" id="countdown-timer">
                            Menghitung...
                        </div>
                        <p class="text-sm text-yellow-700 mt-2">Waktu tersisa sebelum expired</p>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>

<script>
    function copyToClipboard() {
        const urlInput = document.getElementById('qr-url');
        urlInput.select();
        urlInput.setSelectionRange(0, 99999);
        navigator.clipboard.writeText(urlInput.value);
        
        // Show feedback
        alert('URL berhasil disalin ke clipboard!');
    }    function downloadQR() {
        @if(now() <= $qrcode->expired_at)
            // Create a link to download the SVG
            const link = document.createElement('a');
            link.href = '{{ route("qrcode.svg", $qrcode) }}';
            link.download = 'qrcode_{{ $qrcode->jadwal->matakuliah->kode }}_{{ $qrcode->created_at->format("Y-m-d_H-i") }}.svg';
            link.click();
        @else
            alert('QR Code sudah expired, tidak dapat didownload.');
        @endif
    }

    function printQR() {
        @if(now() <= $qrcode->expired_at)
            const printWindow = window.open('', '', 'height=600,width=800');
            
            printWindow.document.write('<html><head><title>QR Code - {{ $qrcode->jadwal->matakuliah->nama }}</title></head><body style="text-align: center; padding: 20px;">');
            printWindow.document.write('<h2>{{ $qrcode->jadwal->matakuliah->nama }}</h2>');
            printWindow.document.write('<p>{{ $qrcode->jadwal->tanggal ? $qrcode->jadwal->tanggal->format("d/m/Y") . " (" . $qrcode->jadwal->tanggal->format("l") . ")" : "Belum diatur" }}, {{ date("H:i", strtotime($qrcode->jadwal->jam_mulai)) }} - {{ date("H:i", strtotime($qrcode->jadwal->jam_selesai)) }}</p>');
            printWindow.document.write('<p>Ruangan: {{ $qrcode->jadwal->ruangan ?: "Tidak ditentukan" }}</p>');
            printWindow.document.write('<iframe src="{{ route("qrcode.svg", $qrcode) }}" width="300" height="300" frameborder="0"></iframe>');
            printWindow.document.write('<p style="margin-top: 20px; font-size: 12px;">Expired: {{ $qrcode->expired_at->format("d/m/Y H:i") }}</p>');
            printWindow.document.write('<p style="font-size: 10px;">URL: {{ url("/absensi/" . $qrcode->kode_qr) }}</p>');
            printWindow.document.write('</body></html>');
            
            printWindow.document.close();
            printWindow.focus();
            setTimeout(() => {
                printWindow.print();
                printWindow.close();
            }, 1000);
        @else
            alert('QR Code sudah expired, tidak dapat diprint.');
        @endif
    }    @if(now() < $qrcode->expired_at)
        // Countdown timer
        let countdownInterval;
        
        function updateCountdown() {
            // Convert expired time to UTC timestamp
            const expiredTime = new Date('{{ $qrcode->expired_at->utc()->format("Y-m-d\TH:i:s\Z") }}').getTime();
            const now = new Date().getTime();
            const timeLeft = expiredTime - now;

            if (timeLeft > 0) {
                const hours = Math.floor(timeLeft / (1000 * 60 * 60));
                const minutes = Math.floor((timeLeft % (1000 * 60 * 60)) / (1000 * 60));
                const seconds = Math.floor((timeLeft % (1000 * 60)) / 1000);

                const countdownElement = document.getElementById('countdown-timer');
                if (countdownElement) {
                    countdownElement.innerHTML = 
                        hours.toString().padStart(2, '0') + ':' + 
                        minutes.toString().padStart(2, '0') + ':' + 
                        seconds.toString().padStart(2, '0');
                }
            } else {
                const countdownElement = document.getElementById('countdown-timer');
                if (countdownElement) {
                    countdownElement.innerHTML = 'EXPIRED';
                }
                
                // Stop the interval
                if (countdownInterval) {
                    clearInterval(countdownInterval);
                }
                
                // Show expired status without auto refresh
                const statusElements = document.querySelectorAll('.qr-status');
                statusElements.forEach(element => {
                    element.innerHTML = '<div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg"><div class="flex items-center justify-center"><svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5C3.312 18.333 4.274 20 5.814 20z"></path></svg><span class="font-semibold">QR Code Expired</span></div><p class="mt-2">QR Code ini sudah tidak dapat digunakan. Silakan buat QR Code baru.</p></div>';
                });
            }
        }

        // Update countdown every second
        countdownInterval = setInterval(updateCountdown, 1000);
        updateCountdown(); // Initial call
    @endif
</script>
@endsection
