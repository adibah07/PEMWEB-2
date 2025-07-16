@extends('dashboard.layout.index')

@section('content')
<div class="container mx-auto">
    <!-- Header -->
    <div class="bg-white rounded-lg shadow-md p-6 mb-6">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Jadwal Kuliah</h1>
                <p class="text-gray-600 mt-1">Daftar jadwal mata kuliah yang Anda ikuti</p>
                <p class="text-sm text-gray-500 mt-1">
                    Mahasiswa: <span class="font-semibold">{{ $mahasiswa->user->name }}</span> | 
                    NIM: <span class="font-semibold">{{ $mahasiswa->nim }}</span> |
                    Kelas: <span class="font-semibold">{{ $mahasiswa->kelas }}</span>
                </p>
            </div>
            <div class="flex items-center space-x-2">
                <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2-2v16a2 2 0 002 2z"></path>
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

    <!-- Statistik Ringkas -->
    @if($jadwalList->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
            <div class="bg-blue-500 rounded-lg shadow-md p-6 text-white">
                <div class="flex items-center">
                    <div class="flex-1">
                        <h3 class="text-lg font-semibold">Total Mata Kuliah</h3>
                        <p class="text-3xl font-bold">{{ $jadwalList->count() }}</p>
                    </div>
                    <div>
                        <svg class="w-12 h-12 text-blue-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                        </svg>
                    </div>
                </div>
            </div>

            @php
                $totalSKS = $jadwalList->sum(function($jadwal) {
                    return $jadwal->matakuliah->sks;
                });
                
                $totalAbsensi = 0;
                $totalHadir = 0;
                foreach ($statistik as $stat) {
                    $totalAbsensi += $stat['total'];
                    $totalHadir += $stat['hadir'];
                }
                $avgKehadiran = $totalAbsensi > 0 ? round(($totalHadir / $totalAbsensi) * 100, 1) : 0;
            @endphp

            <div class="bg-green-500 rounded-lg shadow-md p-6 text-white">
                <div class="flex items-center">
                    <div class="flex-1">
                        <h3 class="text-lg font-semibold">Total SKS</h3>
                        <p class="text-3xl font-bold">{{ $totalSKS }}</p>
                    </div>
                    <div>
                        <svg class="w-12 h-12 text-green-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-yellow-500 rounded-lg shadow-md p-6 text-white">
                <div class="flex items-center">
                    <div class="flex-1">
                        <h3 class="text-lg font-semibold">Rata-rata Kehadiran</h3>
                        <p class="text-3xl font-bold">{{ $avgKehadiran }}%</p>
                    </div>
                    <div>
                        <svg class="w-12 h-12 text-yellow-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-red-500 rounded-lg shadow-md p-6 text-white">
                <div class="flex items-center">
                    <div class="flex-1">
                        <h3 class="text-lg font-semibold">Total Absensi</h3>
                        <p class="text-3xl font-bold">{{ $totalAbsensi }}</p>
                    </div>
                    <div>
                        <svg class="w-12 h-12 text-red-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- Quick Actions -->
    <div class="bg-white rounded-lg shadow-md p-6 mb-6">
        <h2 class="text-lg font-bold text-gray-800 mb-4">Aksi Cepat</h2>
        <div class="flex flex-wrap gap-3">
            <a href="{{ route('scan.index') }}" 
               class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path>
                </svg>
                Scan Absen
            </a>
            <a href="{{ route('mahasiswa.absensi') }}" 
               class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                </svg>
                Lihat Riwayat Absensi
            </a>
        </div>
    </div>

    <!-- Daftar Jadwal -->
    @if($jadwalList->count() > 0)
        <div class="grid gap-6">
            @foreach($jadwalList as $jadwal)
                <div class="bg-white rounded-lg shadow-md p-6">
                    <div class="flex justify-between items-start mb-4">
                        <div>
                            <h3 class="text-xl font-bold text-gray-800">{{ $jadwal->matakuliah->nama }}</h3>
                            <p class="text-gray-600">{{ $jadwal->matakuliah->kode }} | {{ $jadwal->matakuliah->sks }} SKS</p>
                        </div>
                        <div class="text-right">
                            @if(isset($statistik[$jadwal->id]) && $statistik[$jadwal->id]['persentase'] >= 75)
                                <span class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded-full">
                                    Baik ({{ $statistik[$jadwal->id]['persentase'] }}%)
                                </span>
                            @elseif(isset($statistik[$jadwal->id]) && $statistik[$jadwal->id]['persentase'] >= 50)
                                <span class="bg-yellow-100 text-yellow-800 text-xs font-medium px-2.5 py-0.5 rounded-full">
                                    Cukup ({{ $statistik[$jadwal->id]['persentase'] }}%)
                                </span>
                            @else
                                <span class="bg-red-100 text-red-800 text-xs font-medium px-2.5 py-0.5 rounded-full">
                                    Kurang ({{ isset($statistik[$jadwal->id]) ? $statistik[$jadwal->id]['persentase'] : 0 }}%)
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                        <!-- Info Dosen -->
                        <div class="flex items-center space-x-3">
                            <div class="flex-shrink-0">
                                <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-900">Dosen Pengampu</p>
                                <p class="text-sm text-gray-500">{{ $jadwal->matakuliah->dosen->user->name }}</p>
                                <p class="text-xs text-gray-400">NIDN: {{ $jadwal->matakuliah->dosen->nidn }}</p>
                            </div>
                        </div>

                        <!-- Info Jadwal -->
                        <div class="flex items-center space-x-3">
                            <div class="flex-shrink-0">
                                <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>                            <div>
                                <p class="text-sm font-medium text-gray-900">Tanggal & Waktu</p>
                                <p class="text-sm text-gray-500">{{ $jadwal->tanggal ? $jadwal->tanggal->format('d/m/Y') . ' (' . $jadwal->tanggal->format('l') . ')' : 'Belum diatur' }}</p>
                                <p class="text-xs text-gray-400">{{ $jadwal->jam_mulai }} - {{ $jadwal->jam_selesai }}</p>
                            </div>
                        </div>

                        <!-- Info Ruangan -->
                        <div class="flex items-center space-x-3">
                            <div class="flex-shrink-0">
                                <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-900">Ruangan</p>
                                <p class="text-sm text-gray-500">{{ $jadwal->ruangan }}</p>
                            </div>
                        </div>
                    </div>

                    @if(isset($statistik[$jadwal->id]))
                        <!-- Statistik Kehadiran -->
                        <div class="border-t pt-4">
                            <h4 class="text-sm font-medium text-gray-900 mb-3">Statistik Kehadiran</h4>
                            <div class="grid grid-cols-2 md:grid-cols-5 gap-4 text-center">
                                <div>
                                    <p class="text-2xl font-bold text-blue-600">{{ $statistik[$jadwal->id]['total'] }}</p>
                                    <p class="text-xs text-gray-500">Total Pertemuan</p>
                                </div>
                                <div>
                                    <p class="text-2xl font-bold text-green-600">{{ $statistik[$jadwal->id]['hadir'] }}</p>
                                    <p class="text-xs text-gray-500">Hadir</p>
                                </div>
                                <div>
                                    <p class="text-2xl font-bold text-yellow-600">{{ $statistik[$jadwal->id]['izin'] }}</p>
                                    <p class="text-xs text-gray-500">Izin</p>
                                </div>
                                <div>
                                    <p class="text-2xl font-bold text-blue-600">{{ $statistik[$jadwal->id]['sakit'] }}</p>
                                    <p class="text-xs text-gray-500">Sakit</p>
                                </div>
                                <div>
                                    <p class="text-2xl font-bold text-red-600">{{ $statistik[$jadwal->id]['alfa'] }}</p>
                                    <p class="text-xs text-gray-500">Alfa</p>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            @endforeach
        </div>
    @else
        <div class="bg-white rounded-lg shadow-md p-6 text-center">
            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2-2v16a2 2 0 002 2z"></path>
            </svg>
            <h3 class="mt-2 text-sm font-medium text-gray-900">Belum ada jadwal</h3>
            <p class="mt-1 text-sm text-gray-500">Anda belum terdaftar di jadwal mata kuliah manapun.</p>
        </div>
    @endif
</div>
@endsection
