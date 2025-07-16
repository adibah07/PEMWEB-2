@extends('dashboard.layout.index')

@section('content')
<div class="container mx-auto">
    <!-- Header -->
    <div class="bg-white rounded-lg shadow-md p-6 mb-6">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Scan Absen</h1>
                <p class="text-gray-600 mt-1">Scan QR Code untuk melakukan absensi</p>
                <p class="text-sm text-gray-500 mt-1">
                    Mahasiswa: <span class="font-semibold">{{ $mahasiswa->user->name }}</span> | 
                    NIM: <span class="font-semibold">{{ $mahasiswa->nim }}</span> |
                    Kelas: <span class="font-semibold">{{ $mahasiswa->kelas }}</span>
                </p>
            </div>
            <div class="flex items-center space-x-2">
                <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path>
                </svg>
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

    <!-- Alert untuk hasil scan -->
    <div id="scanResult" class="hidden mb-4"></div>

    <!-- Warning untuk HTTPS -->
    <div class="bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3 rounded mb-4">
        <div class="flex items-center">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
            </svg>
            <div>
                <strong>Info:</strong> Jika kamera tidak bisa diakses, gunakan <strong>Input Manual</strong> di bawah untuk memasukkan kode QR.
            </div>
        </div>
    </div>

    <!-- Scan QR Code Section -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Scanner -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <h2 class="text-lg font-bold text-gray-800 mb-4">Scanner QR Code</h2>
            
            <!-- Camera Preview -->
            <div class="relative bg-gray-100 rounded-lg mb-4">
                <div id="reader" class="w-full min-h-64 rounded-lg"></div>
            </div>

            <!-- Scanner Controls -->
            <div class="flex space-x-2 mb-4">
                <button id="startScanner" class="flex-1 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h1m4 0h1m-6 4h8m-7-9V3a1 1 0 011-1h4a1 1 0 011 1v2M7 21h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    Mulai Scan
                </button>
                <button id="stopScanner" class="flex-1 bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded hidden">
                    <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 10a1 1 0 011-1h4a1 1 0 011 1v4a1 1 0 01-1 1h-4a1 1 0 01-1-1v-4z"></path>
                    </svg>
                    Stop Scan
                </button>
            </div>

            <!-- Manual Input -->
            <div class="border-t pt-4">
                <h3 class="text-md font-semibold text-gray-700 mb-3 flex items-center">
                    <span class="text-xl mr-2">✏️</span>
                    Input Manual QR Code
                </h3>
                
                <form id="manualForm" class="space-y-4">
                    @csrf
                    <div>
                        <label for="qrCodeInput" class="block text-sm font-medium text-gray-700 mb-2">
                            Masukkan Kode QR (8 Karakter):
                        </label>
                        
                        <div class="relative">
                            <input type="text" 
                                   id="qrCodeInput" 
                                   name="qr_code"
                                   class="w-full h-16 text-center text-3xl font-bold border-2 border-blue-300 rounded-lg focus:border-blue-500 focus:outline-none bg-blue-50 uppercase tracking-widest" 
                                   placeholder="ABCD1234"
                                   maxlength="8"
                                   pattern="[A-Z]{4}[0-9]{4}">
                        </div>
                    </div>
                    
                    <button type="submit" 
                            id="submitBtn"
                            class="w-full bg-gradient-to-r from-green-500 to-green-600 hover:from-green-600 hover:to-green-700 text-white font-bold py-4 px-4 rounded-lg text-lg transition-all duration-200 transform hover:scale-105 disabled:opacity-50 disabled:cursor-not-allowed disabled:transform-none"
                            disabled>
                        <span class="flex items-center justify-center">
                            <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Submit Absensi
                        </span>
                    </button>
                </form>
                
                <!-- Contoh visual -->
                <div class="mt-4 p-3 bg-gray-50 border border-gray-200 rounded-lg">
                    <p class="text-xs font-medium text-gray-600 mb-2">💡 Contoh kode yang benar:</p>
                    <div class="flex justify-center">
                        <div class="inline-flex items-center">
                            <span class="bg-blue-100 border border-blue-300 px-3 py-2 rounded font-mono text-blue-800 text-lg font-bold tracking-widest">MTKL8264</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Informasi dan Panduan -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <h2 class="text-lg font-bold text-gray-800 mb-4">Panduan Scan Absen</h2>
            
            <div class="space-y-4">
                <div class="flex items-start space-x-3">
                    <div class="flex-shrink-0 w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center">
                        <span class="text-blue-600 font-bold text-sm">1</span>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-800">Klik "Mulai Scan"</h3>
                        <p class="text-gray-600 text-sm">Izinkan akses kamera untuk memulai scanning</p>
                    </div>
                </div>

                <div class="flex items-start space-x-3">
                    <div class="flex-shrink-0 w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center">
                        <span class="text-blue-600 font-bold text-sm">2</span>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-800">Arahkan Kamera</h3>
                        <p class="text-gray-600 text-sm">Arahkan kamera ke QR Code yang ditampilkan dosen</p>
                    </div>
                </div>

                <div class="flex items-start space-x-3">
                    <div class="flex-shrink-0 w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center">
                        <span class="text-blue-600 font-bold text-sm">3</span>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-800">Scan Otomatis</h3>
                        <p class="text-gray-600 text-sm">Sistem akan mendeteksi QR Code secara otomatis</p>
                    </div>
                </div>

                <div class="flex items-start space-x-3">
                    <div class="flex-shrink-0 w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center">
                        <span class="text-blue-600 font-bold text-sm">4</span>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-800">Konfirmasi Absensi</h3>
                        <p class="text-gray-600 text-sm">Tunggu konfirmasi bahwa absensi berhasil dicatat</p>
                    </div>
                </div>
            </div>

            <!-- Status Info -->
            <div class="mt-6 p-4 bg-yellow-50 border border-yellow-200 rounded-lg">
                <h3 class="font-semibold text-yellow-800 mb-2">Catatan Penting:</h3>
                <ul class="text-yellow-700 text-sm space-y-1">
                    <li>• QR Code hanya valid selama waktu yang ditentukan dosen</li>
                    <li>• Pastikan Anda terdaftar di jadwal yang bersangkutan</li>
                    <li>• Setiap mahasiswa hanya bisa absen sekali per hari per jadwal</li>
                    <li>• Gunakan input manual jika kamera tidak berfungsi</li>
                </ul>
            </div>

            <!-- Quick Actions -->
            <div class="mt-6">
                <h3 class="font-semibold text-gray-800 mb-3">Aksi Cepat</h3>
                <div class="space-y-2">
                    <a href="{{ route('mahasiswa.absensi') }}" 
                       class="w-full bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded text-center block">
                        Lihat Riwayat Absensi
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Include QR Scanner Library -->
<script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>

