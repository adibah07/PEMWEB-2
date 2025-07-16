@extends('landing.layouts.index')
@section('content')
    <!-- Hero Section -->
    <section class="relative overflow-hidden py-20 lg:py-32">
        <!-- Background decoration -->
        <div class="absolute inset-0 -z-10">
            <div class="absolute top-20 left-10 w-72 h-72 bg-blue-300 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-pulse"></div>
            <div class="absolute top-40 right-10 w-72 h-72 bg-purple-300 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-pulse animation-delay-1000"></div>
            <div class="absolute bottom-20 left-1/2 w-72 h-72 bg-pink-300 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-pulse animation-delay-2000"></div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h1 class="text-4xl sm:text-5xl lg:text-6xl font-bold text-gray-900 mb-6">
                    Kelola <span class="bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">Absensi Kelas</span><br>
                    dengan Mudah & Modern
                </h1>
                <p class="text-xl text-gray-600 mb-8 max-w-3xl mx-auto leading-relaxed">
                    Sistem absensi digital yang membantu guru dan siswa mengelola kehadiran dengan efisien. 
                    Dilengkapi fitur real-time, laporan otomatis, dan interface yang user-friendly.
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center items-center mb-16">
                    <button class="bg-gradient-to-r from-blue-500 to-purple-600 text-white px-8 py-4 rounded-full text-lg font-semibold hover:shadow-xl transform hover:-translate-y-1 transition-all duration-300 flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                        </svg>
                        Mulai Sekarang
                    </button>
                    <a href="/how-it-works" class="border-2 border-gray-300 text-gray-700 px-8 py-4 rounded-full text-lg font-semibold hover:border-blue-500 hover:text-blue-600 transition-all duration-300 flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h1m4 0h1m-6 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Lihat Cara Kerja
                    </a>
                </div>

                <!-- Stats -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8 max-w-4xl mx-auto">
                    <div class="bg-white/60 backdrop-blur-sm rounded-2xl p-6 border border-gray-200/50">
                        <div class="text-3xl font-bold text-blue-600 mb-2">500+</div>
                        <div class="text-gray-600">Sekolah Terdaftar</div>
                    </div>
                    <div class="bg-white/60 backdrop-blur-sm rounded-2xl p-6 border border-gray-200/50">
                        <div class="text-3xl font-bold text-purple-600 mb-2">25K+</div>
                        <div class="text-gray-600">Siswa Aktif</div>
                    </div>
                    <div class="bg-white/60 backdrop-blur-sm rounded-2xl p-6 border border-gray-200/50">
                        <div class="text-3xl font-bold text-pink-600 mb-2">99.9%</div>
                        <div class="text-gray-600">Uptime</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Quick Preview Section -->
    <section id="features" class="py-20 bg-white/50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl lg:text-4xl font-bold text-gray-900 mb-4">
                    Mengapa Memilih <span class="bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">ClassAttend?</span>
                </h2>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                    Solusi absensi yang dirancang khusus untuk kebutuhan sekolah modern
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-16">
                <!-- Quick Feature 1 -->
                <div class="text-center">
                    <div class="w-16 h-16 bg-gradient-to-r from-blue-500 to-blue-600 rounded-2xl flex items-center justify-center mx-auto mb-6 shadow-lg">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-3">Setup dalam 15 Menit</h3>
                    <p class="text-gray-600">Mulai dari registrasi hingga absensi pertama hanya butuh waktu singkat</p>
                </div>

                <!-- Quick Feature 2 -->
                <div class="text-center">
                    <div class="w-16 h-16 bg-gradient-to-r from-purple-500 to-purple-600 rounded-2xl flex items-center justify-center mx-auto mb-6 shadow-lg">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-3">100% Mobile Ready</h3>
                    <p class="text-gray-600">Akses dari smartphone, tablet, atau komputer dengan interface yang responsif</p>
                </div>

                <!-- Quick Feature 3 -->
                <div class="text-center">
                    <div class="w-16 h-16 bg-gradient-to-r from-green-500 to-green-600 rounded-2xl flex items-center justify-center mx-auto mb-6 shadow-lg">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-3">Laporan Otomatis</h3>
                    <p class="text-gray-600">Generate laporan kehadiran dengan analitik mendalam secara otomatis</p>
                </div>
            </div>

            <!-- CTA to How It Works -->
            <div class="text-center">
                <a href="/how-it-works" class="inline-flex items-center bg-gradient-to-r from-blue-500 to-purple-600 text-white px-8 py-4 rounded-full text-lg font-semibold hover:shadow-xl transform hover:-translate-y-1 transition-all duration-300">
                    <span>Pelajari Cara Kerjanya</span>
                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                    </svg>
                </a>
            </div>
        </div>
    </section>    <!-- CTA Section -->
    <section id="about" class="py-20 bg-gradient-to-r from-blue-600 to-purple-600 relative overflow-hidden">
        <div class="absolute inset-0">
            <div class="absolute inset-0 bg-black opacity-10"></div>
            <div class="absolute top-0 left-0 w-full h-full">
                <div class="absolute top-10 left-10 w-32 h-32 bg-white rounded-full opacity-10 animate-pulse"></div>
                <div class="absolute bottom-10 right-10 w-48 h-48 bg-white rounded-full opacity-5 animate-pulse animation-delay-1000"></div>
                <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-64 h-64 bg-white rounded-full opacity-5 animate-pulse animation-delay-2000"></div>
            </div>
        </div>
          <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
            <h2 class="text-3xl lg:text-4xl font-bold text-white mb-6">
                Tentang ClassAttend
            </h2>
            <p class="text-xl text-blue-100 mb-8 max-w-2xl mx-auto">
                ClassAttend adalah solusi absensi digital yang dikembangkan untuk memudahkan pengelolaan kehadiran siswa di era modern. Dengan teknologi terdepan dan interface yang user-friendly.
            </p>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-8">
                <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-6 border border-white/20">
                    <div class="text-3xl font-bold text-white mb-2">2025</div>
                    <div class="text-blue-100">Tahun Didirikan</div>
                </div>
                <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-6 border border-white/20">
                    <div class="text-3xl font-bold text-white mb-2">500+</div>
                    <div class="text-blue-100">Sekolah Terdaftar</div>
                </div>
                <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-6 border border-white/20">
                    <div class="text-3xl font-bold text-white mb-2">25K+</div>
                    <div class="text-blue-100">Pengguna Aktif</div>
                </div>
            </div>
            <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">                <button class="bg-white text-blue-600 px-8 py-4 rounded-full text-lg font-semibold hover:shadow-xl transform hover:-translate-y-1 transition-all duration-300 flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                    </svg>
                    Mulai Sekarang
                </button>
                <button class="border-2 border-white text-white px-8 py-4 rounded-full text-lg font-semibold hover:bg-white hover:text-blue-600 transition-all duration-300 flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    Pelajari Lebih Lanjut
                </button>
                </button>
            </div>
        </div>
    </section>

     <!-- Custom styles for animations -->
    <style>
        .animation-delay-1000 {
            animation-delay: 1s;
        }
        .animation-delay-2000 {
            animation-delay: 2s;
        }
        @keyframes pulse {
            0%, 100% {
                opacity: 0.7;
            }
            50% {
                opacity: 0.3;
            }
        }
    </style>
    @endsection