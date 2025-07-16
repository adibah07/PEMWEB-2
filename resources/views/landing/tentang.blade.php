@extends('landing.layouts.index')
@section('content')
    <!-- Hero Section -->
    <section class="relative py-20 lg:py-32 overflow-hidden">
        <!-- Animated Background -->
        <div class="absolute inset-0 -z-10">
            <div class="absolute top-20 left-10 w-96 h-96 bg-blue-300/20 rounded-full mix-blend-multiply filter blur-xl animate-pulse"></div>
            <div class="absolute top-40 right-10 w-96 h-96 bg-purple-300/20 rounded-full mix-blend-multiply filter blur-xl animate-pulse animation-delay-1s"></div>
            <div class="absolute bottom-20 left-1/3 w-96 h-96 bg-indigo-300/20 rounded-full mix-blend-multiply filter blur-xl animate-pulse animation-delay-2s"></div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center" data-aos="fade-up">                <div class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-blue-100 to-purple-100 text-blue-800 rounded-full text-sm font-medium mb-6">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-8.25l2.25 2.25L21 12"></path>
                    </svg>
                    Tentang Sistem Absensi QR
                </div>
                <h1 class="text-4xl sm:text-5xl lg:text-6xl font-bold text-gray-900 mb-6">
                    Sistem Absensi 
                    <span class="bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">QR Code Modern</span>
                </h1>
                <p class="text-xl text-gray-600 mb-12 max-w-3xl mx-auto leading-relaxed">
                    Aplikasi dashboard absensi berbasis QR Code yang dirancang khusus untuk memudahkan pengelolaan kehadiran mahasiswa dengan teknologi sederhana namun efektif.
                </p>
            </div>
        </div>
    </section>    <!-- Company Stats -->
    <section class="py-16 bg-white/50" data-aos="fade-up">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div class="text-center">
                    <div class="text-4xl lg:text-5xl font-bold bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent mb-2">QR</div>
                    <div class="text-gray-600 font-medium">Teknologi Scan</div>
                </div>
                <div class="text-center">
                    <div class="text-4xl lg:text-5xl font-bold bg-gradient-to-r from-green-600 to-emerald-600 bg-clip-text text-transparent mb-2">3</div>
                    <div class="text-gray-600 font-medium">Role Pengguna</div>
                </div>
                <div class="text-center">
                    <div class="text-4xl lg:text-5xl font-bold bg-gradient-to-r from-orange-600 to-red-600 bg-clip-text text-transparent mb-2">24/7</div>
                    <div class="text-gray-600 font-medium">Akses Dashboard</div>
                </div>
                <div class="text-center">
                    <div class="text-4xl lg:text-5xl font-bold bg-gradient-to-r from-purple-600 to-pink-600 bg-clip-text text-transparent mb-2">Real</div>
                    <div class="text-gray-600 font-medium">Time Data</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Story Section -->
    <section class="py-20 bg-gradient-to-r from-gray-50 to-blue-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">                <div data-aos="fade-right">
                    <h2 class="text-3xl lg:text-4xl font-bold text-gray-900 mb-6">
                        Tentang <span class="bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">Aplikasi</span>
                    </h2>
                    <div class="space-y-6 text-gray-600 leading-relaxed">
                        <p>
                            Sistem Absensi QR Code ini dikembangkan untuk memudahkan pengelolaan kehadiran mahasiswa dengan teknologi yang praktis dan modern. Dengan menggunakan kode QR unik, proses absensi menjadi lebih cepat dan akurat.
                        </p>
                        <p>
                            Aplikasi ini menyediakan dashboard terpisah untuk Admin, Dosen, dan Mahasiswa dengan fitur yang disesuaikan dengan kebutuhan masing-masing role. Dosen dapat mengelola jadwal dan memantau kehadiran, sementara mahasiswa dapat melakukan absensi dan melihat riwayat kehadiran mereka.
                        </p>
                        <p>
                            Dengan antarmuka yang sederhana dan fitur yang fokus pada kebutuhan dasar absensi, sistem ini membantu institusi pendidikan untuk mengelola kehadiran dengan lebih efisien dan terorganisir.
                        </p>
                    </div>
                </div>
                
                <div class="relative" data-aos="fade-left">
                    <div class="bg-gradient-to-r from-blue-500 to-purple-600 rounded-3xl p-1 shadow-2xl">
                        <div class="bg-white rounded-3xl p-8">
                            <div class="grid grid-cols-2 gap-6">                                <div class="bg-blue-50 rounded-2xl p-6 text-center">
                                    <div class="w-12 h-12 bg-blue-500 rounded-xl flex items-center justify-center mx-auto mb-4">
                                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 16h4m-4-4h4m-4-4h4M6 6h.01M6 6h4m0-4h.01m0 11.99h.01"></path>
                                        </svg>
                                    </div>
                                    <div class="text-2xl font-bold text-gray-900">QR Code</div>
                                    <div class="text-sm text-gray-600">Teknologi Scan</div>
                                </div>
                                <div class="bg-purple-50 rounded-2xl p-6 text-center">
                                    <div class="w-12 h-12 bg-purple-500 rounded-xl flex items-center justify-center mx-auto mb-4">
                                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                        </svg>
                                    </div>
                                    <div class="text-2xl font-bold text-gray-900">Dashboard</div>
                                    <div class="text-sm text-gray-600">Multi Role</div>
                                </div>
                                <div class="bg-green-50 rounded-2xl p-6 text-center">
                                    <div class="w-12 h-12 bg-green-500 rounded-xl flex items-center justify-center mx-auto mb-4">
                                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                    </div>
                                    <div class="text-2xl font-bold text-gray-900">Real-time</div>
                                    <div class="text-sm text-gray-600">Data Update</div>
                                </div>
                                <div class="bg-orange-50 rounded-2xl p-6 text-center">
                                    <div class="w-12 h-12 bg-orange-500 rounded-xl flex items-center justify-center mx-auto mb-4">
                                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                    </div>
                                    <div class="text-2xl font-bold text-gray-900">Mudah</div>
                                    <div class="text-sm text-gray-600">Digunakan</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Mission & Vision -->
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">            <div class="text-center mb-16" data-aos="fade-up">
                <h2 class="text-3xl lg:text-4xl font-bold text-gray-900 mb-4">
                    Fitur & <span class="bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">Keunggulan</span>
                </h2>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                    Solusi absensi QR Code yang praktis dan efisien untuk kebutuhan pendidikan modern
                </p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">                <!-- Vision -->
                <div class="relative" data-aos="fade-up" data-aos-delay="100">
                    <div class="bg-gradient-to-br from-blue-50 to-indigo-100 rounded-3xl p-8 h-full">
                        <div class="flex items-center mb-6">
                            <div class="w-16 h-16 bg-gradient-to-r from-blue-500 to-indigo-600 rounded-2xl flex items-center justify-center shadow-lg">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 16h4m-4-4h4m-4-4h4M6 6h.01M6 6h4m0-4h.01m0 11.99h.01"></path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-2xl font-bold text-gray-900">Scan QR Code</h3>
                                <p class="text-blue-600 font-medium">Teknologi Modern</p>
                            </div>
                        </div>
                        <p class="text-gray-700 leading-relaxed text-lg">
                            Sistem absensi menggunakan kode QR unik yang dapat di-scan dengan mudah melalui kamera smartphone atau input manual. Format kode 8 karakter memastikan keamanan dan kemudahan penggunaan.
                        </p>
                        <div class="mt-8 space-y-3">
                            <div class="flex items-center text-gray-700">
                                <svg class="w-5 h-5 text-blue-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                Kode QR unik 8 karakter
                            </div>
                            <div class="flex items-center text-gray-700">
                                <svg class="w-5 h-5 text-blue-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                Scan kamera atau input manual
                            </div>
                            <div class="flex items-center text-gray-700">
                                <svg class="w-5 h-5 text-blue-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                Validasi real-time
                            </div>
                        </div>
                    </div>
                </div>                <!-- Mission -->
                <div class="relative" data-aos="fade-up" data-aos-delay="200">
                    <div class="bg-gradient-to-br from-purple-50 to-pink-100 rounded-3xl p-8 h-full">
                        <div class="flex items-center mb-6">
                            <div class="w-16 h-16 bg-gradient-to-r from-purple-500 to-pink-600 rounded-2xl flex items-center justify-center shadow-lg">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-2xl font-bold text-gray-900">Dashboard Multi-Role</h3>
                                <p class="text-purple-600 font-medium">Admin, Dosen & Mahasiswa</p>
                            </div>
                        </div>
                        <p class="text-gray-700 leading-relaxed text-lg mb-6">
                            Setiap role memiliki dashboard dan fitur yang disesuaikan dengan kebutuhan. Admin mengelola sistem, Dosen mengelola jadwal dan absensi, Mahasiswa melakukan absensi dan melihat riwayat.
                        </p>
                        <div class="space-y-4">
                            <div class="bg-white/70 rounded-lg p-4">
                                <div class="flex items-center">
                                    <div class="w-2 h-2 bg-purple-500 rounded-full mr-3"></div>
                                    <span class="text-gray-700 font-medium">Admin: Kelola sistem & pengguna</span>
                                </div>
                            </div>
                            <div class="bg-white/70 rounded-lg p-4">
                                <div class="flex items-center">
                                    <div class="w-2 h-2 bg-purple-500 rounded-full mr-3"></div>
                                    <span class="text-gray-700 font-medium">Dosen: Kelola jadwal & absensi</span>
                                </div>
                            </div>
                            <div class="bg-white/70 rounded-lg p-4">                                <div class="flex items-center">
                                    <div class="w-2 h-2 bg-purple-500 rounded-full mr-3"></div>
                                    <span class="text-gray-700 font-medium">Mahasiswa: Scan QR & lihat riwayat</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Team Section -->
    <section class="py-20 bg-gradient-to-r from-gray-50 to-blue-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16" data-aos="fade-up">
                <h2 class="text-3xl lg:text-4xl font-bold text-gray-900 mb-4">
                    Tim <span class="bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">Kami</span>
                </h2>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                    Orang-orang berdedikasi yang mengembangkan dan memelihara ClassAttend
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Team Member 1 -->
                <div class="bg-white rounded-3xl p-8 shadow-lg hover:shadow-xl transition-all duration-300 text-center" data-aos="fade-up" data-aos-delay="100">
                    <div class="w-24 h-24 bg-gradient-to-r from-blue-500 to-purple-600 rounded-full mx-auto mb-6 flex items-center justify-center text-white text-2xl font-bold">
                        AH
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Ahmad Hidayat</h3>
                    <p class="text-blue-600 font-medium mb-4">CEO & Founder</p>
                    <p class="text-gray-600 text-sm leading-relaxed mb-6">
                        Berpengalaman 10+ tahun di bidang teknologi pendidikan dengan passion untuk mengdigitalisasi proses pembelajaran.
                    </p>
                    <div class="flex justify-center space-x-3">
                        <a href="#" class="w-8 h-8 bg-blue-100 hover:bg-blue-500 text-blue-600 hover:text-white rounded-lg flex items-center justify-center transition-colors">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/>
                            </svg>
                        </a>
                        <a href="#" class="w-8 h-8 bg-gray-100 hover:bg-gray-500 text-gray-600 hover:text-white rounded-lg flex items-center justify-center transition-colors">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/>
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- Team Member 2 -->
                <div class="bg-white rounded-3xl p-8 shadow-lg hover:shadow-xl transition-all duration-300 text-center" data-aos="fade-up" data-aos-delay="200">
                    <div class="w-24 h-24 bg-gradient-to-r from-green-500 to-emerald-600 rounded-full mx-auto mb-6 flex items-center justify-center text-white text-2xl font-bold">
                        SR
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Sari Rahayu</h3>
                    <p class="text-green-600 font-medium mb-4">CTO & Co-Founder</p>
                    <p class="text-gray-600 text-sm leading-relaxed mb-6">
                        Expert dalam pengembangan software dengan fokus pada user experience dan system architecture yang scalable.
                    </p>
                    <div class="flex justify-center space-x-3">
                        <a href="#" class="w-8 h-8 bg-blue-100 hover:bg-blue-500 text-blue-600 hover:text-white rounded-lg flex items-center justify-center transition-colors">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/>
                            </svg>
                        </a>
                        <a href="#" class="w-8 h-8 bg-gray-100 hover:bg-gray-700 text-gray-600 hover:text-white rounded-lg flex items-center justify-center transition-colors">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"/>
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- Team Member 3 -->
                <div class="bg-white rounded-3xl p-8 shadow-lg hover:shadow-xl transition-all duration-300 text-center" data-aos="fade-up" data-aos-delay="300">
                    <div class="w-24 h-24 bg-gradient-to-r from-purple-500 to-pink-600 rounded-full mx-auto mb-6 flex items-center justify-center text-white text-2xl font-bold">
                        BW
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Budi Wijaya</h3>
                    <p class="text-purple-600 font-medium mb-4">Head of Product</p>
                    <p class="text-gray-600 text-sm leading-relaxed mb-6">
                        Spesialis dalam product management dan user research dengan pengalaman merancang produk digital yang user-centric.
                    </p>
                    <div class="flex justify-center space-x-3">
                        <a href="#" class="w-8 h-8 bg-blue-100 hover:bg-blue-500 text-blue-600 hover:text-white rounded-lg flex items-center justify-center transition-colors">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/>
                            </svg>
                        </a>
                        <a href="#" class="w-8 h-8 bg-gray-100 hover:bg-gray-500 text-gray-600 hover:text-white rounded-lg flex items-center justify-center transition-colors">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Values Section -->
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16" data-aos="fade-up">
                <h2 class="text-3xl lg:text-4xl font-bold text-gray-900 mb-4">
                    Nilai-Nilai <span class="bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">Kami</span>
                </h2>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                    Prinsip-prinsip yang memandu setiap keputusan dan tindakan kami
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <!-- Value 1 -->
                <div class="text-center" data-aos="fade-up" data-aos-delay="100">
                    <div class="w-16 h-16 bg-gradient-to-r from-blue-500 to-blue-600 rounded-2xl flex items-center justify-center mx-auto mb-6 shadow-lg">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Kualitas</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Komitmen terhadap excellence dalam setiap produk dan layanan yang kami berikan.
                    </p>
                </div>

                <!-- Value 2 -->
                <div class="text-center" data-aos="fade-up" data-aos-delay="200">
                    <div class="w-16 h-16 bg-gradient-to-r from-green-500 to-emerald-600 rounded-2xl flex items-center justify-center mx-auto mb-6 shadow-lg">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Inovasi</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Selalu menghadirkan solusi terdepan dengan teknologi dan pendekatan yang inovatif.
                    </p>
                </div>

                <!-- Value 3 -->
                <div class="text-center" data-aos="fade-up" data-aos-delay="300">
                    <div class="w-16 h-16 bg-gradient-to-r from-purple-500 to-pink-600 rounded-2xl flex items-center justify-center mx-auto mb-6 shadow-lg">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Empati</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Memahami kebutuhan pengguna dan memberikan solusi yang benar-benar bermanfaat.
                    </p>
                </div>

                <!-- Value 4 -->
                <div class="text-center" data-aos="fade-up" data-aos-delay="400">
                    <div class="w-16 h-16 bg-gradient-to-r from-orange-500 to-red-600 rounded-2xl flex items-center justify-center mx-auto mb-6 shadow-lg">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Kolaborasi</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Bekerja sama dengan mitra untuk menciptakan ekosistem pendidikan yang lebih baik.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-20 bg-gradient-to-r from-blue-600 to-purple-600">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center" data-aos="fade-up">
            <h2 class="text-3xl lg:text-4xl font-bold text-white mb-6">
                Siap Bergabung dengan Kami?
            </h2>
            <p class="text-xl text-blue-100 mb-8 max-w-2xl mx-auto">
                Mari bersama-sama membangun masa depan pendidikan yang lebih digital dan efisien. 
                Mulai perjalanan digitalisasi sekolah Anda bersama ClassAttend.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
                <button class="bg-white text-blue-600 px-8 py-4 rounded-full text-lg font-semibold hover:shadow-xl transform hover:-translate-y-1 transition-all duration-300">
                    Mulai Trial Gratis
                </button>
                <a href="{{ route('features') }}" class="border-2 border-white text-white px-8 py-4 rounded-full text-lg font-semibold hover:bg-white hover:text-blue-600 transition-all duration-300">
                    Lihat Fitur Lengkap
                </a>
            </div>
        </div>
    </section>

    <!-- Scripts -->
    <script>
        // Initialize AOS
        AOS.init({
            duration: 800,
            easing: 'ease-out-cubic',
            once: true,
            offset: 100
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
