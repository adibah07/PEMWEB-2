@extends('dashboard.layout.index')

@section('content')
<div class="container mx-auto">
    <!-- Header -->
    <div class="bg-white rounded-lg shadow-md p-6 mb-6">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">{{ $matakuliah->nama }}</h1>
                <p class="text-gray-600 mt-1">Detail mata kuliah dan statistik kehadiran</p>
                <div class="flex items-center space-x-4 mt-2 text-sm text-gray-500">
                    <span>Kode: <strong>{{ $matakuliah->kode }}</strong></span>
                    <span>SKS: <strong>{{ $matakuliah->sks }}</strong></span>
                    <span>Dosen: <strong>{{ $dosen->user->name }}</strong></span>
                </div>
            </div>
            <div class="flex items-center space-x-2">
                <a href="{{ route('matakuliah.index') }}" 
                   class="inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Kembali
                </a>
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

    <!-- Statistik -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
        <div class="bg-blue-500 rounded-lg shadow-md p-6 text-white">
            <div class="flex items-center">
                <div class="flex-1">
                    <h3 class="text-lg font-semibold">Total Mahasiswa</h3>
                    <p class="text-3xl font-bold">{{ $statistik['total_mahasiswa'] }}</p>
                </div>
                <div>
                    <svg class="w-12 h-12 text-blue-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-green-500 rounded-lg shadow-md p-6 text-white">
            <div class="flex items-center">
                <div class="flex-1">
                    <h3 class="text-lg font-semibold">Total Absensi</h3>
                    <p class="text-3xl font-bold">{{ $statistik['total_absensi'] }}</p>
                </div>
                <div>
                    <svg class="w-12 h-12 text-green-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-purple-500 rounded-lg shadow-md p-6 text-white">
            <div class="flex items-center">
                <div class="flex-1">
                    <h3 class="text-lg font-semibold">Kehadiran</h3>
                    <p class="text-3xl font-bold">{{ $statistik['persentase_kehadiran'] }}%</p>
                </div>
                <div>
                    <svg class="w-12 h-12 text-purple-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-orange-500 rounded-lg shadow-md p-6 text-white">
            <div class="flex items-center">
                <div class="flex-1">
                    <h3 class="text-lg font-semibold">Absen Hari Ini</h3>
                    <p class="text-3xl font-bold">{{ $statistik['absensi_hari_ini'] }}</p>
                </div>
                <div>
                    <svg class="w-12 h-12 text-orange-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Detail Statistik -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
        <!-- Breakdown Absensi -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Breakdown Absensi</h3>
            <div class="space-y-3">
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <div class="w-3 h-3 bg-green-500 rounded-full mr-3"></div>
                        <span class="text-gray-700">Hadir</span>
                    </div>
                    <span class="font-semibold text-gray-900">{{ $statistik['hadir'] }}</span>
                </div>
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <div class="w-3 h-3 bg-yellow-500 rounded-full mr-3"></div>
                        <span class="text-gray-700">Izin</span>
                    </div>
                    <span class="font-semibold text-gray-900">{{ $statistik['izin'] }}</span>
                </div>
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <div class="w-3 h-3 bg-blue-500 rounded-full mr-3"></div>
                        <span class="text-gray-700">Sakit</span>
                    </div>
                    <span class="font-semibold text-gray-900">{{ $statistik['sakit'] }}</span>
                </div>
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <div class="w-3 h-3 bg-red-500 rounded-full mr-3"></div>
                        <span class="text-gray-700">Alfa</span>
                    </div>
                    <span class="font-semibold text-gray-900">{{ $statistik['alfa'] }}</span>
                </div>
            </div>
        </div>

        <!-- Absensi Hari Ini -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Absensi Hari Ini</h3>
            @if($absensiHariIni->count() > 0)
                <div class="space-y-3 max-h-64 overflow-y-auto">
                    @foreach($absensiHariIni as $absensi)
                        <div class="flex items-center justify-between py-2 border-b border-gray-100">
                            <div>
                                <p class="font-medium text-gray-900">{{ $absensi->mahasiswa->user->name }}</p>
                                <p class="text-sm text-gray-500">{{ $absensi->jadwal->tanggal ? $absensi->jadwal->tanggal->format('d/m/Y') . ' (' . $absensi->jadwal->tanggal->format('l') . ')' : 'Belum diatur' }} - {{ $absensi->jadwal->jam_mulai }}</p>
                            </div>
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
                                {{ $absensi->status === 'hadir' ? 'bg-green-100 text-green-800' : 
                                   ($absensi->status === 'izin' ? 'bg-yellow-100 text-yellow-800' : 
                                   ($absensi->status === 'sakit' ? 'bg-blue-100 text-blue-800' : 'bg-red-100 text-red-800')) }}">
                                {{ ucfirst($absensi->status) }}
                            </span>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-gray-500 text-center py-4">Belum ada absensi hari ini</p>
            @endif
        </div>
    </div>

    <!-- Daftar Jadwal -->
    <div class="bg-white rounded-lg shadow-md">
        <div class="px-6 py-4 border-b border-gray-200">
            <h2 class="text-lg font-semibold text-gray-800">Jadwal Kuliah</h2>
        </div>

        @if($jadwalList->count() > 0)
            <div class="divide-y divide-gray-200">
                @foreach($jadwalList as $jadwal)
                    <div class="p-6">
                        <div class="flex items-center justify-between">
                            <div class="flex-1">
                                <div class="flex items-start space-x-3">
                                    <div class="flex-shrink-0">
                                        <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2-2v16a2 2 0 002 2z"></path>
                                            </svg>
                                        </div>
                                    </div>
                                    <div>
                                        <h3 class="text-lg font-semibold text-gray-900">{{ $jadwal->tanggal ? $jadwal->tanggal->format('d/m/Y') . ' (' . $jadwal->tanggal->format('l') . ')' : 'Belum diatur' }}</h3>
                                        <p class="text-sm text-gray-600">{{ $jadwal->jam_mulai }} - {{ $jadwal->jam_selesai }}</p>
                                        <p class="text-sm text-gray-600">Ruangan: {{ $jadwal->ruangan }}</p>
                                        <div class="flex items-center space-x-4 mt-2 text-sm text-gray-500">
                                            <span class="flex items-center">
                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                                                </svg>
                                                {{ $jadwal->mahasiswa_count }} Mahasiswa
                                            </span>
                                            @if($jadwal->qrcodes->count() > 0)
                                                @php $qrcode = $jadwal->qrcodes->first(); @endphp
                                                <span class="flex items-center text-green-600">
                                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                    </svg>
                                                    QR Code Aktif
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="flex items-center space-x-3">
                                <a href="{{ route('jadwal.show', $jadwal) }}" 
                                   class="inline-flex items-center px-3 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                                    Detail
                                </a>
                                <a href="{{ route('absensi.show', $jadwal) }}" 
                                   class="inline-flex items-center px-3 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700">
                                    Kelola Absensi
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="p-6 text-center">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2-2v16a2 2 0 002 2z"></path>
                </svg>
                <h3 class="mt-2 text-sm font-medium text-gray-900">Tidak ada jadwal</h3>
                <p class="mt-1 text-sm text-gray-500">Belum ada jadwal untuk mata kuliah ini.</p>
                <div class="mt-6">
                    <a href="{{ route('jadwal.create') }}" 
                       class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        Tambah Jadwal
                    </a>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection
