@extends('dashboard.layout.index')

@section('content')
<div class="container mx-auto">
    <!-- Header -->
    <div class="bg-white rounded-lg shadow-md p-6 mb-6">
        <div class="flex items-center justify-between">
            <div class="flex items-center">
                <a href="{{ route('jadwal.index') }}" class="mr-4 text-gray-600 hover:text-gray-800">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                </a>
                <div>
                    <h1 class="text-2xl font-bold text-gray-800">Detail Jadwal</h1>
                    <p class="text-gray-600 mt-1">{{ $jadwal->matakuliah->nama }}</p>
                </div>
            </div>
            {{-- <div class="flex space-x-2">
                <a href="{{ route('jadwal.edit', $jadwal) }}" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded-lg">
                    <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                    </svg>
                    Edit
                </a>
                <form action="{{ route('jadwal.destroy', $jadwal) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus jadwal ini?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-lg">
                        <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                        </svg>
                        Hapus
                    </button>
                </form>
            </div> --}}
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

    <!-- Informasi Jadwal -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
        <!-- Detail Jadwal -->
        <div class="lg:col-span-2 bg-white rounded-lg shadow-md p-6">
            <h2 class="text-xl font-bold text-gray-800 mb-4">Informasi Jadwal</h2>
            <div class="space-y-4">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Mata Kuliah</label>
                        <p class="text-lg font-semibold text-gray-900">{{ $jadwal->matakuliah->nama }}</p>
                        <p class="text-sm text-gray-500">{{ $jadwal->matakuliah->kode }}</p>
                    </div>                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal</label>
                        <span class="inline-flex px-3 py-1 text-sm font-semibold rounded-full bg-blue-100 text-blue-800">
                            {{ $jadwal->tanggal ? $jadwal->tanggal->format('d/m/Y') . ' (' . $jadwal->tanggal->format('l') . ')' : 'Belum diatur' }}
                        </span>
                    </div>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Jam Mulai</label>
                        <p class="text-lg font-semibold text-gray-900">{{ date('H:i', strtotime($jadwal->jam_mulai)) }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Jam Selesai</label>
                        <p class="text-lg font-semibold text-gray-900">{{ date('H:i', strtotime($jadwal->jam_selesai)) }}</p>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Ruangan</label>
                    <p class="text-lg font-semibold text-gray-900">{{ $jadwal->ruangan ?: 'Tidak ditentukan' }}</p>
                </div>                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Durasi</label>
                    <p class="text-lg font-semibold text-gray-900">
                        @php
                            $start = strtotime($jadwal->jam_mulai);
                            $end = strtotime($jadwal->jam_selesai);
                            $duration = ($end - $start) / 3600;
                        @endphp
                        {{ number_format($duration, 1) }} jam
                    </p>
                </div>
            </div>
        </div>

        <!-- Daftar Mahasiswa Terdaftar -->
        <div class="bg-white rounded-lg shadow-md p-6 mb-6">            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-bold text-gray-800">Mahasiswa Terdaftar</h2>
                <span class="bg-blue-100 text-blue-800 text-sm font-medium px-3 py-1 rounded-full">
                    {{ $jadwal->mahasiswa->count() }} mahasiswa
                </span>
            </div>
            
            @if($jadwal->mahasiswa->count() > 0)
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">NIM</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            </tr>
                        </thead>                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($jadwal->mahasiswa as $index => $mahasiswa)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $index + 1 }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="font-medium text-gray-900">{{ $mahasiswa->user->name }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $mahasiswa->nim }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $mahasiswa->user->email }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                            Terdaftar
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="text-center py-8">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                    <h3 class="mt-2 text-sm font-medium text-gray-900">Belum ada mahasiswa terdaftar</h3>
                    <p class="mt-1 text-sm text-gray-500">Mahasiswa dapat ditambahkan saat mengedit jadwal.</p>
                    <div class="mt-4">
                        <a href="{{ route('jadwal.edit', $jadwal) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg text-sm">
                            Edit Jadwal
                        </a>
                    </div>
                </div>
            @endif
        </div>

        <!-- Quick Stats -->
        <div class="space-y-6">
            <div class="bg-white rounded-lg shadow-md p-6">
                <h3 class="text-lg font-bold text-gray-800 mb-4">Statistik</h3>                <div class="space-y-4">                    <div class="flex justify-between items-center">
                        <span class="text-sm text-gray-600">Mahasiswa Terdaftar</span>
                        <span class="text-xl font-bold text-indigo-600">{{ $jadwal->mahasiswa->count() }}</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-gray-600">Total Absensi</span>
                        <span class="text-xl font-bold text-blue-600">{{ $jadwal->absensi->count() }}</span>
                    </div><div class="flex justify-between items-center">
                        <span class="text-sm text-gray-600">QR Code</span>
                        <div class="flex items-center space-x-2">
                            <span class="text-xl font-bold text-green-600">{{ $jadwal->qrcodes->count() }}</span>
                            @if($jadwal->qrcodes->count() > 0)
                                <a href="{{ route('qrcode.index', $jadwal) }}" class="text-xs text-blue-600 hover:text-blue-800">Lihat</a>
                            @endif
                        </div>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-gray-600">Status</span>
                        <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                            Aktif
                        </span>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-md p-6">
                <h3 class="text-lg font-bold text-gray-800 mb-4">Quick Actions</h3>
                <div class="space-y-3">                    <a href="{{ route('qrcode.generate', $jadwal) }}" class="w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg text-sm text-center block">
                        <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                        Generate QR Code
                    </a>
                    <a href="{{ route('jadwal.index') }}" class="w-full bg-purple-500 hover:bg-purple-700 text-white font-bold py-2 px-4 rounded-lg text-sm text-center block">
                        <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2-2v16a2 2 0 002 2z"></path>
                        </svg>
                        Jadwal Lainnya
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Absensi -->
    @if($jadwal->absensi->count() > 0)
        <div class="bg-white rounded-lg shadow-md p-6">
            <h2 class="text-xl font-bold text-gray-800 mb-4">Absensi Terbaru</h2>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Mahasiswa</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Waktu Absen</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($jadwal->absensi->take(5) as $absen)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="font-medium text-gray-900">{{ $absen->mahasiswa->user->name ?? 'N/A' }}</div>
                                    <div class="text-sm text-gray-500">{{ $absen->mahasiswa->nim ?? 'N/A' }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{ $absen->created_at->format('d/m/Y H:i') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                        Hadir
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @if($jadwal->absensi->count() > 5)
                <div class="text-center mt-4">
                    <button class="text-blue-600 hover:text-blue-800 font-medium">
                        Lihat semua absensi ({{ $jadwal->absensi->count() }} total)
                    </button>
                </div>
            @endif
        </div>
    @else
        <div class="bg-white rounded-lg shadow-md p-6 text-center">
            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
            </svg>
            <h3 class="mt-2 text-sm font-medium text-gray-900">Belum ada absensi</h3>
            <p class="mt-1 text-sm text-gray-500">Absensi mahasiswa akan muncul di sini setelah mereka melakukan absen.</p>
        </div>
    @endif
</div>
@endsection
