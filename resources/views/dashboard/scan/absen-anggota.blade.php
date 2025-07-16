@extends('dashboard.layout.index')

@section('title', 'Absen Anggota')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-6">
        <div class="flex items-center justify-between">
            <div class="flex items-center space-x-4">
                <div class="w-12 h-12 bg-gradient-to-r from-orange-500 to-orange-600 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                </div>
                <div>
                    <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Absen Anggota</h1>
                    <p class="text-gray-600 dark:text-gray-400">Kelola absensi anggota kelas {{ $mahasiswa->kelas }}</p>
                </div>
            </div>
            <div class="text-right">
                <p class="text-sm text-gray-500 dark:text-gray-400">Kelas</p>
                <p class="text-lg font-semibold text-gray-900 dark:text-white">{{ $mahasiswa->kelas }}</p>
                <p class="text-xs text-gray-400 dark:text-gray-500 mt-2">
                    Waktu saat ini: {{ \Carbon\Carbon::now('Asia/Jakarta')->format('H:i:s') }}
                </p>
            </div>
        </div>
    </div>

    <!-- Filter dan Statistik -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Filter Form -->
        <div class="lg:col-span-2 bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-6">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Filter & Sortir Jadwal</h3>
            
            <form method="GET" action="{{ route('mahasiswa.absen-anggota') }}" class="space-y-4">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <!-- Filter Tanggal -->
                    <div>
                        <label for="tanggal" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Tanggal
                        </label>
                        <input type="date" 
                               id="tanggal" 
                               name="tanggal" 
                               value="{{ $tanggalFilter }}"
                               class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:border-blue-500 dark:bg-gray-700 dark:text-white">
                    </div>

                    <!-- Sort By -->
                    <div>
                        <label for="sort_by" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Urutkan Berdasarkan
                        </label>
                        <select id="sort_by" 
                                name="sort_by" 
                                class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:border-blue-500 dark:bg-gray-700 dark:text-white">
                            <option value="tanggal" {{ $sortBy === 'tanggal' ? 'selected' : '' }}>Tanggal</option>
                            <option value="jam_mulai" {{ $sortBy === 'jam_mulai' ? 'selected' : '' }}>Jam Mulai</option>
                            <option value="matakuliah" {{ $sortBy === 'matakuliah' ? 'selected' : '' }}>Mata Kuliah</option>
                        </select>
                    </div>

                    <!-- Sort Order -->
                    <div>
                        <label for="sort_order" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Urutan
                        </label>
                        <select id="sort_order" 
                                name="sort_order" 
                                class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:border-blue-500 dark:bg-gray-700 dark:text-white">
                            <option value="asc" {{ $sortOrder === 'asc' ? 'selected' : '' }}>Terlama ke Terbaru</option>
                            <option value="desc" {{ $sortOrder === 'desc' ? 'selected' : '' }}>Terbaru ke Terlama</option>
                        </select>
                    </div>
                </div>

                <!-- Tombol Filter -->
                <div class="flex space-x-3">
                    <button type="submit" 
                            class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-medium transition-colors duration-200">
                        <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                        Filter
                    </button>
                    <a href="{{ route('mahasiswa.absen-anggota') }}" 
                       class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg font-medium transition-colors duration-200">
                        <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                        </svg>
                        Reset
                    </a>
                </div>
            </form>
        </div>

        <!-- Statistik -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-6">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Statistik Jadwal</h3>
            <div class="space-y-3">
                <div class="flex justify-between">
                    <span class="text-gray-600 dark:text-gray-400">Total Jadwal:</span>
                    <span class="font-semibold text-gray-900 dark:text-white">{{ $totalJadwal }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-600 dark:text-gray-400">Tersedia:</span>
                    <span class="font-semibold text-green-600">{{ $jadwalTersedia }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-600 dark:text-gray-400">Akan Datang:</span>
                    <span class="font-semibold text-blue-600">{{ $jadwalAkanDatang }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-600 dark:text-gray-400">Sudah Lewat:</span>
                    <span class="font-semibold text-red-600">{{ $jadwalSudahLewat }}</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Info Filter -->
    @if($tanggalFilter)
        <div class="bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-xl p-4">
            <div class="flex items-center">
                <svg class="w-5 h-5 text-blue-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <p class="text-sm text-blue-700 dark:text-blue-400">
                    Menampilkan jadwal untuk tanggal: <strong>{{ \Carbon\Carbon::parse($tanggalFilter)->format('d/m/Y') }} ({{ \Carbon\Carbon::parse($tanggalFilter)->format('l') }})</strong>
                    | Diurutkan berdasarkan: <strong>{{ ucfirst(str_replace('_', ' ', $sortBy)) }}</strong>
                    | Urutan: <strong>{{ $sortOrder === 'asc' ? 'Ascending' : 'Descending' }}</strong>
                </p>
            </div>
        </div>
    @endif

    <!-- Jadwal Cards -->
    <div class="grid gap-6">
        @forelse($jadwalList as $jadwal)
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden">
                <div class="p-6">
                    <div class="flex items-center justify-between mb-4">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">{{ $jadwal->matakuliah->nama }}</h3>
                            <p class="text-sm text-gray-600 dark:text-gray-400">{{ $jadwal->matakuliah->kode }} - {{ $jadwal->matakuliah->dosen->user->name }}</p>
                        </div>
                        <div class="text-right">
                            <p class="text-sm text-gray-500 dark:text-gray-400">{{ $jadwal->tanggal->format('d/m/Y') }}</p>
                            <p class="text-xs text-gray-400 dark:text-gray-500">{{ $jadwal->tanggal->format('l') }}</p>
                            <p class="text-lg font-semibold text-gray-900 dark:text-white">
                                {{ date('H:i', strtotime($jadwal->jam_mulai)) }} - {{ date('H:i', strtotime($jadwal->jam_selesai)) }}
                            </p>
                        </div>
                    </div>

                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-2">
                            @if($jadwal->status_waktu === 'berlangsung' || $jadwal->status_waktu === 'tersedia')
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900/20 dark:text-green-400">
                                    <span class="w-2 h-2 bg-green-400 rounded-full mr-1.5"></span>
                                    Tersedia
                                </span>
                            @elseif($jadwal->status_waktu === 'belum_mulai')
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800 dark:bg-yellow-900/20 dark:text-yellow-400">
                                    <span class="w-2 h-2 bg-yellow-400 rounded-full mr-1.5"></span>
                                    Belum Mulai
                                </span>
                            @elseif($jadwal->status_waktu === 'akan_datang')
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-900/20 dark:text-blue-400">
                                    <span class="w-2 h-2 bg-blue-400 rounded-full mr-1.5"></span>
                                    Akan Datang
                                </span>
                            @elseif($jadwal->status_waktu === 'sudah_selesai' || $jadwal->status_waktu === 'sudah_lewat')
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800 dark:bg-red-900/20 dark:text-red-400">
                                    <span class="w-2 h-2 bg-red-400 rounded-full mr-1.5"></span>
                                    {{ $jadwal->status_waktu === 'sudah_lewat' ? 'Sudah Lewat' : 'Sudah Selesai' }}
                                </span>
                            @elseif($jadwal->status_waktu === 'jadwal_tidak_valid')
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800 dark:bg-red-900/20 dark:text-red-400">
                                    <span class="w-2 h-2 bg-red-400 rounded-full mr-1.5"></span>
                                    Jadwal Tidak Valid
                                </span>
                            @elseif($jadwal->status_waktu === 'error_parsing')
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800 dark:bg-red-900/20 dark:text-red-400">
                                    <span class="w-2 h-2 bg-red-400 rounded-full mr-1.5"></span>
                                    Error Waktu
                                </span>
                            @else
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800 dark:bg-gray-900/20 dark:text-gray-400">
                                    <span class="w-2 h-2 bg-gray-400 rounded-full mr-1.5"></span>
                                    {{ ucfirst(str_replace('_', ' ', $jadwal->status_waktu)) }}
                                </span>
                            @endif
                        </div>

                        @if($jadwal->is_waktu_absen)
                            <a href="{{ route('mahasiswa.absen-anggota.jadwal', $jadwal->id) }}" 
                               class="inline-flex items-center px-4 py-2 bg-orange-600 hover:bg-orange-700 text-white text-sm font-medium rounded-lg transition-colors duration-200">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                </svg>
                                Kelola Absensi
                            </a>
                        @else
                            <button disabled 
                                    class="inline-flex items-center px-4 py-2 bg-gray-300 text-gray-500 text-sm font-medium rounded-lg cursor-not-allowed">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                </svg>
                                Tidak Tersedia
                            </button>
                        @endif
                    </div>

                    <div class="mt-4 pt-4 border-t border-gray-200 dark:border-gray-700">
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <p class="text-sm text-gray-500 dark:text-gray-400">Ruangan</p>
                                <p class="text-sm font-medium text-gray-900 dark:text-white">{{ $jadwal->ruangan }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500 dark:text-gray-400">SKS</p>
                                <p class="text-sm font-medium text-gray-900 dark:text-white">{{ $jadwal->matakuliah->sks }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-8 text-center">
                <svg class="mx-auto h-12 w-12 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2-2v16a2 2 0 002 2z"></path>
                </svg>
                <h3 class="mt-4 text-lg font-medium text-gray-900 dark:text-white">Tidak ada jadwal</h3>
                <p class="mt-2 text-gray-500 dark:text-gray-400">
                    @if($tanggalFilter)
                        Tidak ada jadwal kuliah untuk kelas {{ $mahasiswa->kelas }} pada tanggal {{ \Carbon\Carbon::parse($tanggalFilter)->format('d/m/Y') }}.
                    @else
                        Tidak ada jadwal kuliah untuk kelas {{ $mahasiswa->kelas }}.
                    @endif
                </p>
            </div>
        @endforelse
    </div>

    <!-- Info -->
    <div class="bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-xl p-4">
        <div class="flex">
            <svg class="w-5 h-5 text-blue-400 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <div class="ml-3">
                <h3 class="text-sm font-medium text-blue-800 dark:text-blue-300">Informasi</h3>
                <p class="mt-1 text-sm text-blue-700 dark:text-blue-400">
                    Anda hanya dapat mengelola absensi anggota ketika jadwal kuliah sedang berlangsung atau bisa diakses (15 menit sebelum jam mulai hingga jam selesai). 
                    Fitur ini memungkinkan Anda untuk mencatat kehadiran teman-teman sekelas secara manual. 
                    Gunakan filter tanggal untuk melihat jadwal yang mendatang atau sebelumnya.
                </p>
            </div>
        </div>
    </div>
</div>

@if(session('success'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Toast notification for success
            const toast = document.createElement('div');
            toast.className = 'fixed top-4 right-4 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg z-50';
            toast.textContent = '{{ session("success") }}';
            document.body.appendChild(toast);
            
            setTimeout(() => {
                toast.remove();
            }, 3000);
        });
    </script>
@endif

@if(session('error'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Toast notification for error
            const toast = document.createElement('div');
            toast.className = 'fixed top-4 right-4 bg-red-500 text-white px-6 py-3 rounded-lg shadow-lg z-50';
            toast.textContent = '{{ session("error") }}';
            document.body.appendChild(toast);
            
            setTimeout(() => {
                toast.remove();
            }, 3000);
        });
    </script>
@endif
@endsection