<script>
let html5QrcodeScanner;
let scannerStarted = false;

document.addEventListener('DOMContentLoaded', function() {
    // Wait for library to load
    function waitForLib() {
        if (typeof Html5QrcodeScanner !== 'undefined') {
            initializeApp();
        } else {
            setTimeout(waitForLib, 100);
        }
    }
    waitForLib();
});

function initializeApp() {
    console.log('Initializing QR Scanner App...');
    
    const startBtn = document.getElementById('startScanner');
    const stopBtn = document.getElementById('stopScanner');
    const manualForm = document.getElementById('manualForm');
    const inputElement = document.getElementById('qrCodeInput');

    // Start Scanner
    startBtn.addEventListener('click', startScanner);
    
    // Stop Scanner
    stopBtn.addEventListener('click', stopScanner);

    // Manual Form Submit
    manualForm.addEventListener('submit', function(e) {
        e.preventDefault();
        const qrCode = inputElement.value.trim().toUpperCase();
        
        if (qrCode.length === 8 && /^[A-Z]{4}[0-9]{4}$/.test(qrCode)) {
            processQrCode(qrCode);
        } else {
            showAlert('error', 'Format kode QR tidak valid. Harus 4 huruf + 4 angka.');
        }
    });

    // Input validation
    inputElement.addEventListener('input', function(e) {
        let value = e.target.value.toUpperCase().replace(/[^A-Z0-9]/g, '');
        
        if (value.length > 0) {
            let letters = value.substring(0, 4).replace(/[^A-Z]/g, '');
            let remaining = value.substring(letters.length);
            let numbers = remaining.replace(/[^0-9]/g, '').substring(0, 4);
            value = letters + numbers;
        }
        
        if (value.length > 8) {
            value = value.substring(0, 8);
        }
        
        e.target.value = value;
        validateInput();
    });

    // Multiple validation triggers
    inputElement.addEventListener('keyup', validateInput);
    inputElement.addEventListener('change', validateInput);
    inputElement.addEventListener('blur', validateInput);

    validateInput(); // Initial check
}

