@extends('dashboard.layout.index')

@section('content')
<div class="container mx-auto">
    <!-- Header -->
    <div class="bg-white rounded-lg shadow-md p-6 mb-6">
        <div class="flex items-center">
            <a href="{{ route('jadwal.index') }}" class="mr-4 text-gray-600 hover:text-gray-800">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
            </a>
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Edit Jadwal</h1>
                <p class="text-gray-600 mt-1">Ubah informasi jadwal mata kuliah</p>
            </div>
        </div>
    </div>

    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            {{ session('error') }}
        </div>
    @endif

    <!-- Form -->
    <div class="bg-white rounded-lg shadow-md p-6">
        <form action="{{ route('jadwal.update', $jadwal) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Mata Kuliah -->
                <div>
                    <label for="matakuliah_id" class="block text-sm font-medium text-gray-700 mb-2">
                        Mata Kuliah <span class="text-red-500">*</span>
                    </label>
                    <select 
                        id="matakuliah_id" 
                        name="matakuliah_id" 
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500 @error('matakuliah_id') border-red-500 @enderror"
                        required
                    >
                        <option value="">Pilih Mata Kuliah</option>
                        @foreach($matakuliahs as $matakuliah)
                            <option value="{{ $matakuliah->id }}" 
                                {{ (old('matakuliah_id', $jadwal->matakuliah_id) == $matakuliah->id) ? 'selected' : '' }}>
                                {{ $matakuliah->kode }} - {{ $matakuliah->nama }}
                            </option>
                        @endforeach
                    </select>
                    @error('matakuliah_id')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>                <!-- Tanggal -->
                <div>
                    <label for="tanggal" class="block text-sm font-medium text-gray-700 mb-2">
                        Tanggal <span class="text-red-500">*</span>
                    </label>
                    <input 
                        type="date" 
                        id="tanggal" 
                        name="tanggal" 
                        value="{{ old('tanggal', $jadwal->tanggal ? $jadwal->tanggal->format('Y-m-d') : '') }}"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500 @error('tanggal') border-red-500 @enderror"
                        required
                    >
                    @error('tanggal')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Jam Mulai -->
                <div>
                    <label for="jam_mulai" class="block text-sm font-medium text-gray-700 mb-2">
                        Jam Mulai <span class="text-red-500">*</span>
                    </label>
                    <input 
                        type="time" 
                        id="jam_mulai" 
                        name="jam_mulai" 
                        value="{{ old('jam_mulai', date('H:i', strtotime($jadwal->jam_mulai))) }}"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500 @error('jam_mulai') border-red-500 @enderror"
                        required
                    >
                    @error('jam_mulai')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Jam Selesai -->
                <div>
                    <label for="jam_selesai" class="block text-sm font-medium text-gray-700 mb-2">
                        Jam Selesai <span class="text-red-500">*</span>
                    </label>
                    <input 
                        type="time" 
                        id="jam_selesai" 
                        name="jam_selesai" 
                        value="{{ old('jam_selesai', date('H:i', strtotime($jadwal->jam_selesai))) }}"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500 @error('jam_selesai') border-red-500 @enderror"
                        required
                    >
                    @error('jam_selesai')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>                <!-- Ruangan -->
                <div class="md:col-span-2">
                    <label for="ruangan" class="block text-sm font-medium text-gray-700 mb-2">
                        Ruangan
                    </label>
                    <input 
                        type="text" 
                        id="ruangan" 
                        name="ruangan" 
                        value="{{ old('ruangan', $jadwal->ruangan) }}"
                        placeholder="Contoh: A101, Lab Komputer 1, dll"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500 @error('ruangan') border-red-500 @enderror"
                    >
                    @error('ruangan')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Pilih Mahasiswa -->
            <div class="mt-6">
                <label class="block text-sm font-medium text-gray-700 mb-3">
                    Pilih Mahasiswa
                </label>
                <div class="border border-gray-300 rounded-lg p-4">
                    <!-- Search Filter -->
                    <div class="mb-4">
                        <input 
                            type="text" 
                            id="search-mahasiswa" 
                            placeholder="Cari mahasiswa berdasarkan nama atau NIM..."
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500"
                        >
                    </div>

                    <!-- Select All / Deselect All -->
                    <div class="mb-4 flex gap-4">
                        <button type="button" id="select-all" class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                            Pilih Semua
                        </button>
                        <button type="button" id="deselect-all" class="text-red-600 hover:text-red-800 text-sm font-medium">
                            Hapus Semua
                        </button>
                        <span id="selected-count" class="text-gray-600 text-sm ml-auto">
                            0 mahasiswa dipilih
                        </span>
                    </div>

                    <!-- Mahasiswa List -->
                    <div class="max-h-60 overflow-y-auto border border-gray-200 rounded-lg">
                        @if($mahasiswas->count() > 0)
                            @foreach($mahasiswas as $mahasiswa)
                                <div class="mahasiswa-item p-3 border-b border-gray-100 hover:bg-gray-50" 
                                     data-nama="{{ strtolower($mahasiswa->user->name) }}" 
                                     data-nim="{{ strtolower($mahasiswa->nim) }}">
                                    <label class="flex items-center cursor-pointer">
                                        <input 
                                            type="checkbox" 
                                            name="mahasiswa_ids[]" 
                                            value="{{ $mahasiswa->id }}"
                                            {{ in_array($mahasiswa->id, old('mahasiswa_ids', $jadwal->mahasiswa->pluck('id')->toArray())) ? 'checked' : '' }}
                                            class="mahasiswa-checkbox w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500"
                                        >
                                        <div class="ml-3">
                                            <div class="font-medium text-gray-900">{{ $mahasiswa->user->name }}</div>
                                            <div class="text-sm text-gray-600">NIM: {{ $mahasiswa->nim }}</div>
                                        </div>
                                    </label>
                                </div>
                            @endforeach
                        @else
                            <div class="p-4 text-center text-gray-500">
                                Tidak ada mahasiswa tersedia
                            </div>
                        @endif
                    </div>

                    @error('mahasiswa_ids')
                        <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Actions -->
            <div class="flex justify-end space-x-4 mt-6 pt-6 border-t border-gray-200">
                <a href="{{ route('jadwal.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded-lg">
                    Batal
                </a>
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg">
                    <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    Update Jadwal
                </button>
            </div>
        </form>
    </div>

    <!-- Informasi Jadwal Lama -->
    <div class="bg-blue-50 rounded-lg p-6 mt-6">
        <h3 class="text-lg font-semibold text-blue-800 mb-3">Informasi Jadwal Saat Ini</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 text-sm">
            <div>
                <span class="font-medium text-blue-700">Mata Kuliah:</span>
                <p class="text-blue-900">{{ $jadwal->matakuliah->nama }}</p>
            </div>            <div>
                <span class="font-medium text-blue-700">Tanggal:</span>
                <p class="text-blue-900">{{ $jadwal->tanggal ? $jadwal->tanggal->format('d/m/Y') . ' (' . $jadwal->tanggal->format('l') . ')' : 'Belum diatur' }}</p>
            </div>
            <div>
                <span class="font-medium text-blue-700">Waktu:</span>
                <p class="text-blue-900">{{ date('H:i', strtotime($jadwal->jam_mulai)) }} - {{ date('H:i', strtotime($jadwal->jam_selesai)) }}</p>
            </div>
            <div>
                <span class="font-medium text-blue-700">Ruangan:</span>
                <p class="text-blue-900">{{ $jadwal->ruangan ?: 'Tidak ditentukan' }}</p>
            </div>
        </div>
    </div>
