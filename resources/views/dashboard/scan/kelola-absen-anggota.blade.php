@extends('dashboard.layout.index')

@section('title', 'Kelola Absensi Anggota')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-6">
        <div class="flex items-center justify-between mb-4">
            <div class="flex items-center space-x-4">
                <a href="{{ route('mahasiswa.absen-anggota') }}" 
                   class="w-10 h-10 bg-gray-100 dark:bg-gray-700 rounded-lg flex items-center justify-center hover:bg-gray-200 dark:hover:bg-gray-600 transition-colors">
                    <svg class="w-5 h-5 text-gray-600 dark:text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                </a>
                <div>
                    <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Kelola Absensi Anggota</h1>
                    <p class="text-gray-600 dark:text-gray-400">{{ $jadwal->matakuliah->nama }} - {{ $jadwal->matakuliah->kode }}</p>
                </div>
            </div>
            <div class="text-right">
                <p class="text-sm text-gray-500 dark:text-gray-400">{{ date('d M Y') }}</p>
                <p class="text-lg font-semibold text-gray-900 dark:text-white">
                    {{ date('H:i', strtotime($jadwal->jam_mulai)) }} - {{ date('H:i', strtotime($jadwal->jam_selesai)) }}
                </p>
            </div>
        </div>

        <!-- Jadwal Info -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 p-4 bg-gray-50 dark:bg-gray-700/50 rounded-lg">
            <div>
                <p class="text-sm text-gray-500 dark:text-gray-400">Dosen</p>
                <p class="font-medium text-gray-900 dark:text-white">{{ $jadwal->matakuliah->dosen->user->name }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-500 dark:text-gray-400">Ruangan</p>
                <p class="font-medium text-gray-900 dark:text-white">{{ $jadwal->ruangan }}</p>
            </div>            <div>
                <p class="text-sm text-gray-500 dark:text-gray-400">Kelas</p>
                <p class="font-medium text-gray-900 dark:text-white">{{ $mahasiswa->kelas }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-500 dark:text-gray-400">SKS</p>
                <p class="font-medium text-gray-900 dark:text-white">{{ $jadwal->matakuliah->sks }}</p>
            </div>
        </div>
    </div>

    <!-- Form Absensi -->
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700">
        <div class="p-6 border-b border-gray-200 dark:border-gray-700">
            <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Daftar Mahasiswa Kelas {{ $mahasiswa->kelas }}</h2>
            <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">Pilih status kehadiran untuk setiap mahasiswa</p>
        </div>

        <form id="absensiForm" class="p-6">
            @csrf
            <div class="space-y-4">
                @foreach($mahasiswaKelas as $mhs)
                    <div class="flex items-center justify-between p-4 bg-gray-50 dark:bg-gray-700/50 rounded-lg {{ in_array($mhs->id, $absensiHariIni) ? 'opacity-50' : '' }}">
                        <div class="flex items-center space-x-3">
                            <div class="w-10 h-10 bg-gradient-to-r from-blue-500 to-blue-600 rounded-full flex items-center justify-center">
                                <span class="text-white font-semibold text-sm">{{ substr($mhs->user->name, 0, 2) }}</span>
                            </div>
                            <div>
                                <p class="font-medium text-gray-900 dark:text-white">{{ $mhs->user->name }}</p>
                                <p class="text-sm text-gray-600 dark:text-gray-400">{{ $mhs->nim }}</p>
                            </div>
                        </div>

                        @if(in_array($mhs->id, $absensiHariIni))
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900/20 dark:text-green-400">
                                Sudah Absen
                            </span>
                        @else
                            <div class="flex space-x-2">
                                <label class="inline-flex items-center">
                                    <input type="radio" name="absensi[{{ $mhs->id }}]" value="hadir" 
                                           class="form-radio text-green-600 dark:bg-gray-700 dark:border-gray-600" checked>
                                    <span class="ml-2 text-sm text-gray-700 dark:text-gray-300">Hadir</span>
                                </label>
                                <label class="inline-flex items-center">
                                    <input type="radio" name="absensi[{{ $mhs->id }}]" value="izin" 
                                           class="form-radio text-yellow-600 dark:bg-gray-700 dark:border-gray-600">
                                    <span class="ml-2 text-sm text-gray-700 dark:text-gray-300">Izin</span>
                                </label>
                                <label class="inline-flex items-center">
                                    <input type="radio" name="absensi[{{ $mhs->id }}]" value="sakit" 
                                           class="form-radio text-blue-600 dark:bg-gray-700 dark:border-gray-600">
                                    <span class="ml-2 text-sm text-gray-700 dark:text-gray-300">Sakit</span>
                                </label>
                                <label class="inline-flex items-center">
                                    <input type="radio" name="absensi[{{ $mhs->id }}]" value="alpa" 
                                           class="form-radio text-red-600 dark:bg-gray-700 dark:border-gray-600">
                                    <span class="ml-2 text-sm text-gray-700 dark:text-gray-300">Alpa</span>
                                </label>
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>

            <div class="mt-6 flex items-center justify-between">
                <div class="flex items-center space-x-4 text-sm text-gray-600 dark:text-gray-400">
                    <span>Total: {{ $mahasiswaKelas->count() }} mahasiswa</span>
                    <span>Sudah absen: {{ count($absensiHariIni) }} mahasiswa</span>
                </div>

                <button type="submit" id="submitBtn"
                        class="inline-flex items-center px-6 py-3 bg-orange-600 hover:bg-orange-700 disabled:bg-gray-400 text-white font-medium rounded-lg transition-colors duration-200">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    <span id="submitText">Simpan Absensi</span>
                </button>
            </div>
        </form>
    </div>

    <!-- Info -->
    <div class="bg-yellow-50 dark:bg-yellow-900/20 border border-yellow-200 dark:border-yellow-800 rounded-xl p-4">
        <div class="flex">
            <svg class="w-5 h-5 text-yellow-400 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16c-.77.833.192 2.5 1.732 2.5z"></path>
            </svg>
            <div class="ml-3">
                <h3 class="text-sm font-medium text-yellow-800 dark:text-yellow-300">Perhatian</h3>
                <p class="mt-1 text-sm text-yellow-700 dark:text-yellow-400">
                    Data absensi yang sudah tersimpan tidak dapat diubah. Pastikan status kehadiran sudah benar sebelum menyimpan.
                </p>
            </div>
        </div>
    </div>
</div>

<!-- Success/Error Toast -->
<div id="toast" class="fixed top-4 right-4 z-50 hidden"></div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('absensiForm');
    const submitBtn = document.getElementById('submitBtn');
    const submitText = document.getElementById('submitText');
    const toast = document.getElementById('toast');

    function showToast(message, type = 'success') {
        toast.className = `fixed top-4 right-4 z-50 px-6 py-3 rounded-lg shadow-lg ${type === 'success' ? 'bg-green-500' : 'bg-red-500'} text-white`;
        toast.textContent = message;
        toast.classList.remove('hidden');
        
        setTimeout(() => {
            toast.classList.add('hidden');
        }, 3000);
    }

    form.addEventListener('submit', function(e) {
        e.preventDefault();
        
        // Disable button
        submitBtn.disabled = true;
        submitText.textContent = 'Menyimpan...';
        
        // Get form data
        const formData = new FormData(form);
        
        // Send request
        fetch('{{ route("mahasiswa.absen-anggota.store", $jadwal->id) }}', {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                showToast(data.message, 'success');
                // Reload page after 2 seconds
                setTimeout(() => {
                    window.location.reload();
                }, 2000);
            } else {
                showToast(data.message, 'error');
                // Re-enable button
                submitBtn.disabled = false;
                submitText.textContent = 'Simpan Absensi';
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showToast('Terjadi kesalahan saat menyimpan data', 'error');
            // Re-enable button
            submitBtn.disabled = false;
            submitText.textContent = 'Simpan Absensi';
        });
    });
});
</script>
@endsection
