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
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path>
                    </svg>
                    Fitur Terlengkap
                </div>                <h1 class="text-4xl sm:text-5xl lg:text-6xl font-bold text-gray-900 mb-6">
                    Fitur <span class="bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">Lengkap</span><br>
                    Sistem Absensi QR Code
                </h1>
                <p class="text-xl text-gray-600 mb-12 max-w-3xl mx-auto leading-relaxed">
                    Jelajahi semua fitur canggih yang dirancang khusus untuk pengelolaan absensi mahasiswa 
                    dengan teknologi QR Code, dashboard terintegrasi, dan monitoring real-time.
                </p>
                
            </div>
        </div>
    </section>

    <!-- Core Features Section -->
    <section class="py-20 bg-white/50" x-data="{ activeDemo: null }">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center mb-20">
                <!-- Feature 1: Real-time Attendance -->
                <div class="order-2 lg:order-1">
                    <div class="bg-white/70 backdrop-blur-sm rounded-3xl p-8 shadow-xl border border-gray-200/50 hover:shadow-2xl transition-all duration-500">
                        <div class="flex items-center mb-6">
                            <div class="w-16 h-16 bg-gradient-to-r from-blue-500 to-blue-600 rounded-2xl flex items-center justify-center shadow-lg">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>                            <div class="ml-4">
                                <h3 class="text-2xl font-bold text-gray-900">Dashboard Multi-Role</h3>
                                <p class="text-blue-600 font-medium">Admin, Dosen & Mahasiswa</p>
                            </div>
                        </div>
                        <p class="text-gray-600 mb-6 text-lg leading-relaxed">
                            Dashboard terintegrasi dengan akses berbasis role. Admin mengelola sistem, dosen mengatur jadwal dan QR code, mahasiswa melakukan absensi dengan mudah.
                        </p>
                        <div class="space-y-3">
                            <div class="flex items-center text-gray-700">
                                <svg class="w-5 h-5 text-green-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                Dashboard khusus untuk setiap role pengguna
                            </div>
                            <div class="flex items-center text-gray-700">
                                <svg class="w-5 h-5 text-green-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                Akses menu dan fitur sesuai kewenangan
                            </div>
                            <div class="flex items-center text-gray-700">
                                <svg class="w-5 h-5 text-green-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                Interface yang user-friendly dan responsif
                            </div>
                        </div>                        <button @click="activeDemo = activeDemo === 'dashboard' ? null : 'dashboard'" 
                                class="mt-6 bg-blue-500 text-white px-6 py-3 rounded-lg hover:bg-blue-600 transition-colors font-medium">
                            <span x-text="activeDemo === 'dashboard' ? 'Tutup Demo' : 'Lihat Demo'"></span>
                        </button>
                    </div>
                </div>
                
                <div class="order-1 lg:order-2">
                    <div class="relative">
                        <div class="bg-gradient-to-r from-blue-500 to-purple-600 rounded-3xl p-1 shadow-2xl">
                            <div class="bg-white rounded-3xl p-8">
                                <div class="space-y-4">                                    <div class="flex items-center justify-between">
                                        <h4 class="font-semibold text-gray-900">Dashboard Absensi</h4>
                                        <div class="flex items-center">
                                            <div class="w-2 h-2 bg-green-500 rounded-full mr-2 animate-pulse"></div>
                                            <span class="text-xs text-green-600 font-medium">LIVE</span>
                                        </div>
                                    </div>
                                    <div class="space-y-3">
                                        <div class="flex items-center justify-between p-3 bg-green-50 rounded-lg border-l-4 border-green-500">
                                            <div class="flex items-center space-x-3">
                                                <div class="w-8 h-8 bg-green-500 rounded-full flex items-center justify-center text-white text-xs font-bold">JA</div>
                                                <div>
                                                    <div class="text-sm font-medium text-gray-900">Jane Smith</div>
                                                    <div class="text-xs text-gray-500">12345678</div>
                                                </div>
                                            </div>
                                            <div class="text-xs text-green-600 font-medium">Hadir ✓</div>
                                        </div>
                                        <div class="flex items-center justify-between p-3 bg-green-50 rounded-lg border-l-4 border-green-500">
                                            <div class="flex items-center space-x-3">
                                                <div class="w-8 h-8 bg-green-500 rounded-full flex items-center justify-center text-white text-xs font-bold">BS</div>
                                                <div>
                                                    <div class="text-sm font-medium text-gray-900">Budi Santoso</div>
                                                    <div class="text-xs text-gray-500">2021001</div>
                                                </div>
                                            </div>
                                            <div class="text-xs text-green-600 font-medium">Hadir ✓</div>
                                        </div>
                                        <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg border-l-4 border-gray-300">
                                            <div class="flex items-center space-x-3">
                                                <div class="w-8 h-8 bg-gray-400 rounded-full flex items-center justify-center text-white text-xs font-bold">SA</div>
                                                <div>
                                                    <div class="text-sm font-medium text-gray-900">Siti Aminah</div>
                                                    <div class="text-xs text-gray-500">2021002</div>
                                                </div>
                                            </div>
                                            <div class="text-xs text-gray-500 font-medium">Belum Absen</div>
                                        </div>
                                    </div>
                                    <div class="pt-3 border-t border-gray-200">
                                        <div class="flex justify-between text-sm">
                                            <span class="text-gray-600">Hadir: <span class="font-medium text-green-600">2</span></span>
                                            <span class="text-gray-600">Belum: <span class="font-medium text-gray-500">2</span></span>
                                            <span class="text-gray-600">Jadwal: <span class="font-medium text-blue-600">Aktif</span></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Feature 2: QR Code System -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center mb-20">
                <div class="order-1">
                    <div class="relative">
                        <div class="bg-gradient-to-r from-purple-500 to-pink-600 rounded-3xl p-1 shadow-2xl">
                            <div class="bg-white rounded-3xl p-8">
                                <div class="text-center space-y-6">
                                    <div class="w-48 h-48 mx-auto bg-gray-900 rounded-2xl flex items-center justify-center relative overflow-hidden">
                                        <div class="w-40 h-40 bg-white rounded-lg grid grid-cols-8 gap-1 p-2">
                                            <!-- QR Code pattern -->
                                            <div class="bg-black"></div><div class="bg-white"></div><div class="bg-black"></div><div class="bg-black"></div><div class="bg-black"></div><div class="bg-white"></div><div class="bg-black"></div><div class="bg-black"></div>
                                            <div class="bg-white"></div><div class="bg-black"></div><div class="bg-white"></div><div class="bg-white"></div><div class="bg-white"></div><div class="bg-black"></div><div class="bg-white"></div><div class="bg-white"></div>
                                            <div class="bg-black"></div><div class="bg-white"></div><div class="bg-black"></div><div class="bg-white"></div><div class="bg-black"></div><div class="bg-white"></div><div class="bg-black"></div><div class="bg-black"></div>
                                            <div class="bg-black"></div><div class="bg-white"></div><div class="bg-white"></div><div class="bg-black"></div><div class="bg-white"></div><div class="bg-white"></div><div class="bg-black"></div><div class="bg-white"></div>
                                            <div class="bg-white"></div><div class="bg-black"></div><div class="bg-black"></div><div class="bg-white"></div><div class="bg-black"></div><div class="bg-black"></div><div class="bg-white"></div><div class="bg-black"></div>
                                            <div class="bg-black"></div><div class="bg-white"></div><div class="bg-white"></div><div class="bg-black"></div><div class="bg-white"></div><div class="bg-white"></div><div class="bg-black"></div><div class="bg-white"></div>
                                            <div class="bg-white"></div><div class="bg-black"></div><div class="bg-black"></div><div class="bg-white"></div><div class="bg-black"></div><div class="bg-black"></div><div class="bg-white"></div><div class="bg-black"></div>
                                            <div class="bg-black"></div><div class="bg-white"></div><div class="bg-black"></div><div class="bg-black"></div><div class="bg-black"></div><div class="bg-white"></div><div class="bg-black"></div><div class="bg-black"></div>
                                        </div>
                                        <!-- Scanning animation -->
                                        <div class="absolute inset-0 bg-gradient-to-b from-transparent via-blue-500/20 to-transparent h-8 animate-bounce" style="animation-duration: 2s;"></div>
                                    </div>                                    <div>
                                        <div class="text-lg font-semibold text-gray-900">QR Code: NGAO1536</div>
                                        <div class="text-sm text-gray-500">Pemrograman Web - Rabu, 08:00</div>
                                    </div>
                                    <div class="inline-flex items-center px-4 py-2 bg-green-100 text-green-800 rounded-full text-sm font-medium">
                                        <div class="w-2 h-2 bg-green-500 rounded-full mr-2"></div>
                                        QR Code Aktif - Ready to Scan
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="order-2">
                    <div class="bg-white/70 backdrop-blur-sm rounded-3xl p-8 shadow-xl border border-gray-200/50 hover:shadow-2xl transition-all duration-500">
                        <div class="flex items-center mb-6">
                            <div class="w-16 h-16 bg-gradient-to-r from-purple-500 to-pink-600 rounded-2xl flex items-center justify-center shadow-lg">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-8.25l2.25 2.25L21 12"></path>
                                </svg>
                            </div>                            <div class="ml-4">
                                <h3 class="text-2xl font-bold text-gray-900">QR Code System</h3>
                                <p class="text-purple-600 font-medium">Generate & Scan QR Code</p>
                            </div>
                        </div>
                        <p class="text-gray-600 mb-6 text-lg leading-relaxed">
                            Sistem QR Code unik dengan format 4 huruf + 4 angka untuk setiap jadwal. Dosen generate QR code, mahasiswa scan menggunakan kamera smartphone atau input manual.
                        </p>
                        <div class="space-y-3">
                            <div class="flex items-center text-gray-700">
                                <svg class="w-5 h-5 text-green-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                QR Code unik untuk setiap jadwal kuliah
                            </div>
                            <div class="flex items-center text-gray-700">
                                <svg class="w-5 h-5 text-green-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                Scan dengan kamera atau input manual
                            </div>
                            <div class="flex items-center text-gray-700">
                                <svg class="w-5 h-5 text-green-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                Validasi otomatis dan real-time
                            </div>
                        </div>
                        <button @click="activeDemo = activeDemo === 'qrcode' ? null : 'qrcode'" 
                                class="mt-6 bg-purple-500 text-white px-6 py-3 rounded-lg hover:bg-purple-600 transition-colors font-medium">
                            <span x-text="activeDemo === 'qrcode' ? 'Tutup Demo' : 'Lihat Demo'"></span>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Feature 3: Analytics & Reports -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div class="order-2 lg:order-1">
                    <div class="bg-white/70 backdrop-blur-sm rounded-3xl p-8 shadow-xl border border-gray-200/50 hover:shadow-2xl transition-all duration-500">
                        <div class="flex items-center mb-6">
                            <div class="w-16 h-16 bg-gradient-to-r from-green-500 to-emerald-600 rounded-2xl flex items-center justify-center shadow-lg">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                </svg>
                            </div>                            <div class="ml-4">
                                <h3 class="text-2xl font-bold text-gray-900">Monitoring & Reports</h3>
                                <p class="text-green-600 font-medium">Laporan & Statistik</p>
                            </div>
                        </div>
                        <p class="text-gray-600 mb-6 text-lg leading-relaxed">
                            Dashboard monitoring real-time dengan statistik kehadiran, rekap harian, riwayat absensi, dan laporan lengkap untuk setiap mahasiswa dan mata kuliah.
                        </p>
                        <div class="space-y-3">
                            <div class="flex items-center text-gray-700">
                                <svg class="w-5 h-5 text-green-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                Rekap absensi harian dan per mata kuliah
                            </div>
                            <div class="flex items-center text-gray-700">
                                <svg class="w-5 h-5 text-green-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                Statistik kehadiran per mahasiswa
                            </div>
                            <div class="flex items-center text-gray-700">
                                <svg class="w-5 h-5 text-green-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                Riwayat lengkap untuk admin dan dosen
                            </div>
                        </div>
                        <button @click="activeDemo = activeDemo === 'analytics' ? null : 'analytics'" 
                                class="mt-6 bg-green-500 text-white px-6 py-3 rounded-lg hover:bg-green-600 transition-colors font-medium">
                            <span x-text="activeDemo === 'analytics' ? 'Tutup Demo' : 'Lihat Demo'"></span>
                        </button>
                    </div>
                </div>
                
                <div class="order-1 lg:order-2">
                    <div class="relative">
                        <div class="bg-gradient-to-r from-green-500 to-emerald-600 rounded-3xl p-1 shadow-2xl">
                            <div class="bg-white rounded-3xl p-6">
                                <div class="space-y-4">                                    <div class="flex items-center justify-between">
                                        <h4 class="font-semibold text-gray-900">Dashboard Monitoring</h4>
                                        <span class="text-xs text-gray-500">Real-time</span>
                                    </div>
                                    
                                    <!-- Chart Area -->
                                    <div class="relative h-32">
                                        <canvas id="attendanceChart" width="300" height="120"></canvas>
                                    </div>
                                    
                                    <!-- Stats Grid -->
                                    <div class="grid grid-cols-2 gap-3">
                                        <div class="bg-green-50 rounded-lg p-3 text-center">
                                            <div class="text-2xl font-bold text-green-600">92.5%</div>
                                            <div class="text-xs text-gray-600">Kehadiran Rata-rata</div>
                                        </div>
                                        <div class="bg-blue-50 rounded-lg p-3 text-center">
                                            <div class="text-2xl font-bold text-blue-600">156</div>
                                            <div class="text-xs text-gray-600">Total Mahasiswa</div>
                                        </div>
                                        <div class="bg-yellow-50 rounded-lg p-3 text-center">
                                            <div class="text-2xl font-bold text-yellow-600">8</div>
                                            <div class="text-xs text-gray-600">Mata Kuliah</div>
                                        </div>
                                        <div class="bg-purple-50 rounded-lg p-3 text-center">
                                            <div class="text-2xl font-bold text-purple-600">6</div>
                                            <div class="text-xs text-gray-600">Dosen</div>
                                        </div>
                                    </div>
                                    
                                    <!-- Recent Activity -->
                                    <div class="border-t pt-3">
                                        <div class="text-xs text-gray-600 mb-2">Aktivitas Terbaru</div>
                                        <div class="space-y-1">
                                            <div class="flex items-center justify-between text-xs">
                                                <span class="text-gray-700">Pemrograman Web - Hari ini</span>
                                                <span class="text-green-600">✓ 45 hadir</span>
                                            </div>
                                            <div class="flex items-center justify-between text-xs">
                                                <span class="text-gray-700">Basis Data - Kemarin</span>
                                                <span class="text-blue-600">📊 38 hadir</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> 

    <!-- CTA Section -->
    <section class="py-20 bg-gradient-to-r from-blue-600 to-purple-600">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl lg:text-4xl font-bold text-white mb-6">
                Siap Mencoba Semua Fitur?
            </h2>
            <p class="text-xl text-blue-100 mb-8 max-w-2xl mx-auto">
                Rasakan pengalaman absensi modern dengan trial gratis 30 hari. Tanpa komitmen, tanpa kartu kredit.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
                <a href="{{ route('how-it-works') }}" class="border-2 border-white text-white px-8 py-4 rounded-full text-lg font-semibold hover:bg-white hover:text-blue-600 transition-all duration-300">
                    Pelajari Cara Kerja
                </a>
            </div>
        </div>
    </section>

    <!-- Custom Scripts -->
    <script>
        // Initialize Chart.js for analytics demo
        document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('attendanceChart');
            if (ctx) {
                new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: ['Week 1', 'Week 2', 'Week 3', 'Week 4'],
                        datasets: [{
                            label: 'Attendance Rate',
                            data: [92, 94, 96, 94],
                            borderColor: '#10B981',
                            backgroundColor: 'rgba(16, 185, 129, 0.1)',
                            tension: 0.4,
                            fill: true
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                display: false
                            }
                        },
                        scales: {
                            y: {
                                beginAtZero: false,
                                min: 80,
                                max: 100,
                                grid: {
                                    display: false
                                },
                                ticks: {
                                    display: false
                                }
                            },
                            x: {
                                grid: {
                                    display: false
                                },
                                ticks: {
                                    font: {
                                        size: 10
                                    }
                                }
                            }
                        }
                    }
                });
            }
        });

        // Animation delays
        const style = document.createElement('style');
        style.textContent = `
            .animation-delay-1s { animation-delay: 1s; }
            .animation-delay-2s { animation-delay: 2s; }
        `;
        document.head.appendChild(style);
    </script>
@endsection
