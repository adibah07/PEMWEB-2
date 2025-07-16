<div id="sidebar"
    class="bg-gradient-to-b from-slate-900 via-slate-800 to-slate-900 text-white w-64 h-screen fixed lg:relative lg:translate-x-0 transform -translate-x-full transition-all duration-300 ease-in-out z-40 shadow-2xl border-r border-slate-700/50 flex flex-col">
    <!-- Header -->
    <div class="flex items-center justify-between p-4 border-b border-slate-700/50 bg-slate-800/50">
        <div class="flex items-center space-x-3">
            <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-xl flex items-center justify-center shadow-lg ring-2 ring-blue-500/30">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
            <div class="hidden sm:block">
                <h1 class="text-lg font-bold text-white">ClassAttend</h1>
                <p class="text-xs text-slate-400">Attendance System</p>
            </div>
        </div>
        <button id="closeSidebar"
            class="lg:hidden text-slate-400 hover:text-white hover:bg-slate-700 p-2 rounded-lg transition-all duration-200 hover:scale-105">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>
    </div>

    @auth
        <!-- User Profile Section -->
        <div class="p-4 border-b border-slate-700/50 bg-slate-800/30">
            <div class="flex items-center space-x-3 bg-gradient-to-r from-slate-700/50 to-slate-600/50 backdrop-blur-sm rounded-xl p-3 border border-slate-600/30 hover:border-slate-500/50 transition-all duration-200">
                <!-- User Avatar -->
                <div class="relative">
                    <div class="w-11 h-11 bg-gradient-to-br from-amber-400 to-orange-500 rounded-xl flex items-center justify-center shadow-lg ring-2 ring-slate-600/50">
                        <span class="text-white text-base font-bold">
                            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                        </span>
                    </div>
                    <div class="absolute -bottom-1 -right-1 w-4 h-4 bg-green-500 rounded-full border-2 border-slate-800 animate-pulse"></div>
                </div>

                <!-- User Info -->
                <div class="flex-1 min-w-0">
                    <p class="text-white font-semibold text-sm truncate">{{ auth()->user()->name }}</p>
                    <div class="flex items-center mt-1">
                        @if(auth()->user()->role === 'admin')
                            <span class="inline-flex items-center px-2 py-1 rounded-lg text-xs font-medium bg-red-500/30 text-red-100 border border-red-400/50">
                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z">
                                    </path>
                                </svg>
                                Admin
                            </span>
                        @elseif(auth()->user()->role === 'dosen')
                            <span class="inline-flex items-center px-2 py-1 rounded-lg text-xs font-medium bg-blue-500/30 text-blue-100 border border-blue-400/50">
                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 14l9-5-9-5-9 5 9 5z"></path>
                                </svg>
                                Dosen
                            </span>
                        @elseif(auth()->user()->role === 'mahasiswa')
                            <span class="inline-flex items-center px-2 py-1 rounded-lg text-xs font-medium bg-emerald-500/30 text-emerald-100 border border-emerald-400/50">
                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                                Mahasiswa
                            </span>
                        @endif
                    </div>
                    <p class="text-xs text-slate-400 mt-1 flex items-center">
                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        {{ now()->format('H:i, d M Y') }}
                    </p>
                </div>
            </div>
        </div>
    @endauth

    <!-- Navigation -->
    <nav class="flex-1 p-4 space-y-1 overflow-y-auto">
        <!-- Dashboard -->
        <a href="{{ route('dashboard') }}"
            class="group flex items-center space-x-3 p-3 rounded-xl transition-all duration-200 hover:scale-[1.02] {{ request()->routeIs('dashboard') ? 'bg-gradient-to-r from-blue-500 to-blue-600 text-white shadow-lg shadow-blue-500/25' : 'hover:bg-slate-700/50 text-slate-300 hover:text-white' }}">
            <div class="w-8 h-8 flex items-center justify-center rounded-lg {{ request()->routeIs('dashboard') ? 'bg-white/20' : 'bg-slate-700/50 group-hover:bg-slate-600/50' }} transition-all duration-200">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"></path>
                </svg>
            </div>
            <span class="font-medium">Dashboard</span>
            @if(request()->routeIs('dashboard'))
                <div class="ml-auto w-2 h-2 bg-white rounded-full animate-pulse"></div>
            @endif
        </a>

        @auth
            @if(auth()->user()->role === 'dosen')
                <!-- Section Label -->
                <div class="px-3 py-2 mt-6 mb-2">
                    <div class="flex items-center">
                        <div class="w-8 h-[1px] bg-gradient-to-r from-blue-500 to-transparent"></div>
                        <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider mx-2">Dosen Menu</p>
                        <div class="flex-1 h-[1px] bg-gradient-to-l from-blue-500 to-transparent"></div>
                    </div>
                </div>

                <!-- Jadwal -->
                <a href="{{ route('jadwal.index') }}"
                    class="group flex items-center space-x-3 p-3 rounded-xl transition-all duration-200 hover:scale-[1.02] {{ request()->routeIs('jadwal.*') ? 'bg-gradient-to-r from-emerald-500 to-emerald-600 text-white shadow-lg shadow-emerald-500/25' : 'hover:bg-slate-700/50 text-slate-300 hover:text-white' }}">
                    <div class="w-8 h-8 flex items-center justify-center rounded-lg {{ request()->routeIs('jadwal.*') ? 'bg-white/20' : 'bg-slate-700/50 group-hover:bg-slate-600/50' }} transition-all duration-200">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2-2v16a2 2 0 002 2z">
                            </path>
                        </svg>
                    </div>
                    <span class="font-medium">Jadwal</span>
                    @if(request()->routeIs('jadwal.*'))
                        <div class="ml-auto w-2 h-2 bg-white rounded-full animate-pulse"></div>
                    @endif
                </a>

                <!-- Absensi -->
                <a href="{{ route('absensi.index') }}"
                    class="group flex items-center space-x-3 p-3 rounded-xl transition-all duration-200 {{ request()->routeIs('absensi.*') ? 'bg-gradient-to-r from-purple-500 to-purple-600 text-white shadow-lg' : 'hover:bg-gray-700/50 text-gray-300 hover:text-white' }}">
                    <div
                        class="w-8 h-8 flex items-center justify-center rounded-lg {{ request()->routeIs('absensi.*') ? 'bg-white/20' : 'bg-gray-700/50 group-hover:bg-gray-600/50' }} transition-all duration-200">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01">
                            </path>
                        </svg>
                    </div>
                    <span class="font-medium">Absensi</span>
                    @if(request()->routeIs('absensi.*'))
                        <div class="ml-auto w-2 h-2 bg-white rounded-full"></div>
                    @endif
                </a>

                <!-- Mata Kuliah -->
                <a href="{{ route('matakuliah.index') }}"
                    class="group flex items-center space-x-3 p-3 rounded-xl transition-all duration-200 {{ request()->routeIs('matakuliah.*') ? 'bg-gradient-to-r from-orange-500 to-orange-600 text-white shadow-lg' : 'hover:bg-gray-700/50 text-gray-300 hover:text-white' }}">
                    <div
                        class="w-8 h-8 flex items-center justify-center rounded-lg {{ request()->routeIs('matakuliah.*') ? 'bg-white/20' : 'bg-gray-700/50 group-hover:bg-gray-600/50' }} transition-all duration-200">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253">
                            </path>
                        </svg>
                    </div>
                    <span class="font-medium">Mata Kuliah</span>
                    @if(request()->routeIs('matakuliah.*'))
                        <div class="ml-auto w-2 h-2 bg-white rounded-full"></div>
                    @endif
                </a>
            @endif

            @if(auth()->user()->role === 'mahasiswa')
                <!-- Section Label -->
                <div class="px-3 py-2 mt-6 mb-2">
                    <div class="flex items-center">
                        <div class="w-8 h-[1px] bg-gradient-to-r from-emerald-500 to-transparent"></div>
                        <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider mx-2">Mahasiswa Menu</p>
                        <div class="flex-1 h-[1px] bg-gradient-to-l from-emerald-500 to-transparent"></div>
                    </div>
                </div>

                <!-- Jadwal Kuliah -->
                <a href="{{ route('mahasiswa.jadwal') }}"
                    class="group flex items-center space-x-3 p-3 rounded-xl transition-all duration-200 {{ request()->routeIs('mahasiswa.jadwal') ? 'bg-gradient-to-r from-green-500 to-green-600 text-white shadow-lg' : 'hover:bg-gray-700/50 text-gray-300 hover:text-white' }}">
                    <div
                        class="w-8 h-8 flex items-center justify-center rounded-lg {{ request()->routeIs('mahasiswa.jadwal') ? 'bg-white/20' : 'bg-gray-700/50 group-hover:bg-gray-600/50' }} transition-all duration-200">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2-2v16a2 2 0 002 2z">
                            </path>
                        </svg>
                    </div>
                    <span class="font-medium">Jadwal Kuliah</span>
                    @if(request()->routeIs('mahasiswa.jadwal'))
                        <div class="ml-auto w-2 h-2 bg-white rounded-full"></div>
                    @endif
                </a>

                <!-- Scan Absen -->
                <a href="{{ route('scan.index') }}"
                    class="group flex items-center space-x-3 p-3 rounded-xl transition-all duration-200 {{ request()->routeIs('scan.*') ? 'bg-gradient-to-r from-blue-500 to-blue-600 text-white shadow-lg' : 'hover:bg-gray-700/50 text-gray-300 hover:text-white' }}">
                    <div
                        class="w-8 h-8 flex items-center justify-center rounded-lg {{ request()->routeIs('scan.*') ? 'bg-white/20' : 'bg-gray-700/50 group-hover:bg-gray-600/50' }} transition-all duration-200">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z">
                            </path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                    </div>
                    <span class="font-medium">Scan Absen</span>
                    @if(request()->routeIs('scan.*'))
                        <div class="ml-auto w-2 h-2 bg-white rounded-full"></div>
                    @endif
                </a>
                <!-- Riwayat Absen -->
                <a href="{{ route('mahasiswa.absensi') }}"
                    class="group flex items-center space-x-3 p-3 rounded-xl transition-all duration-200 {{ request()->routeIs('mahasiswa.absensi') ? 'bg-gradient-to-r from-purple-500 to-purple-600 text-white shadow-lg' : 'hover:bg-gray-700/50 text-gray-300 hover:text-white' }}">
                    <div
                        class="w-8 h-8 flex items-center justify-center rounded-lg {{ request()->routeIs('mahasiswa.absensi') ? 'bg-white/20' : 'bg-gray-700/50 group-hover:bg-gray-600/50' }} transition-all duration-200">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01">
                            </path>
                        </svg>
                    </div>
                    <span class="font-medium">Riwayat Absen</span>
                    @if(request()->routeIs('mahasiswa.absensi'))
                        <div class="ml-auto w-2 h-2 bg-white rounded-full"></div>
                    @endif
                </a>
            @endif
            @if(auth()->user()->role === 'mahasiswa' && auth()->user()->status == 'ketua_kelas')
                <!-- Absen Anggota -->
                <a href="{{ route('mahasiswa.absen-anggota') }}"
                    class="group flex items-center space-x-3 p-3 rounded-xl transition-all duration-200 {{ request()->routeIs('mahasiswa.absen-anggota.*') ? 'bg-gradient-to-r from-orange-500 to-orange-600 text-white shadow-lg' : 'hover:bg-gray-700/50 text-gray-300 hover:text-white' }}">
                    <div
                        class="w-8 h-8 flex items-center justify-center rounded-lg {{ request()->routeIs('mahasiswa.absen-anggota.*') ? 'bg-white/20' : 'bg-gray-700/50 group-hover:bg-gray-600/50' }} transition-all duration-200">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                            </path>
                        </svg>
                    </div>
                    <span class="font-medium">Absen Anggota</span>
                    @if(request()->routeIs('mahasiswa.absen-anggota.*'))
                        <div class="ml-auto w-2 h-2 bg-white rounded-full"></div>
                    @endif
                </a>
            @endif
        @endauth

        <!-- Divider -->
        <div class="my-4 mx-3">
            <div class="h-px bg-gradient-to-r from-transparent via-slate-600 to-transparent"></div>
        </div>

        <!-- Logout -->
        @auth
            <form action="{{ route('logout') }}" method="POST" class="px-1">
                @csrf
                <button type="submit"
                    class="w-full group flex items-center space-x-3 p-3 rounded-xl bg-gradient-to-r from-red-500/20 to-red-600/20 hover:from-red-500/30 hover:to-red-600/30 text-red-300 hover:text-white transition-all duration-200 text-left border border-red-500/30 hover:border-red-400/50 shadow-lg hover:shadow-red-500/20 hover:scale-[1.02]">
                    <div class="w-8 h-8 flex items-center justify-center rounded-lg bg-red-500/30 group-hover:bg-red-500/50 transition-all duration-200">
                        <svg class="w-4 h-4 transition-transform duration-200 group-hover:rotate-12" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                            </path>
                        </svg>
                    </div>
                    <span class="font-medium">Logout</span>
                    <div class="ml-auto">
                        <svg class="w-4 h-4 transition-transform duration-200 group-hover:translate-x-1" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </div>
                </button>
            </form>
        @endauth
    </nav>

    <!-- Footer -->
    <div class="p-4 border-t border-slate-700/50 bg-slate-800/30">
        <div class="text-center">
            <div class="flex items-center justify-center space-x-2 mb-1">
                <div class="w-2 h-2 bg-emerald-500 rounded-full animate-pulse"></div>
                <p class="text-xs text-slate-400 font-medium">© 2025 ClassAttend</p>
            </div>
            <p class="text-xs text-slate-500">QR Code Attendance System</p>
        </div>
    </div>
</div>