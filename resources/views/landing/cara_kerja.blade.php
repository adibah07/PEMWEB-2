@extends('landing.layouts.index')
    @section('content')

    <!-- Hero Section -->
    <section class="relative py-20 lg:py-32 overflow-hidden">
        <!-- Animated Background -->
        <div class="absolute inset-0 -z-10">
            <div class="absolute top-20 left-10 w-96 h-96 bg-blue-300/30 rounded-full mix-blend-multiply filter blur-xl animate-pulse"></div>
            <div class="absolute top-40 right-10 w-96 h-96 bg-purple-300/30 rounded-full mix-blend-multiply filter blur-xl animate-pulse animation-delay-1s"></div>
            <div class="absolute bottom-20 left-1/3 w-96 h-96 bg-pink-300/30 rounded-full mix-blend-multiply filter blur-xl animate-pulse animation-delay-2s"></div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <div class="inline-flex items-center px-4 py-2 bg-blue-100 text-blue-800 rounded-full text-sm font-medium mb-6">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                    </svg>
                    Mudah & Cepat
                </div>                <h1 class="text-4xl sm:text-5xl lg:text-6xl font-bold text-gray-900 mb-6">
                    Cara Kerja <span class="bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">Sistem Absensi</span>
                </h1>
                <p class="text-xl text-gray-600 mb-12 max-w-3xl mx-auto leading-relaxed">
                    Sistem absensi digital yang mudah digunakan dengan QR Code scanning dan dashboard terintegrasi. 
                    Ikuti 4 langkah sederhana untuk memulai absensi digital di institusi Anda.
                </p>
            </div>
        </div>
    </section>

    <!-- Main Steps Section -->
    <section class="py-20 relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Process Timeline -->            <div class="relative">
                <!-- Connecting Line -->
                <div class="absolute left-1/2 transform -translate-x-1/2 w-1 h-full bg-gradient-to-b from-blue-500 via-purple-500 to-green-500 hidden lg:block"></div>
                
                <!-- Step 1: Login & Setup -->
                <div class="relative mb-20 lg:mb-32">
                    <div class="lg:grid lg:grid-cols-2 lg:gap-16 items-center">
                        <div class="mb-8 lg:mb-0">
                            <div class="bg-gradient-to-br from-blue-50 to-purple-50 rounded-3xl p-8 shadow-xl border border-gray-200/50">
                                <div class="flex items-center mb-6">
                                    <div class="w-12 h-12 bg-gradient-to-r from-blue-500 to-purple-600 rounded-xl flex items-center justify-center text-white font-bold text-xl mr-4">1</div>
                                    <h3 class="text-2xl font-bold text-gray-900">Login & Akses Dashboard</h3>
                                </div>
                                <p class="text-gray-600 text-lg leading-relaxed mb-6">
                                    Dosen dan mahasiswa login menggunakan akun masing-masing untuk mengakses dashboard yang sesuai dengan role mereka.
                                </p>
                                <div class="space-y-3">
                                    <div class="flex items-center">
                                        <svg class="w-5 h-5 text-green-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                        <span class="text-gray-700">Role-based access (Admin, Dosen, Mahasiswa)</span>
                                    </div>
                                    <div class="flex items-center">
                                        <svg class="w-5 h-5 text-green-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                        <span class="text-gray-700">Dashboard khusus sesuai kebutuhan</span>
                                    </div>
                                    <div class="flex items-center">
                                        <svg class="w-5 h-5 text-green-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                        <span class="text-gray-700">Sidebar menu yang intuitif</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="relative">
                            <div class="bg-white rounded-2xl shadow-2xl overflow-hidden border border-gray-200">
                                <div class="bg-gray-100 px-4 py-3 flex items-center">
                                    <div class="flex space-x-2">
                                        <div class="w-3 h-3 bg-red-500 rounded-full"></div>
                                        <div class="w-3 h-3 bg-yellow-500 rounded-full"></div>
                                        <div class="w-3 h-3 bg-green-500 rounded-full"></div>
                                    </div>
                                    <div class="ml-4 text-sm text-gray-600">/login</div>
                                </div>
                                <div class="p-8 bg-gradient-to-br from-blue-50 to-white">
                                    <h4 class="text-lg font-semibold mb-4">Form Login</h4>
                                    <div class="space-y-4">
                                        <div>
                                            <label class="block text-sm text-gray-600 mb-2">Email</label>
                                            <div class="bg-white border rounded-lg px-3 py-2 text-sm">dosen@example.com</div>
                                        </div>
                                        <div>
                                            <label class="block text-sm text-gray-600 mb-2">Password</label>
                                            <div class="bg-white border rounded-lg px-3 py-2 text-sm">••••••••</div>
                                        </div>
                                        <button class="w-full bg-blue-600 text-white py-2 rounded-lg text-sm font-medium">Login</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Step Indicator -->
                    <div class="absolute left-1/2 transform -translate-x-1/2 -translate-y-1/2 top-1/2 hidden lg:block">
                        <div class="w-8 h-8 bg-blue-500 rounded-full border-4 border-white shadow-lg"></div>
                    </div>
                </div>

                <!-- Step 2: Kelola Data & Jadwal -->
                <div class="relative mb-20 lg:mb-32">
                    <div class="lg:grid lg:grid-cols-2 lg:gap-16 items-center">
                        <div class="order-2 lg:order-1 relative">
                            <div class="bg-white rounded-2xl shadow-2xl overflow-hidden border border-gray-200">
                                <div class="bg-gray-100 px-4 py-3 flex items-center">
                                    <div class="flex space-x-2">
                                        <div class="w-3 h-3 bg-red-500 rounded-full"></div>
                                        <div class="w-3 h-3 bg-yellow-500 rounded-full"></div>
                                        <div class="w-3 h-3 bg-green-500 rounded-full"></div>
                                    </div>
                                    <div class="ml-4 text-sm text-gray-600">/dashboard/jadwal</div>
                                </div>
                                <div class="p-6">
                                    <div class="flex justify-between items-center mb-4">
                                        <h4 class="text-lg font-semibold">Kelola Jadwal</h4>
                                        <button class="bg-blue-600 text-white px-3 py-1 rounded text-sm">+ Tambah</button>
                                    </div>
                                    <div class="space-y-3">
                                        <div class="bg-gray-50 p-3 rounded-lg border">
                                            <div class="font-medium text-sm">Pemrograman Web</div>
                                            <div class="text-xs text-gray-600">Senin, 08:00 - 10:00 | Lab 1</div>
                                            <div class="text-xs text-blue-600">15 Mahasiswa</div>
                                        </div>
                                        <div class="bg-gray-50 p-3 rounded-lg border">
                                            <div class="font-medium text-sm">Database</div>
                                            <div class="text-xs text-gray-600">Rabu, 10:00 - 12:00 | Lab 2</div>
                                            <div class="text-xs text-blue-600">20 Mahasiswa</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="order-1 lg:order-2 mb-8 lg:mb-0">
                            <div class="bg-gradient-to-br from-purple-50 to-pink-50 rounded-3xl p-8 shadow-xl border border-gray-200/50">
                                <div class="flex items-center mb-6">
                                    <div class="w-12 h-12 bg-gradient-to-r from-purple-500 to-pink-600 rounded-xl flex items-center justify-center text-white font-bold text-xl mr-4">2</div>
                                    <h3 class="text-2xl font-bold text-gray-900">Kelola Data & Jadwal</h3>
                                </div>
                                <p class="text-gray-600 text-lg leading-relaxed mb-6">
                                    Dosen dapat mengelola mata kuliah, jadwal perkuliahan, dan menambahkan mahasiswa ke dalam kelas masing-masing.
                                </p>
                                <div class="space-y-3">
                                    <div class="flex items-center">
                                        <svg class="w-5 h-5 text-green-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                        <span class="text-gray-700">CRUD mata kuliah dan jadwal</span>
                                    </div>
                                    <div class="flex items-center">
                                        <svg class="w-5 h-5 text-green-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                        <span class="text-gray-700">Assign mahasiswa ke jadwal</span>
                                    </div>
                                    <div class="flex items-center">
                                        <svg class="w-5 h-5 text-green-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                        <span class="text-gray-700">Lihat daftar mahasiswa terdaftar</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Step Indicator -->
                    <div class="absolute left-1/2 transform -translate-x-1/2 -translate-y-1/2 top-1/2 hidden lg:block">
                        <div class="w-8 h-8 bg-purple-500 rounded-full border-4 border-white shadow-lg"></div>
                    </div>
                </div>

                <!-- Step 3: Generate QR & Absensi -->
                <div class="relative mb-20 lg:mb-32">
                    <div class="lg:grid lg:grid-cols-2 lg:gap-16 items-center">
                        <div class="mb-8 lg:mb-0">
                            <div class="bg-gradient-to-br from-green-50 to-emerald-50 rounded-3xl p-8 shadow-xl border border-gray-200/50">
                                <div class="flex items-center mb-6">
                                    <div class="w-12 h-12 bg-gradient-to-r from-green-500 to-emerald-600 rounded-xl flex items-center justify-center text-white font-bold text-xl mr-4">3</div>
                                    <h3 class="text-2xl font-bold text-gray-900">Generate QR & Absensi</h3>
                                </div>
                                <p class="text-gray-600 text-lg leading-relaxed mb-6">
                                    Dosen generate QR Code untuk sesi absensi, mahasiswa scan QR untuk hadir, atau dosen input absensi manual.
                                </p>
                                <div class="space-y-3">
                                    <div class="flex items-center">
                                        <svg class="w-5 h-5 text-green-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                        <span class="text-gray-700">Generate QR Code unik (8 karakter)</span>
                                    </div>
                                    <div class="flex items-center">
                                        <svg class="w-5 h-5 text-green-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                        <span class="text-gray-700">Mahasiswa scan dengan kamera</span>
                                    </div>
                                    <div class="flex items-center">
                                        <svg class="w-5 h-5 text-green-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                        <span class="text-gray-700">Input manual untuk backup</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="relative">
                            <div class="bg-white rounded-2xl shadow-2xl overflow-hidden border border-gray-200">
                                <div class="bg-gray-100 px-4 py-3 flex items-center">
                                    <div class="flex space-x-2">
                                        <div class="w-3 h-3 bg-red-500 rounded-full"></div>
                                        <div class="w-3 h-3 bg-yellow-500 rounded-full"></div>
                                        <div class="w-3 h-3 bg-green-500 rounded-full"></div>
                                    </div>
                                    <div class="ml-4 text-sm text-gray-600">/dashboard/scan</div>
                                </div>
                                <div class="p-6 text-center">
                                    <h4 class="text-lg font-semibold mb-4">Scan QR Code</h4>
                                    <div class="bg-gray-100 w-32 h-32 mx-auto mb-4 rounded-lg flex items-center justify-center">
                                        <div class="grid grid-cols-3 gap-1">
                                            <div class="w-2 h-2 bg-black"></div>
                                            <div class="w-2 h-2 bg-white"></div>
                                            <div class="w-2 h-2 bg-black"></div>
                                            <div class="w-2 h-2 bg-white"></div>
                                            <div class="w-2 h-2 bg-black"></div>
                                            <div class="w-2 h-2 bg-white"></div>
                                            <div class="w-2 h-2 bg-black"></div>
                                            <div class="w-2 h-2 bg-white"></div>
                                            <div class="w-2 h-2 bg-black"></div>
                                        </div>
                                    </div>
                                    <div class="text-center font-mono text-lg mb-4">ABCD1234</div>
                                    <div class="space-y-2">
                                        <input type="text" placeholder="Atau input manual..." class="w-full border rounded-lg px-3 py-2 text-sm">
                                        <button class="w-full bg-green-600 text-white py-2 rounded-lg text-sm font-medium">Submit Absensi</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Step Indicator -->
                    <div class="absolute left-1/2 transform -translate-x-1/2 -translate-y-1/2 top-1/2 hidden lg:block">
                        <div class="w-8 h-8 bg-green-500 rounded-full border-4 border-white shadow-lg"></div>
                    </div>
                </div>

                <!-- Step 4: Monitor & Laporan -->
                <div class="relative mb-20">
                    <div class="lg:grid lg:grid-cols-2 lg:gap-16 items-center">
                        <div class="order-2 lg:order-1 relative">
                            <div class="bg-white rounded-2xl shadow-2xl overflow-hidden border border-gray-200">
                                <div class="bg-gray-100 px-4 py-3 flex items-center">
                                    <div class="flex space-x-2">
                                        <div class="w-3 h-3 bg-red-500 rounded-full"></div>
                                        <div class="w-3 h-3 bg-yellow-500 rounded-full"></div>
                                        <div class="w-3 h-3 bg-green-500 rounded-full"></div>
                                    </div>
                                    <div class="ml-4 text-sm text-gray-600">/dashboard/absensi</div>
                                </div>
                                <div class="p-6">
                                    <h4 class="text-lg font-semibold mb-4">Rekap Absensi Hari Ini</h4>
                                    <div class="space-y-3">
                                        <div class="flex justify-between items-center p-3 bg-green-50 rounded-lg border border-green-200">
                                            <div>
                                                <div class="font-medium text-sm">Ahmad Budi</div>
                                                <div class="text-xs text-gray-600">2021001</div>
                                            </div>
                                            <span class="bg-green-500 text-white px-2 py-1 rounded text-xs">Hadir</span>
                                        </div>
                                        <div class="flex justify-between items-center p-3 bg-yellow-50 rounded-lg border border-yellow-200">
                                            <div>
                                                <div class="font-medium text-sm">Siti Aminah</div>
                                                <div class="text-xs text-gray-600">2021002</div>
                                            </div>
                                            <span class="bg-yellow-500 text-white px-2 py-1 rounded text-xs">Izin</span>
                                        </div>
                                        <div class="flex justify-between items-center p-3 bg-red-50 rounded-lg border border-red-200">
                                            <div>
                                                <div class="font-medium text-sm">Andi Pratama</div>
                                                <div class="text-xs text-gray-600">2021003</div>
                                            </div>
                                            <span class="bg-red-500 text-white px-2 py-1 rounded text-xs">Alpha</span>
                                        </div>
                                    </div>
                                    <div class="mt-4 text-center">
                                        <div class="text-sm text-gray-600">Total: 15 mahasiswa | Hadir: 12 | Izin: 2 | Alpha: 1</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="order-1 lg:order-2 mb-8 lg:mb-0">
                            <div class="bg-gradient-to-br from-orange-50 to-red-50 rounded-3xl p-8 shadow-xl border border-gray-200/50">
                                <div class="flex items-center mb-6">
                                    <div class="w-12 h-12 bg-gradient-to-r from-orange-500 to-red-600 rounded-xl flex items-center justify-center text-white font-bold text-xl mr-4">4</div>
                                    <h3 class="text-2xl font-bold text-gray-900">Monitor & Laporan</h3>
                                </div>
                                <p class="text-gray-600 text-lg leading-relaxed mb-6">
                                    Monitor kehadiran real-time, lihat riwayat absensi, dan dapatkan statistik kehadiran lengkap untuk evaluasi.
                                </p>
                                <div class="space-y-3">
                                    <div class="flex items-center">
                                        <svg class="w-5 h-5 text-green-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                        <span class="text-gray-700">Rekap absensi harian</span>
                                    </div>
                                    <div class="flex items-center">
                                        <svg class="w-5 h-5 text-green-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                        <span class="text-gray-700">Riwayat kehadiran mahasiswa</span>
                                    </div>
                                    <div class="flex items-center">
                                        <svg class="w-5 h-5 text-green-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                        <span class="text-gray-700">Statistik dan persentase kehadiran</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Step Indicator -->
                    <div class="absolute left-1/2 transform -translate-x-1/2 -translate-y-1/2 top-1/2 hidden lg:block">
                        <div class="w-8 h-8 bg-orange-500 rounded-full border-4 border-white shadow-lg"></div>
                    </div>
                </div>
                                </p>
                                <div class="space-y-3">
                                    <div class="flex items-center justify-center lg:justify-end text-gray-700">
                                        <span>Generate QR Code unik</span>
                                        <svg class="w-5 h-5 text-green-500 ml-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                    </div>
                                    <div class="flex items-center justify-center lg:justify-end text-gray-700">
                                        <span>Set waktu batas absensi</span>
                                        <svg class="w-5 h-5 text-green-500 ml-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                    </div>
                                    <div class="flex items-center justify-center lg:justify-end text-gray-700">
                                        <span>Monitor real-time check-ins</span>
                                        <svg class="w-5 h-5 text-green-500 ml-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mt-10 lg:mt-0" data-aos="fade-left">
                            <div class="relative">
                                <div class="bg-gradient-to-r from-green-500 to-emerald-600 rounded-3xl p-1 shadow-2xl">
                                    <div class="bg-white rounded-3xl p-8">
                                        <div class="text-center space-y-4">
                                            <div class="w-32 h-32 mx-auto bg-gray-900 rounded-2xl flex items-center justify-center">
                                                <div class="w-24 h-24 bg-white rounded-lg grid grid-cols-3 gap-1 p-2">
                                                    <div class="bg-black"></div>
                                                    <div class="bg-white"></div>
                                                    <div class="bg-black"></div>
                                                    <div class="bg-white"></div>
                                                    <div class="bg-black"></div>
                                                    <div class="bg-white"></div>
                                                    <div class="bg-black"></div>
                                                    <div class="bg-white"></div>
                                                    <div class="bg-black"></div>
                                                </div>
                                            </div>
                                            <div class="text-sm font-medium text-gray-900">Scan QR Code</div>
                                            <div class="text-xs text-gray-500">Kelas: XII IPA 1</div>
                                            <div class="inline-flex items-center px-3 py-1 bg-green-100 text-green-800 rounded-full text-xs font-medium">
                                                <div class="w-2 h-2 bg-green-500 rounded-full mr-2"></div>
                                                Sesi Aktif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Step Indicator -->
                    <div class="absolute left-1/2 transform -translate-x-1/2 -translate-y-1/2 top-1/2 hidden lg:block">
                        <div class="w-8 h-8 bg-green-500 rounded-full border-4 border-white shadow-lg"></div>
                    </div>
                </div>

                <!-- Step 4: Monitor & Reports -->
                <div class="relative mb-20">
                    <div class="lg:grid lg:grid-cols-2 lg:gap-16 items-center">
                        <div class="lg:order-2" data-aos="fade-left">
                            <div class="bg-white/70 backdrop-blur-sm rounded-3xl p-8 shadow-xl border border-gray-200/50 hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2">
                                <div class="flex items-center mb-6">
                                    <div class="w-16 h-16 bg-gradient-to-r from-orange-500 to-red-600 rounded-2xl flex items-center justify-center shadow-lg">
                                        <span class="text-2xl font-bold text-white">4</span>
                                    </div>
                                </div>
                                <h3 class="text-2xl lg:text-3xl font-bold text-gray-900 mb-4">Monitor & Laporan</h3>
                                <p class="text-gray-600 mb-6 text-lg leading-relaxed">
                                    Pantau kehadiran secara real-time dan generate laporan komprehensif. 
                                    Dashboard analytics memberikan insight mendalam tentang pola kehadiran siswa.
                                </p>
                                <div class="space-y-3">
                                    <div class="flex items-center text-gray-700">
                                        <svg class="w-5 h-5 text-green-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                        Dashboard real-time
                                    </div>
                                    <div class="flex items-center text-gray-700">
                                        <svg class="w-5 h-5 text-green-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                        Export laporan PDF/Excel
                                    </div>
                                    <div class="flex items-center text-gray-700">
                                        <svg class="w-5 h-5 text-green-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                        Analytics & insights
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mt-10 lg:mt-0 lg:order-1" data-aos="fade-right">
                            <div class="relative">
                                <div class="bg-gradient-to-r from-orange-500 to-red-600 rounded-3xl p-1 shadow-2xl">
                                    <div class="bg-white rounded-3xl p-6">
                                        <div class="space-y-4">
                                            <div class="flex items-center justify-between">
                                                <h4 class="font-semibold text-gray-900">Dashboard Analytics</h4>
                                                <span class="text-xs text-gray-500">Live</span>
                                            </div>
                                            <div class="relative h-32">
                                                <canvas id="attendanceChart" width="300" height="120"></canvas>
                                            </div>
                                            <div class="grid grid-cols-3 gap-3 text-center">
                                                <div class="bg-green-50 rounded-lg p-3">
                                                    <div class="text-lg font-bold text-green-600">94%</div>
                                                    <div class="text-xs text-gray-600">Hadir</div>
                                                </div>
                                                <div class="bg-yellow-50 rounded-lg p-3">
                                                    <div class="text-lg font-bold text-yellow-600">4%</div>
                                                    <div class="text-xs text-gray-600">Terlambat</div>
                                                </div>
                                                <div class="bg-red-50 rounded-lg p-3">
                                                    <div class="text-lg font-bold text-red-600">2%</div>
                                                    <div class="text-xs text-gray-600">Absen</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Step Indicator -->
                    <div class="absolute left-1/2 transform -translate-x-1/2 -translate-y-1/2 top-1/2 hidden lg:block">
                        <div class="w-8 h-8 bg-orange-500 rounded-full border-4 border-white shadow-lg"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section class="py-20 bg-gray-50">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl lg:text-4xl font-bold text-gray-900 mb-4">
                    Pertanyaan <span class="bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">Umum</span>
                </h2>
                <p class="text-xl text-gray-600">
                    Temukan jawaban atas pertanyaan yang sering diajukan
                </p>
            </div>

            <div x-data="{ activeTab: 1 }" class="space-y-4">
                <!-- FAQ 1 -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-200">
                    <button @click="activeTab = activeTab === 1 ? 0 : 1" class="w-full text-left p-6 focus:outline-none">
                        <div class="flex items-center justify-between">
                            <h3 class="text-lg font-semibold text-gray-900">Berapa lama waktu setup yang dibutuhkan?</h3>
                            <svg :class="activeTab === 1 ? 'transform rotate-180' : ''" class="w-5 h-5 text-gray-500 transition-transform">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </div>
                    </button>
                    <div x-show="activeTab === 1" x-transition class="px-6 pb-6">
                        <p class="text-gray-600">Setup awal dapat diselesaikan dalam 15-30 menit. Termasuk registrasi akun, konfigurasi sekolah, dan import data siswa pertama. Tim support kami juga siap membantu jika diperlukan.</p>
                    </div>
                </div>

                <!-- FAQ 2 -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-200">
                    <button @click="activeTab = activeTab === 2 ? 0 : 2" class="w-full text-left p-6 focus:outline-none">
                        <div class="flex items-center justify-between">
                            <h3 class="text-lg font-semibold text-gray-900">Apakah data siswa aman?</h3>
                            <svg :class="activeTab === 2 ? 'transform rotate-180' : ''" class="w-5 h-5 text-gray-500 transition-transform">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </div>
                    </button>
                    <div x-show="activeTab === 2" x-transition class="px-6 pb-6">
                        <p class="text-gray-600">Ya, sangat aman. Kami menggunakan enkripsi tingkat enterprise, backup otomatis harian, dan compliance dengan standar keamanan internasional. Data disimpan di server cloud yang tersertifikasi.</p>
                    </div>
                </div>

                <!-- FAQ 3 -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-200">
                    <button @click="activeTab = activeTab === 3 ? 0 : 3" class="w-full text-left p-6 focus:outline-none">
                        <div class="flex items-center justify-between">
                            <h3 class="text-lg font-semibold text-gray-900">Bisakah digunakan offline?</h3>
                            <svg :class="activeTab === 3 ? 'transform rotate-180' : ''" class="w-5 h-5 text-gray-500 transition-transform">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </div>
                    </button>
                    <div x-show="activeTab === 3" x-transition class="px-6 pb-6">
                        <p class="text-gray-600">Aplikasi dapat bekerja dalam mode offline terbatas. Data absensi akan tersimpan lokal dan otomatis sinkronisasi ketika koneksi internet tersedia kembali.</p>
                    </div>
                </div>

                <!-- FAQ 4 -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-200">
                    <button @click="activeTab = activeTab === 4 ? 0 : 4" class="w-full text-left p-6 focus:outline-none">
                        <div class="flex items-center justify-between">
                            <h3 class="text-lg font-semibold text-gray-900">Apakah ada batasan jumlah siswa?</h3>
                            <svg :class="activeTab === 4 ? 'transform rotate-180' : ''" class="w-5 h-5 text-gray-500 transition-transform">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </div>
                    </button>
                    <div x-show="activeTab === 4" x-transition class="px-6 pb-6">
                        <p class="text-gray-600">Tidak ada batasan. Sistem dapat menangani dari sekolah kecil hingga universitas besar dengan ribuan mahasiswa. Infrastruktur cloud kami dapat auto-scale sesuai kebutuhan.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-20 bg-gradient-to-r from-blue-600 to-purple-600">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl lg:text-4xl font-bold text-white mb-6">
                Siap Memulai Digitalisasi Absensi?
            </h2>
            <p class="text-xl text-blue-100 mb-8 max-w-2xl mx-auto">
                Bergabunglah dengan ribuan sekolah yang telah merasakan kemudahan ClassAttend
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
                <button class="bg-white text-blue-600 px-8 py-4 rounded-full text-lg font-semibold hover:shadow-xl transform hover:-translate-y-1 transition-all duration-300">
                    Mulai Gratis 30 Hari
                </button>
                <button class="border-2 border-white text-white px-8 py-4 rounded-full text-lg font-semibold hover:bg-white hover:text-blue-600 transition-all duration-300">
                    Hubungi Sales
                </button>
            </div>
        </div>
    </section>

    <!-- Custom Scripts -->
    <script>
        // Initialize Chart.js for attendance chart
        document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('attendanceChart');
            if (ctx) {
                new Chart(ctx, {
                    type: 'doughnut',
                    data: {
                        labels: ['Hadir', 'Terlambat', 'Absen'],
                        datasets: [{
                            data: [94, 4, 2],
                            backgroundColor: [
                                '#10B981',
                                '#F59E0B', 
                                '#EF4444'
                            ],
                            borderWidth: 0
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                display: false
                            }
                        }
                    }
                });
            }
        });

        // Custom animation delays
        const style = document.createElement('style');
        style.textContent = `
            .animation-delay-1s { animation-delay: 1s; }
            .animation-delay-2s { animation-delay: 2s; }
        `;
        document.head.appendChild(style);
    </script>
@endsection
