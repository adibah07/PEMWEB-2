@extends('dashboard.layout.index')

@section('content')
<div class="container mx-auto">
    <!-- Header -->
    <div class="bg-white rounded-lg shadow-md p-6 mb-6">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Manajemen Absensi</h1>
                <p class="text-gray-600 mt-1">Kelola absensi mahasiswa berdasarkan jadwal mata kuliah</p>
            </div>
            <div class="flex items-center space-x-2">
                <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
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
    @endif    <!-- Pilih Jadwal -->
    @if($jadwals->count() > 0)
        <div class="bg-white rounded-lg shadow-md">
            <div class="p-6 border-b border-gray-200">
                <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
                    <div>
                        <h2 class="text-lg font-semibold text-gray-800">Pilih Jadwal untuk Absensi</h2>
                        <p class="text-sm text-gray-600 mt-1">Klik pada jadwal untuk mengelola absensi mahasiswa</p>
                    </div>
                    
                    <!-- Filter dan Sorting -->
                    <div class="flex flex-col sm:flex-row gap-3">
                        <form method="GET" action="{{ route('absensi.index') }}" class="flex flex-col sm:flex-row gap-2">
                            <!-- Filter Tanggal -->
                            <input 
                                type="date" 
                                name="tanggal" 
                                value="{{ $filterTanggal }}"
                                class="px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500 text-sm"
                                placeholder="Filter Tanggal"
                            >
                            
                            <!-- Sort By -->
                            <select name="sort_by" class="px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500 text-sm">
                                <option value="tanggal" {{ $sortBy === 'tanggal' ? 'selected' : '' }}>Urutkan: Tanggal</option>
                                <option value="mata_kuliah" {{ $sortBy === 'mata_kuliah' ? 'selected' : '' }}>Urutkan: Mata Kuliah</option>
                                <option value="waktu" {{ $sortBy === 'waktu' ? 'selected' : '' }}>Urutkan: Waktu</option>
                            </select>
                            
                            <!-- Sort Order -->
                            <select name="sort_order" class="px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500 text-sm">
                                <option value="desc" {{ $sortOrder === 'desc' ? 'selected' : '' }}>Terbaru</option>
                                <option value="asc" {{ $sortOrder === 'asc' ? 'selected' : '' }}>Terlama</option>
                            </select>
                            
                            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm">
                                Filter
                            </button>
                            
                            <a href="{{ route('absensi.index') }}" class="px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-400 text-sm text-center">
                                Reset
                            </a>
                        </form>
                    </div>
                </div>            </div>
            
            <!-- Info hasil -->
            @if($filterTanggal || $sortBy !== 'tanggal' || $sortOrder !== 'desc')
                <div class="px-6 py-3 bg-blue-50 border-b border-blue-200">
                    <div class="flex items-center justify-between text-sm">
                        <div class="flex items-center space-x-4">
                            <span class="text-blue-800 font-medium">Menampilkan {{ $jadwals->count() }} jadwal</span>
                            @if($filterTanggal)
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                    Filter: {{ \Carbon\Carbon::parse($filterTanggal)->format('d/m/Y') }}
                                </span>
                            @endif
                            @if($sortBy !== 'tanggal' || $sortOrder !== 'desc')
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                    Urut: {{ ucfirst(str_replace('_', ' ', $sortBy)) }} ({{ $sortOrder === 'desc' ? 'Terbaru' : 'Terlama' }})
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
            @endif
            
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Mata Kuliah</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Waktu</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Ruangan</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Mahasiswa</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($jadwals as $jadwal)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="font-medium text-gray-900">{{ $jadwal->matakuliah->nama }}</div>
                                    <div class="text-sm text-gray-500">{{ $jadwal->matakuliah->kode }}</div>
                                </td>                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="font-medium text-gray-900">{{ $jadwal->tanggal->format('d/m/Y') }}</div>
                                    <div class="text-sm text-gray-500">{{ $jadwal->tanggal->format('l') }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{ date('H:i', strtotime($jadwal->jam_mulai)) }} - {{ date('H:i', strtotime($jadwal->jam_selesai)) }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{ $jadwal->ruangan ?: 'Tidak ditentukan' }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <span class="text-sm font-medium text-gray-900">{{ $jadwal->mahasiswa->count() }}</span>
                                        <span class="text-xs text-gray-500 ml-1">mahasiswa</span>
                                    </div>
                                </td>                                <td class="px-6 py-4 whitespace-nowrap">
                                    @php
                                        $today = \Carbon\Carbon::today();
                                        // Hitung jumlah status untuk masing-masing kategori
                                        $hadirCount = \App\Models\Absensi::where('jadwal_id', $jadwal->id)
                                            ->whereDate('created_at', $today)
                                            ->where('status', 'hadir')
                                            ->count();
                                        
                                        $sakitCount = \App\Models\Absensi::where('jadwal_id', $jadwal->id)
                                            ->whereDate('created_at', $today)
                                            ->where('status', 'sakit')
                                            ->count();
                                            
                                        $izinCount = \App\Models\Absensi::where('jadwal_id', $jadwal->id)
                                            ->whereDate('created_at', $today)
                                            ->where('status', 'izin')
                                            ->count();
                                            
                                        $alpaCount = \App\Models\Absensi::where('jadwal_id', $jadwal->id)
                                            ->whereDate('created_at', $today)
                                            ->where('status', 'alpa')
                                            ->count();
                                            
                                        $totalAbsensi = $hadirCount + $sakitCount + $izinCount + $alpaCount;
                                    @endphp
                                    @if($totalAbsensi > 0)
                                        <div class="flex flex-wrap gap-1">
                                            @if($hadirCount > 0)
                                                <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                                    {{ $hadirCount }} hadir
                                                </span>
                                            @endif
                                            
                                        </div>
                                    @else
                                        <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-gray-100 text-gray-800">
                                            Belum ada absensi
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium space-x-2">
                                    <a href="{{ route('absensi.show', $jadwal) }}" 
                                       class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg inline-flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                                        </svg>
                                        Kelola Absensi
                                    </a>
                                    <a href="{{ route('qrcode.generate', $jadwal) }}" 
                                       class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-lg inline-flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                        </svg>
                                        QR Code
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @else
        <div class="bg-white rounded-lg shadow-md p-8 text-center">
            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v16a2 2 0 002 2z"></path>
            </svg>
            <h3 class="mt-2 text-lg font-medium text-gray-900">Belum ada jadwal</h3>
            <p class="mt-1 text-gray-500">Anda belum memiliki jadwal mata kuliah. Silakan buat jadwal terlebih dahulu.</p>
            <div class="mt-6">
                <a href="{{ route('jadwal.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg">
                    <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    Buat Jadwal Baru
                </a>
            </div>
        </div>
    @endif
</div>
@endsection
