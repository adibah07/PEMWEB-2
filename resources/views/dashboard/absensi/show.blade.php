@extends('dashboard.layout.index')

@section('content')
<div class="container mx-auto">
    <div class="bg-white rounded-lg shadow-md p-6 mb-6">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Absensi Mahasiswa</h1>
                <p class="text-gray-600 mt-1">Mata Kuliah: <span class="font-semibold">{{ $jadwal->matakuliah->nama }}</span></p>
                <p class="text-gray-600 mt-1">Tanggal: <span class="font-semibold">{{ $jadwal->tanggal ? $jadwal->tanggal->format('d/m/Y') . ' (' . $jadwal->tanggal->format('l') . ')' : 'Belum diatur' }}</span> | Jam: <span class="font-semibold">{{ date('H:i', strtotime($jadwal->jam_mulai)) }} - {{ date('H:i', strtotime($jadwal->jam_selesai)) }}</span></p>
            </div>
            <div>
                <a href="{{ route('absensi.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded-lg">Kembali</a>
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
    @endif

    <!-- QR Code Section -->
    <div class="bg-white rounded-lg shadow-md p-6 mb-6 flex flex-col md:flex-row md:items-center md:justify-between">
        <div>
            <h2 class="text-lg font-bold text-gray-800 mb-2">Absensi QR Code</h2>
            @if($activeQrCode)
                <div class="flex items-center space-x-4">
                    <span class="text-green-600 font-semibold">QR Code Aktif</span>
                    <span class="text-xs bg-green-100 text-green-800 px-2 py-1 rounded">Expired: {{ $activeQrCode->expired_at->format('H:i') }}</span>
                    <a href="{{ route('qrcode.show', $activeQrCode) }}" class="text-blue-600 hover:underline">Lihat QR</a>
                </div>
            @else
                <span class="text-gray-500">Belum ada QR Code aktif untuk jadwal ini.</span>
                <a href="{{ route('qrcode.generate', $jadwal) }}" class="ml-4 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg">Generate QR Code</a>
            @endif
        </div>
    </div>

    <!-- Manual Absensi Form -->
    <div class="bg-white rounded-lg shadow-md p-6 mb-6">
        <h2 class="text-lg font-bold text-gray-800 mb-4">Absensi Manual</h2>
        <form action="{{ route('absensi.store', $jadwal) }}" method="POST">
            @csrf
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pilih</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">NIM</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($jadwal->mahasiswa as $mahasiswa)
                            <tr>
                                <td class="px-4 py-2">
                                    <input type="checkbox" name="mahasiswa_ids[]" value="{{ $mahasiswa->id }}"
                                        {{ isset($absensiToday[$mahasiswa->id]) ? 'disabled checked' : '' }}>
                                </td>
                                <td class="px-4 py-2">{{ $mahasiswa->user->name }}</td>
                                <td class="px-4 py-2">{{ $mahasiswa->nim }}</td>
                                <td class="px-4 py-2">
                                    @if(isset($absensiToday[$mahasiswa->id]))
                                        <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">Sudah Absen</span>
                                    @else
                                        <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-gray-100 text-gray-800">Belum Absen</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="mt-4 flex flex-col md:flex-row md:items-center md:space-x-4">
                <div>
                    <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status Absensi</label>
                    <select name="status" id="status" class="px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500" required>
                        <option value="hadir">Hadir</option>
                        <option value="izin">Izin</option>
                        <option value="sakit">Sakit</option>
                        <option value="alpa">Alpa</option>
                    </select>
                </div>
                <div class="flex-1 mt-2 md:mt-0">
                    <label for="keterangan" class="block text-sm font-medium text-gray-700 mb-1">Keterangan (opsional)</label>
                    <input type="text" name="keterangan" id="keterangan" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500">
                </div>
                <div class="mt-4 md:mt-0">
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-lg">Simpan Absensi</button>
                </div>
            </div>
        </form>
    </div>

    <!-- Rekap Absensi Hari Ini -->
    <div class="bg-white rounded-lg shadow-md p-6">
        <h2 class="text-lg font-bold text-gray-800 mb-4">Rekap Absensi Hari Ini</h2>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">NIM</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Waktu Absen</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Keterangan</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($absensiToday as $absen)
                        <tr>
                            <td class="px-4 py-2">{{ $absen->mahasiswa->user->name ?? '-' }}</td>
                            <td class="px-4 py-2">{{ $absen->mahasiswa->nim ?? '-' }}</td>
                            <td class="px-4 py-2">
                                <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full 
                                    @if($absen->status == 'hadir') bg-green-100 text-green-800
                                    @elseif($absen->status == 'izin') bg-yellow-100 text-yellow-800
                                    @elseif($absen->status == 'sakit') bg-blue-100 text-blue-800
                                    @else bg-red-100 text-red-800 @endif">
                                    {{ ucfirst($absen->status) }}
                                </span>
                            </td>
                            <td class="px-4 py-2">{{ $absen->waktu_absen ? $absen->waktu_absen->format('H:i') : '-' }}</td>
                            <td class="px-4 py-2">{{ $absen->keterangan ?? '-' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-gray-500 py-4">Belum ada absensi hari ini.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
