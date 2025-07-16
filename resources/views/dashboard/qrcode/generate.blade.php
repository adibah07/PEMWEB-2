@extends('dashboard.layout.index')

@section('content')
<div class="container mx-auto">
    <!-- Header -->
    <div class="bg-white rounded-lg shadow-md p-6 mb-6">
        <div class="flex items-center">
            <a href="{{ route('jadwal.show', $jadwal) }}" class="mr-4 text-gray-600 hover:text-gray-800">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
            </a>
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Generate QR Code</h1>
                <p class="text-gray-600 mt-1">{{ $jadwal->matakuliah->nama }} - {{ $jadwal->tanggal ? $jadwal->tanggal->format('d/m/Y') . ' (' . $jadwal->tanggal->format('l') . ')' : 'Belum diatur' }}</p>
            </div>
        </div>
    </div>

    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            {{ session('error') }}
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Form Generate QR -->
        <div class="lg:col-span-2 bg-white rounded-lg shadow-md p-6">
            <h2 class="text-xl font-bold text-gray-800 mb-4">Buat QR Code Baru</h2>
            
            <form action="{{ route('qrcode.store', $jadwal) }}" method="POST">
                @csrf
                
                <div class="mb-6">
                    <label for="expired_minutes" class="block text-sm font-medium text-gray-700 mb-2">
                        Durasi Aktif QR Code <span class="text-red-500">*</span>
                    </label>
                    <select 
                        id="expired_minutes" 
                        name="expired_minutes" 
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500 @error('expired_minutes') border-red-500 @enderror"
                        required
                    >
                        <option value="">Pilih Durasi</option>
                        <option value="5" {{ old('expired_minutes') == '5' ? 'selected' : '' }}>5 Menit</option>
                        <option value="10" {{ old('expired_minutes') == '10' ? 'selected' : '' }}>10 Menit</option>
                        <option value="15" {{ old('expired_minutes') == '15' ? 'selected' : '' }}>15 Menit</option>
                        <option value="30" {{ old('expired_minutes') == '30' ? 'selected' : '' }}>30 Menit</option>
                        <option value="60" {{ old('expired_minutes') == '60' ? 'selected' : '' }}>1 Jam</option>
                        <option value="120" {{ old('expired_minutes') == '120' ? 'selected' : '' }}>2 Jam</option>
                        <option value="180" {{ old('expired_minutes') == '180' ? 'selected' : '' }}>3 Jam</option>
                    </select>
                    <p class="text-sm text-gray-500 mt-1">QR Code akan otomatis expired setelah durasi yang dipilih</p>
                    @error('expired_minutes')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-6">
                    <h3 class="font-medium text-blue-800 mb-2">Informasi QR Code:</h3>
                    <ul class="text-sm text-blue-700 space-y-1">
                        <li>• QR Code akan digunakan untuk absensi mahasiswa</li>
                        <li>• Setiap QR Code memiliki kode unik dan waktu expired</li>
                        <li>• Mahasiswa harus scan QR Code sebelum expired</li>
                        <li>• Anda dapat membuat QR Code baru kapan saja</li>
                    </ul>
                </div>

                <!-- Actions -->
                <div class="flex justify-end space-x-4">
                    <a href="{{ route('jadwal.show', $jadwal) }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded-lg">
                        Batal
                    </a>
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg">
                        <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                        Generate QR Code
                    </button>
                </div>
            </form>
        </div>

        <!-- Info Sidebar -->
        <div class="space-y-6">
            <div class="bg-white rounded-lg shadow-md p-6">
                <h3 class="text-lg font-bold text-gray-800 mb-4">Detail Jadwal</h3>
                <div class="space-y-3">
                    <div>
                        <span class="text-sm text-gray-600">Mata Kuliah:</span>
                        <p class="font-medium text-gray-900">{{ $jadwal->matakuliah->nama }}</p>
                    </div>
                    <div>
                        <span class="text-sm text-gray-600">Kode:</span>
                        <p class="font-medium text-gray-900">{{ $jadwal->matakuliah->kode }}</p>
                    </div>                    <div>
                        <span class="text-sm text-gray-600">Tanggal:</span>
                        <p class="font-medium text-gray-900">{{ $jadwal->tanggal ? $jadwal->tanggal->format('d/m/Y') . ' (' . $jadwal->tanggal->format('l') . ')' : 'Belum diatur' }}</p>
                    </div>
                    <div>
                        <span class="text-sm text-gray-600">Waktu:</span>
                        <p class="font-medium text-gray-900">
                            {{ date('H:i', strtotime($jadwal->jam_mulai)) }} - {{ date('H:i', strtotime($jadwal->jam_selesai)) }}
                        </p>
                    </div>
                    <div>
                        <span class="text-sm text-gray-600">Ruangan:</span>
                        <p class="font-medium text-gray-900">{{ $jadwal->ruangan ?: 'Tidak ditentukan' }}</p>
                    </div>
                </div>
            </div>

            <!-- QR Code History -->
            @if($jadwal->qrcodes->count() > 0)
                <div class="bg-white rounded-lg shadow-md p-6">                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-bold text-gray-800">QR Code Terakhir</h3>
                        <a href="{{ route('qrcode.index', $jadwal) }}" class="text-blue-600 hover:text-blue-800 text-sm">Lihat Semua</a>
                    </div>
                    <div class="space-y-3">
                        @foreach($jadwal->qrcodes->take(3) as $qr)
                            <div class="border border-gray-200 rounded-lg p-3">
                                <div class="flex justify-between items-center">
                                    <div>
                                        <p class="text-sm font-medium text-gray-900">
                                            {{ $qr->created_at->format('d/m/Y H:i') }}
                                        </p>
                                        <p class="text-xs text-gray-500">
                                            Expired: {{ $qr->expired_at->format('d/m/Y H:i') }}
                                        </p>
                                    </div>
                                    <div>
                                        @if(now() > $qr->expired_at)
                                            <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">
                                                Expired
                                            </span>
                                        @else
                                            <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                                Aktif
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
