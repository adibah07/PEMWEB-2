@extends('dashboard.layout.index')
@section('content')                <!-- Welcome Banner -->
                <div class="gradient-bg rounded-2xl p-6 mb-8 text-white relative overflow-hidden">
                    <div class="absolute top-0 right-0 transform translate-x-16 -translate-y-8 opacity-20 animate-float">
                        <svg class="w-64 h-64" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                        </svg>
                    </div>
                    <div class="relative z-10 text-shadow">
                        <h1 class="text-3xl font-bold mb-2">
                            @if(isset($dosen))
                                Selamat Datang, Dr. {{ $dosen->nama ?? $user->name }}! 👋
                            @elseif(isset($mahasiswa))
                                Halo, {{ $mahasiswa->nama ?? $user->name }}! 🎓
                            @else
                                Selamat Datang, {{ $user->name }}! ✨
                            @endif
                        </h1>
                        <p class="text-white/90 text-lg">
                            @if(isset($dosen))
                                Kelola pembelajaran dengan mudah dan efisien
                            @elseif(isset($mahasiswa))
                                Pantau kehadiran dan jadwal kuliah Anda
                            @else
                                Sistem Absensi QR Code - Smart Attendance
                            @endif
                        </p>
                        <div class="mt-4 text-sm text-white/80">
                            {{ \Carbon\Carbon::now()->locale('id')->isoFormat('dddd, D MMMM Y') }}
                        </div>
                    </div>
                </div>

                <!-- Stats Cards -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">                    @if(isset($dosen))
                        <!-- Stats khusus untuk dosen -->
                        <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl p-6 text-white shadow-xl transform hover:scale-105 transition-transform duration-300">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-blue-100 text-sm font-medium">Total</p>
                                    <h3 class="text-2xl font-bold">{{ $totalMatakuliah ?? 0 }}</h3>
                                    <p class="text-blue-100 text-sm">Mata Kuliah</p>
                                </div>
                                <div class="bg-white/20 p-3 rounded-xl">
                                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <div class="bg-gradient-to-br from-green-500 to-green-600 rounded-2xl p-6 text-white shadow-xl transform hover:scale-105 transition-transform duration-300">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-green-100 text-sm font-medium">Total</p>
                                    <h3 class="text-2xl font-bold">{{ $totalJadwal ?? 0 }}</h3>
                                    <p class="text-green-100 text-sm">Jadwal</p>
                                </div>
                                <div class="bg-white/20 p-3 rounded-xl">
                                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2-2v16a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <div class="bg-gradient-to-br from-yellow-500 to-orange-500 rounded-2xl p-6 text-white shadow-xl transform hover:scale-105 transition-transform duration-300">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-yellow-100 text-sm font-medium">Hari Ini</p>
                                    <h3 class="text-2xl font-bold">{{ $jadwalHariIni ?? 0 }}</h3>
                                    <p class="text-yellow-100 text-sm">Jadwal</p>
                                </div>
                                <div class="bg-white/20 p-3 rounded-xl">
                                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <div class="bg-gradient-to-br from-purple-500 to-purple-600 rounded-2xl p-6 text-white shadow-xl transform hover:scale-105 transition-transform duration-300">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-purple-100 text-sm font-medium">Total</p>
                                    <h3 class="text-2xl font-bold">{{ $totalMahasiswa ?? 0 }}</h3>
                                    <p class="text-purple-100 text-sm">Mahasiswa</p>
                                </div>
                                <div class="bg-white/20 p-3 rounded-xl">
                                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>

                    @elseif(isset($mahasiswa))
                        <!-- Stats khusus untuk mahasiswa -->
                        <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl p-6 text-white shadow-xl transform hover:scale-105 transition-transform duration-300">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-blue-100 text-sm font-medium">Bulan Ini</p>
                                    <h3 class="text-2xl font-bold">{{ $absensiMahasiswa ?? 0 }}</h3>
                                    <p class="text-blue-100 text-sm">Absensi</p>
                                </div>
                                <div class="bg-white/20 p-3 rounded-xl">
                                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <div class="bg-gradient-to-br from-green-500 to-green-600 rounded-2xl p-6 text-white shadow-xl transform hover:scale-105 transition-transform duration-300">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-green-100 text-sm font-medium">Hari Ini</p>
                                    <h3 class="text-2xl font-bold">{{ $jadwalHariIni ?? 0 }}</h3>
                                    <p class="text-green-100 text-sm">Jadwal</p>
                                </div>
                                <div class="bg-white/20 p-3 rounded-xl">
                                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2-2v16a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <div class="bg-gradient-to-br from-yellow-500 to-orange-500 rounded-2xl p-6 text-white shadow-xl transform hover:scale-105 transition-transform duration-300">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-yellow-100 text-sm font-medium">Total</p>
                                    <h3 class="text-2xl font-bold">{{ $totalMatakuliahMahasiswa ?? 0 }}</h3>
                                    <p class="text-yellow-100 text-sm">Mata Kuliah</p>
                                </div>
                                <div class="bg-white/20 p-3 rounded-xl">
                                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <div class="bg-gradient-to-br from-purple-500 to-purple-600 rounded-2xl p-6 text-white shadow-xl transform hover:scale-105 transition-transform duration-300">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-purple-100 text-sm font-medium">Kehadiran</p>
                                    <h3 class="text-2xl font-bold">{{ $tingkatKehadiran ?? 0 }}%</h3>
                                    <p class="text-purple-100 text-sm">Tingkat</p>
                                </div>
                                <div class="bg-white/20 p-3 rounded-xl">
                                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>
                        
                    @else
                        <!-- Stats default -->
                        <div class="bg-gradient-to-br from-indigo-500 to-indigo-600 rounded-2xl p-6 text-white shadow-xl transform hover:scale-105 transition-transform duration-300">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-indigo-100 text-sm font-medium">Status</p>
                                    <h3 class="text-2xl font-bold">Aktif</h3>
                                    <p class="text-indigo-100 text-sm">{{ ucfirst($user->role) }}</p>
                                </div>
                                <div class="bg-white/20 p-3 rounded-xl">
                                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>                <!-- Content Grid -->
                <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">
                    @if(isset($dosen))
                        <!-- Menu Dosen -->
                        <div class="xl:col-span-2 bg-white rounded-2xl shadow-xl p-6">
                            <div class="flex items-center mb-6">
                                <div class="bg-gradient-to-r from-blue-500 to-purple-600 p-3 rounded-xl">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                                    </svg>
                                </div>
                                <h2 class="text-2xl font-bold text-gray-800 ml-4">Dashboard Dosen</h2>
                            </div>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <a href="{{ route('jadwal.index') }}" class="group bg-gradient-to-br from-blue-50 to-blue-100 hover:from-blue-100 hover:to-blue-200 rounded-xl p-6 transition-all duration-300 transform hover:scale-105 border border-blue-200">
                                    <div class="flex items-center justify-between">
                                        <div>
                                            <h3 class="text-lg font-semibold text-blue-800 mb-2">Kelola Jadwal</h3>
                                            <p class="text-blue-600 text-sm mb-3">Atur jadwal kuliah dan pertemuan</p>
                                            <span class="inline-flex items-center text-blue-700 text-sm font-medium group-hover:text-blue-800">
                                                Kelola
                                                <svg class="w-4 h-4 ml-2 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                                </svg>
                                            </span>
                                        </div>
                                        <div class="bg-blue-200 p-3 rounded-lg">
                                            <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2-2v16a2 2 0 002 2z"></path>
                                            </svg>
                                        </div>
                                    </div>
                                </a>

                                <a href="{{ route('jadwal.create') }}" class="group bg-gradient-to-br from-green-50 to-green-100 hover:from-green-100 hover:to-green-200 rounded-xl p-6 transition-all duration-300 transform hover:scale-105 border border-green-200">
                                    <div class="flex items-center justify-between">
                                        <div>
                                            <h3 class="text-lg font-semibold text-green-800 mb-2">Jadwal Baru</h3>
                                            <p class="text-green-600 text-sm mb-3">Buat jadwal pertemuan baru</p>
                                            <span class="inline-flex items-center text-green-700 text-sm font-medium group-hover:text-green-800">
                                                Tambah
                                                <svg class="w-4 h-4 ml-2 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                                </svg>
                                            </span>
                                        </div>
                                        <div class="bg-green-200 p-3 rounded-lg">
                                            <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                            </svg>
                                        </div>
                                    </div>
                                </a>

                                <a href="{{ route('absensi.index') }}" class="group bg-gradient-to-br from-purple-50 to-purple-100 hover:from-purple-100 hover:to-purple-200 rounded-xl p-6 transition-all duration-300 transform hover:scale-105 border border-purple-200">
                                    <div class="flex items-center justify-between">
                                        <div>
                                            <h3 class="text-lg font-semibold text-purple-800 mb-2">Data Absensi</h3>
                                            <p class="text-purple-600 text-sm mb-3">Lihat rekap kehadiran mahasiswa</p>
                                            <span class="inline-flex items-center text-purple-700 text-sm font-medium group-hover:text-purple-800">
                                                Lihat Data
                                                <svg class="w-4 h-4 ml-2 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                                </svg>
                                            </span>
                                        </div>
                                        <div class="bg-purple-200 p-3 rounded-lg">
                                            <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                                            </svg>
                                        </div>
                                    </div>
                                </a>

                                <a href="{{ route('matakuliah.index') }}" class="group bg-gradient-to-br from-orange-50 to-orange-100 hover:from-orange-100 hover:to-orange-200 rounded-xl p-6 transition-all duration-300 transform hover:scale-105 border border-orange-200">
                                    <div class="flex items-center justify-between">
                                        <div>
                                            <h3 class="text-lg font-semibold text-orange-800 mb-2">Mata Kuliah</h3>
                                            <p class="text-orange-600 text-sm mb-3">Kelola mata kuliah yang diampu</p>
                                            <span class="inline-flex items-center text-orange-700 text-sm font-medium group-hover:text-orange-800">
                                                Kelola
                                                <svg class="w-4 h-4 ml-2 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                                </svg>
                                            </span>
                                        </div>
                                        <div class="bg-orange-200 p-3 rounded-lg">
                                            <svg class="w-8 h-8 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                            </svg>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>

                    @elseif(isset($mahasiswa))
                        <!-- Menu Mahasiswa -->
                        <div class="xl:col-span-2 bg-white rounded-2xl shadow-xl p-6">
                            <div class="flex items-center mb-6">
                                <div class="bg-gradient-to-r from-green-500 to-blue-600 p-3 rounded-xl">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"></path>
                                    </svg>
                                </div>
                                <h2 class="text-2xl font-bold text-gray-800 ml-4">Dashboard Mahasiswa</h2>
                            </div>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <a href="{{ route('mahasiswa.jadwal') }}" class="group bg-gradient-to-br from-blue-50 to-blue-100 hover:from-blue-100 hover:to-blue-200 rounded-xl p-6 transition-all duration-300 transform hover:scale-105 border border-blue-200">
                                    <div class="flex items-center justify-between">
                                        <div>
                                            <h3 class="text-lg font-semibold text-blue-800 mb-2">Jadwal Kuliah</h3>
                                            <p class="text-blue-600 text-sm mb-3">Lihat jadwal perkuliahan</p>
                                            <span class="inline-flex items-center text-blue-700 text-sm font-medium group-hover:text-blue-800">
                                                Lihat Jadwal
                                                <svg class="w-4 h-4 ml-2 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                                </svg>
                                            </span>
                                        </div>
                                        <div class="bg-blue-200 p-3 rounded-lg">
                                            <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2-2v16a2 2 0 002 2z"></path>
                                            </svg>
                                        </div>
                                    </div>
                                </a>

                                <a href="{{ route('scan.index') }}" class="group bg-gradient-to-br from-green-50 to-green-100 hover:from-green-100 hover:to-green-200 rounded-xl p-6 transition-all duration-300 transform hover:scale-105 border border-green-200">
                                    <div class="flex items-center justify-between">
                                        <div>
                                            <h3 class="text-lg font-semibold text-green-800 mb-2">Scan Absen</h3>
                                            <p class="text-green-600 text-sm mb-3">Scan QR Code untuk absensi</p>
                                            <span class="inline-flex items-center text-green-700 text-sm font-medium group-hover:text-green-800">
                                                Scan QR
                                                <svg class="w-4 h-4 ml-2 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path>
                                                </svg>
                                            </span>
                                        </div>
                                        <div class="bg-green-200 p-3 rounded-lg">
                                            <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path>
                                            </svg>
                                        </div>
                                    </div>
                                </a>

                                <a href="{{ route('mahasiswa.absensi') }}" class="group bg-gradient-to-br from-purple-50 to-purple-100 hover:from-purple-100 hover:to-purple-200 rounded-xl p-6 transition-all duration-300 transform hover:scale-105 border border-purple-200">
                                    <div class="flex items-center justify-between">
                                        <div>
                                            <h3 class="text-lg font-semibold text-purple-800 mb-2">Riwayat Absen</h3>
                                            <p class="text-purple-600 text-sm mb-3">Lihat histori kehadiran</p>
                                            <span class="inline-flex items-center text-purple-700 text-sm font-medium group-hover:text-purple-800">
                                                Lihat Riwayat
                                                <svg class="w-4 h-4 ml-2 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                                </svg>
                                            </span>
                                        </div>
                                        <div class="bg-purple-200 p-3 rounded-lg">
                                            <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                        </div>
                                    </div>
                                </a>

                                <div class="group bg-gradient-to-br from-gray-50 to-gray-100 rounded-xl p-6 border border-gray-200">
                                    <div class="flex items-center justify-between">
                                        <div>
                                            <h3 class="text-lg font-semibold text-gray-800 mb-2">Pengaturan</h3>
                                            <p class="text-gray-600 text-sm mb-3">Kelola profil dan preferensi</p>
                                            <span class="inline-flex items-center text-gray-700 text-sm font-medium">
                                                Coming Soon
                                                <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                                </svg>
                                            </span>
                                        </div>
                                        <div class="bg-gray-200 p-3 rounded-lg">
                                            <svg class="w-8 h-8 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    @else
                        <!-- Menu Default -->
                        <div class="xl:col-span-2 bg-white rounded-2xl shadow-xl p-6">
                            <div class="flex items-center mb-6">
                                <div class="bg-gradient-to-r from-indigo-500 to-purple-600 p-3 rounded-xl">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                </div>
                                <h2 class="text-2xl font-bold text-gray-800 ml-4">Dashboard User</h2>
                            </div>
                            
                            <div class="text-center py-12">
                                <div class="bg-gray-100 rounded-full p-6 w-24 h-24 mx-auto mb-4">
                                    <svg class="w-12 h-12 text-gray-400 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                </div>
                                <h3 class="text-xl font-semibold text-gray-800 mb-2">Selamat Datang!</h3>
                                <p class="text-gray-600">Anda berhasil masuk ke sistem.</p>
                            </div>
                        </div>
                    @endif                    <!-- Quick Actions & Info Panel -->
                    <div class="space-y-6">
                        <!-- Quick Actions -->
                        <div class="bg-white rounded-2xl shadow-xl p-6">
                            <h3 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                </svg>
                                Quick Actions
                            </h3>
                            <div class="space-y-3">
                                @if(isset($dosen))
                                    <a href="{{ route('jadwal.index') }}" class="block w-full bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white font-semibold py-3 px-4 rounded-xl transition-all duration-300 transform hover:scale-105 text-center">
                                        📅 Kelola Jadwal
                                    </a>
                                    <a href="{{ route('jadwal.create') }}" class="block w-full bg-gradient-to-r from-green-500 to-green-600 hover:from-green-600 hover:to-green-700 text-white font-semibold py-3 px-4 rounded-xl transition-all duration-300 transform hover:scale-105 text-center">
                                        ➕ Tambah Jadwal
                                    </a>
                                    <a href="{{ route('matakuliah.index') }}" class="block w-full bg-gradient-to-r from-purple-500 to-purple-600 hover:from-purple-600 hover:to-purple-700 text-white font-semibold py-3 px-4 rounded-xl transition-all duration-300 transform hover:scale-105 text-center">
                                        📚 Mata Kuliah
                                    </a>
                                @elseif(isset($mahasiswa))
                                    <a href="{{ route('scan.index') }}" class="block w-full bg-gradient-to-r from-green-500 to-green-600 hover:from-green-600 hover:to-green-700 text-white font-semibold py-3 px-4 rounded-xl transition-all duration-300 transform hover:scale-105 text-center">
                                        📱 Scan Absen
                                    </a>
                                    <a href="{{ route('mahasiswa.jadwal') }}" class="block w-full bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white font-semibold py-3 px-4 rounded-xl transition-all duration-300 transform hover:scale-105 text-center">
                                        📅 Lihat Jadwal
                                    </a>
                                    <a href="{{ route('mahasiswa.absensi') }}" class="block w-full bg-gradient-to-r from-purple-500 to-purple-600 hover:from-purple-600 hover:to-purple-700 text-white font-semibold py-3 px-4 rounded-xl transition-all duration-300 transform hover:scale-105 text-center">
                                        📊 Riwayat Absen
                                    </a>
                                @else
                                    <button class="block w-full bg-gradient-to-r from-gray-400 to-gray-500 text-white font-semibold py-3 px-4 rounded-xl cursor-not-allowed">
                                        🔒 Menu Terbatas
                                    </button>
                                @endif
                                
                                <form action="{{ route('logout') }}" method="POST" class="w-full">
                                    @csrf
                                    <button type="submit" class="block w-full bg-gradient-to-r from-red-500 to-red-600 hover:from-red-600 hover:to-red-700 text-white font-semibold py-3 px-4 rounded-xl transition-all duration-300 transform hover:scale-105">
                                        🚪 Logout
                                    </button>
                                </form>
                            </div>
                        </div>

                        <!-- System Info -->
                        <div class="bg-gradient-to-br from-gray-50 to-gray-100 rounded-2xl p-6 border border-gray-200">
                            <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                Info Sistem
                            </h3>
                            <div class="space-y-3 text-sm text-gray-600">
                                <div class="flex items-center justify-between">
                                    <span>Status:</span>
                                    <span class="bg-green-100 text-green-800 px-2 py-1 rounded-full text-xs font-medium">Online</span>
                                </div>
                                <div class="flex items-center justify-between">
                                    <span>Role:</span>
                                    <span class="bg-blue-100 text-blue-800 px-2 py-1 rounded-full text-xs font-medium">{{ ucfirst($user->role) }}</span>
                                </div>
                                <div class="flex items-center justify-between">
                                    <span>Waktu Login:</span>
                                    <span class="text-xs">{{ \Carbon\Carbon::now()->format('H:i') }}</span>
                                </div>
                                <div class="flex items-center justify-between">
                                    <span>Versi Sistem:</span>
                                    <span class="text-xs">v2.0.1</span>
                                </div>
                            </div>
                        </div>

                        <!-- Tips & Notifications -->
                        <div class="bg-gradient-to-br from-yellow-50 to-orange-50 rounded-2xl p-6 border border-yellow-200">
                            <h3 class="text-lg font-bold text-orange-800 mb-3 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                                </svg>
                                Tips Hari Ini
                            </h3>
                            <div class="text-sm text-orange-700">
                                @if(isset($dosen))
                                    💡 <strong>Tips:</strong> Pastikan untuk membuat QR Code baru setiap pertemuan untuk keamanan absensi yang optimal.
                                @elseif(isset($mahasiswa))
                                    💡 <strong>Tips:</strong> Selalu scan QR Code saat masuk kelas untuk memastikan kehadiran tercatat dengan baik.
                                @else
                                    💡 <strong>Info:</strong> Sistem AbsenSmart menggunakan teknologi QR Code untuk absensi yang akurat dan efisien.
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
@endsection