function startScanner() {
    if (scannerStarted) return;
    
    console.log('Starting QR Scanner...');
    
    const readerDiv = document.getElementById('reader');
    const startBtn = document.getElementById('startScanner');
    const stopBtn = document.getElementById('stopScanner');
    
    // Clear any existing content
    readerDiv.innerHTML = '';
    
    html5QrcodeScanner = new Html5QrcodeScanner(
        "reader",
        { 
            fps: 10, 
            qrbox: { width: 250, height: 250 }
        },
        false
    );
    
    html5QrcodeScanner.render(
        function(decodedText, decodedResult) {
            console.log('QR Code detected:', decodedText);
            processQrCode(decodedText);
            stopScanner();
        },
        function(errorMessage) {
            // Ignore scan errors
        }
    );
    
    scannerStarted = true;
    startBtn.classList.add('hidden');
    stopBtn.classList.remove('hidden');
}

function stopScanner() {
    if (!scannerStarted) return;
    
    console.log('Stopping scanner...');
    
    if (html5QrcodeScanner) {
        html5QrcodeScanner.clear().catch(err => {
            console.error('Error clearing scanner:', err);
        });
    }
    
    scannerStarted = false;
    document.getElementById('startScanner').classList.remove('hidden');
    document.getElementById('stopScanner').classList.add('hidden');
    
    // Clear reader div
    document.getElementById('reader').innerHTML = '';
}

function validateInput() {
    const input = document.getElementById('qrCodeInput');
    const submitBtn = document.getElementById('submitBtn');
    
    if (!input || !submitBtn) return;
    
    const qrCode = input.value.trim().toUpperCase();
    const isValid = qrCode.length === 8 && /^[A-Z]{4}[0-9]{4}$/.test(qrCode);
    
    submitBtn.disabled = !isValid;
    
    if (isValid) {
        submitBtn.style.opacity = '1';
        submitBtn.style.cursor = 'pointer';
        submitBtn.classList.remove('opacity-50', 'cursor-not-allowed');
    } else {
        submitBtn.style.opacity = '0.5';
        submitBtn.style.cursor = 'not-allowed';
        submitBtn.classList.add('opacity-50', 'cursor-not-allowed');
    }
}

function processQrCode(qrCode) {
    console.log('Processing QR Code:', qrCode);
    
    fetch('{{ route("scan.process") }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({ qr_code: qrCode })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            showAlert('success', data.message, data.data);
            document.getElementById('qrCodeInput').value = '';
            validateInput();
        } else {
            showAlert('error', data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showAlert('error', 'Terjadi kesalahan saat memproses QR Code');
    });
}

function showAlert(type, message, data = null) {
    const alertDiv = document.getElementById('scanResult');
    const isSuccess = type === 'success';
    
    let content = `
        <div class="border px-4 py-3 rounded ${isSuccess ? 'bg-green-100 border-green-400 text-green-700' : 'bg-red-100 border-red-400 text-red-700'}">
            <div class="flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    ${isSuccess ? 
                        '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>' : 
                        '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>'
                    }
                </svg>
                <strong>${message}</strong>
            </div>
    `;
    
    if (data) {
        content += `
            <div class="mt-3 text-sm">                <div class="grid grid-cols-2 gap-2">
                    <div><strong>Mata Kuliah:</strong> ${data.matakuliah}</div>
                    <div><strong>Tanggal:</strong> ${data.tanggal_formatted}</div>
                    <div><strong>Jam:</strong> ${data.jam}</div>
                    <div><strong>Ruangan:</strong> ${data.ruangan}</div>
                    <div><strong>Tanggal Absen:</strong> ${data.tanggal}</div>
                    <div><strong>Waktu Absen:</strong> ${data.waktu_absen}</div>
                </div>
            </div>
        `;
    }
    
    content += '</div>';
    
    alertDiv.innerHTML = content;
    alertDiv.classList.remove('hidden');
    
    setTimeout(() => {
        alertDiv.classList.add('hidden');
    }, 10000);
}
</script>
@endsection
