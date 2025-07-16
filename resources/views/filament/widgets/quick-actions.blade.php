<x-filament::widget>
    <x-filament::section>
        <x-slot name="heading">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-3">
                    <div class="w-2 h-8 bg-indigo-500 rounded-full"></div>
                    <span class="text-xl font-bold text-gray-900 dark:text-white">
                        Dashboard Kontrol
                    </span>
                </div>
                <div class="flex items-center space-x-2">
                    <div class="w-2 h-2 bg-green-400 rounded-full"></div>
                    <span class="text-sm text-gray-500 dark:text-gray-400">{{ $hariIndonesia }}, {{ $tanggalIndonesia }}</span>
                </div>
            </div>
        </x-slot>

        {{-- Modern Stats Cards --}}
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
            <div class="bg-blue-50 dark:bg-blue-900/20 rounded-xl p-6 border border-blue-200 dark:border-blue-800">
                <div class="flex items-center justify-between">
                    <div class="space-y-2">
                        <p class="text-blue-600 dark:text-blue-400 text-sm font-medium">Jadwal Hari Ini</p>
                        <p class="text-3xl font-bold text-blue-900 dark:text-blue-100">{{ $jadwalHariIni }}</p>
                        <p class="text-xs text-blue-500 dark:text-blue-400">
                            @if($jadwalHariIni > 0) 
                                {{ $jadwalHariIni }} kelas aktif
                            @else 
                                Tidak ada jadwal
                            @endif
                        </p>
                    </div>
                    <div class="w-16 h-16 bg-blue-500 rounded-xl flex items-center justify-center">
                        <x-heroicon-o-calendar-days class="w-8 h-8 text-white" />
                    </div>
                </div>
            </div>

            <div class="bg-emerald-50 dark:bg-emerald-900/20 rounded-xl p-6 border border-emerald-200 dark:border-emerald-800">
                <div class="flex items-center justify-between">
                    <div class="space-y-2">
                        <p class="text-emerald-600 dark:text-emerald-400 text-sm font-medium">Absensi Hari Ini</p>
                        <p class="text-3xl font-bold text-emerald-900 dark:text-emerald-100">{{ $absensiHariIni }}</p>
                        <p class="text-xs text-emerald-500 dark:text-emerald-400">
                            @if($absensiHariIni > 0) 
                                {{ $absensiHariIni }} kehadiran tercatat
                            @else 
                                Belum ada absensi
                            @endif
                        </p>
                    </div>
                    <div class="w-16 h-16 bg-emerald-500 rounded-xl flex items-center justify-center">
                        <x-heroicon-o-check-circle class="w-8 h-8 text-white" />
                    </div>
                </div>
            </div>

            <div class="bg-purple-50 dark:bg-purple-900/20 rounded-xl p-6 border border-purple-200 dark:border-purple-800">
                <div class="flex items-center justify-between">
                    <div class="space-y-2">
                        <p class="text-purple-600 dark:text-purple-400 text-sm font-medium">Total Mahasiswa</p>
                        <p class="text-3xl font-bold text-purple-900 dark:text-purple-100">{{ $totalMahasiswa }}</p>
                        <p class="text-xs text-purple-500 dark:text-purple-400">
                            {{ $totalMahasiswa }} mahasiswa terdaftar
                        </p>
                    </div>
                    <div class="w-16 h-16 bg-purple-500 rounded-xl flex items-center justify-center">
                        <x-heroicon-o-user-group class="w-8 h-8 text-white" />
                    </div>
                </div>
            </div>
        </div>

        {{-- Quick Actions Section --}}
        <div class="space-y-8">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-3">
                    <div class="w-8 h-8 bg-indigo-500 rounded-lg flex items-center justify-center">
                        <x-heroicon-o-bolt class="w-5 h-5 text-white" />
                    </div>
                    <h2 class="text-lg font-bold text-gray-900 dark:text-white">Aksi Cepat</h2>
                </div>
                <div class="text-xs text-gray-500 dark:text-gray-400 px-3 py-1 bg-gray-100 dark:bg-gray-800 rounded-full">
                    4 aksi tersedia
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-6">
                {{-- Create Schedule --}}
                <a href="{{ route('filament.admin.resources.jadwals.create') }}" 
                   class="block bg-white dark:bg-gray-900 rounded-xl p-6 border border-gray-200 dark:border-gray-800 hover:border-blue-300 hover:shadow-lg transition-all duration-200">
                    <div class="w-12 h-12 bg-blue-500 rounded-lg flex items-center justify-center mb-4">
                        <x-heroicon-o-calendar-days class="w-6 h-6 text-white" />
                    </div>
                    <h3 class="font-bold text-gray-900 dark:text-white mb-2">Buat Jadwal</h3>
                    <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">Buat jadwal kuliah baru dengan mudah dan cepat</p>
                    <div class="flex items-center text-blue-600 dark:text-blue-400 text-sm font-medium">
                        <span>Mulai sekarang</span>
                        <x-heroicon-o-arrow-right class="w-4 h-4 ml-2" />
                    </div>
                </a>

                {{-- Create Subject --}}
                <a href="{{ route('filament.admin.resources.matakuliahs.create') }}" 
                   class="block bg-white dark:bg-gray-900 rounded-xl p-6 border border-gray-200 dark:border-gray-800 hover:border-orange-300 hover:shadow-lg transition-all duration-200">
                    <div class="w-12 h-12 bg-orange-500 rounded-lg flex items-center justify-center mb-4">
                        <x-heroicon-o-book-open class="w-6 h-6 text-white" />
                    </div>
                    <h3 class="font-bold text-gray-900 dark:text-white mb-2">Mata Kuliah</h3>
                    <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">Tambahkan mata kuliah baru ke dalam sistem</p>
                    <div class="flex items-center text-orange-600 dark:text-orange-400 text-sm font-medium">
                        <span>Tambah sekarang</span>
                        <x-heroicon-o-arrow-right class="w-4 h-4 ml-2" />
                    </div>
                </a>

                {{-- Create Student --}}
                <a href="{{ route('filament.admin.resources.mahasiswas.create') }}" 
                   class="block bg-white dark:bg-gray-900 rounded-xl p-6 border border-gray-200 dark:border-gray-800 hover:border-emerald-300 hover:shadow-lg transition-all duration-200">
                    <div class="w-12 h-12 bg-emerald-500 rounded-lg flex items-center justify-center mb-4">
                        <x-heroicon-o-user-plus class="w-6 h-6 text-white" />
                    </div>
                    <h3 class="font-bold text-gray-900 dark:text-white mb-2">Mahasiswa</h3>
                    <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">Daftarkan mahasiswa baru ke dalam sistem</p>
                    <div class="flex items-center text-emerald-600 dark:text-emerald-400 text-sm font-medium">
                        <span>Daftar sekarang</span>
                        <x-heroicon-o-arrow-right class="w-4 h-4 ml-2" />
                    </div>
                </a>

                {{-- Create Teacher --}}
                <a href="{{ route('filament.admin.resources.dosens.create') }}" 
                   class="block bg-white dark:bg-gray-900 rounded-xl p-6 border border-gray-200 dark:border-gray-800 hover:border-purple-300 hover:shadow-lg transition-all duration-200">
                    <div class="w-12 h-12 bg-purple-500 rounded-lg flex items-center justify-center mb-4">
                        <x-heroicon-o-academic-cap class="w-6 h-6 text-white" />
                    </div>
                    <h3 class="font-bold text-gray-900 dark:text-white mb-2">Dosen</h3>
                    <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">Tambahkan data dosen pengajar baru</p>
                    <div class="flex items-center text-purple-600 dark:text-purple-400 text-sm font-medium">
                        <span>Tambah sekarang</span>
                        <x-heroicon-o-arrow-right class="w-4 h-4 ml-2" />
                    </div>
                </a>
            </div>
        </div>

        {{-- Navigation Section --}}
        <div class="mt-10 space-y-6">
            <div class="flex items-center space-x-3">
                <div class="w-8 h-8 bg-gray-600 rounded-lg flex items-center justify-center">
                    <x-heroicon-o-squares-2x2 class="w-5 h-5 text-white" />
                </div>
                <h2 class="text-lg font-bold text-gray-900 dark:text-white">Navigasi Cepat</h2>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <a href="{{ route('filament.admin.resources.jadwals.index') }}" 
                   class="block bg-blue-50 dark:bg-blue-900/10 rounded-xl p-6 border border-blue-200 dark:border-blue-800 hover:shadow-lg transition-all duration-200">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-4">
                            <div class="w-14 h-14 bg-blue-500 rounded-xl flex items-center justify-center">
                                <x-heroicon-o-calendar-days class="w-7 h-7 text-white" />
                            </div>
                            <div>
                                <h3 class="text-lg font-bold text-gray-900 dark:text-white">Kelola Jadwal</h3>
                                <p class="text-sm text-gray-600 dark:text-gray-400">Lihat dan kelola semua jadwal kuliah</p>
                                <div class="mt-2">
                                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-400">
                                        {{ $jadwalHariIni }} hari ini
                                    </span>
                                </div>
                            </div>
                        </div>
                        <x-heroicon-o-chevron-right class="w-6 h-6 text-gray-400" />
                    </div>
                </a>

                <a href="{{ route('filament.admin.resources.mahasiswas.index') }}" 
                   class="block bg-emerald-50 dark:bg-emerald-900/10 rounded-xl p-6 border border-emerald-200 dark:border-emerald-800 hover:shadow-lg transition-all duration-200">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-4">
                            <div class="w-14 h-14 bg-emerald-500 rounded-xl flex items-center justify-center">
                                <x-heroicon-o-user-group class="w-7 h-7 text-white" />
                            </div>
                            <div>
                                <h3 class="text-lg font-bold text-gray-900 dark:text-white">Data Mahasiswa</h3>
                                <p class="text-sm text-gray-600 dark:text-gray-400">Kelola profil dan informasi mahasiswa</p>
                                <div class="mt-2">
                                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-emerald-100 text-emerald-800 dark:bg-emerald-900/30 dark:text-emerald-400">
                                        {{ $totalMahasiswa }} terdaftar
                                    </span>
                                </div>
                            </div>
                        </div>
                        <x-heroicon-o-chevron-right class="w-6 h-6 text-gray-400" />
                    </div>
                </a>
            </div>
        </div>

        {{-- System Status --}}
        <div class="mt-8 p-4 bg-gray-50 dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-3">
                    <div class="w-2 h-2 bg-green-400 rounded-full"></div>
                    <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Sistem Online</span>
                </div>
                <div class="flex items-center space-x-4 text-xs text-gray-500 dark:text-gray-400">
                    <span>{{ now()->format('H:i:s') }}</span>
                    <span>•</span>
                    <span>Server Aktif</span>
                </div>
            </div>
        </div>
    </x-filament::section>
</x-filament::widget>