</div>

<script>
    // Validasi jam mulai dan selesai
    document.getElementById('jam_mulai').addEventListener('change', function() {
        const jamMulai = this.value;
        const jamSelesai = document.getElementById('jam_selesai').value;
        
        if (jamSelesai && jamMulai >= jamSelesai) {
            document.getElementById('jam_selesai').value = '';
            alert('Jam selesai harus lebih besar dari jam mulai');
        }
    });

    document.getElementById('jam_selesai').addEventListener('change', function() {
        const jamSelesai = this.value;
        const jamMulai = document.getElementById('jam_mulai').value;
        
        if (jamMulai && jamSelesai <= jamMulai) {
            this.value = '';
            alert('Jam selesai harus lebih besar dari jam mulai');
        }
    });

    // Fitur pencarian mahasiswa
    document.getElementById('search-mahasiswa').addEventListener('input', function() {
        const searchTerm = this.value.toLowerCase();
        const mahasiswaItems = document.querySelectorAll('.mahasiswa-item');
        
        mahasiswaItems.forEach(function(item) {
            const nama = item.getAttribute('data-nama');
            const nim = item.getAttribute('data-nim');
            
            if (nama.includes(searchTerm) || nim.includes(searchTerm)) {
                item.style.display = 'block';
            } else {
                item.style.display = 'none';
            }
        });
        
        updateSelectedCount();
    });

    // Pilih semua mahasiswa
    document.getElementById('select-all').addEventListener('click', function() {
        const visibleCheckboxes = document.querySelectorAll('.mahasiswa-item:not([style*="display: none"]) .mahasiswa-checkbox');
        visibleCheckboxes.forEach(function(checkbox) {
            checkbox.checked = true;
        });
        updateSelectedCount();
    });

    // Hapus semua pilihan
    document.getElementById('deselect-all').addEventListener('click', function() {
        const checkboxes = document.querySelectorAll('.mahasiswa-checkbox');
        checkboxes.forEach(function(checkbox) {
            checkbox.checked = false;
        });
        updateSelectedCount();
    });

    // Update counter mahasiswa terpilih
    function updateSelectedCount() {
        const checkedBoxes = document.querySelectorAll('.mahasiswa-checkbox:checked');
        const count = checkedBoxes.length;
        document.getElementById('selected-count').textContent = count + ' mahasiswa dipilih';
    }

    // Event listener untuk setiap checkbox
    document.addEventListener('change', function(e) {
        if (e.target.classList.contains('mahasiswa-checkbox')) {
            updateSelectedCount();
        }
    });

    // Initialize counter
    document.addEventListener('DOMContentLoaded', function() {
        updateSelectedCount();
    });
</script>
@endsection
