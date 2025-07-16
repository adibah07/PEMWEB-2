<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Absensi - {{ $jadwal->matakuliah->nama_matakuliah }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            font-family: 'Arial', sans-serif;
            min-height: 100vh;
        }
        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }
        .card-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-radius: 15px 15px 0 0 !important;
            padding: 2rem;
        }
        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            border-radius: 10px;
            padding: 12px 30px;
        }
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(102, 126, 234, 0.4);
        }
        .form-control {
            border-radius: 10px;
            border: 2px solid #e9ecef;
            padding: 12px 15px;
        }
        .form-control:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
        }
        .badge {
            font-size: 0.9rem;
            padding: 8px 15px;
            border-radius: 8px;
        }
        .info-card {
            background: #f8f9ff;
            border-radius: 10px;
            padding: 1.5rem;
            margin-bottom: 2rem;
        }
    </style>
</head>
<body>
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header text-center">
                        <h2><i class="fas fa-qrcode me-2"></i>Absensi Perkuliahan</h2>
                    </div>
                    <div class="card-body p-4">
                        <!-- Info Jadwal -->
                        <div class="info-card">
                            <div class="row">
                                <div class="col-md-6">
                                    <h5><i class="fas fa-book text-primary me-2"></i>{{ $jadwal->matakuliah->nama_matakuliah }}</h5>
                                    <p class="mb-1"><i class="fas fa-code text-secondary me-2"></i><strong>Kode:</strong> {{ $jadwal->matakuliah->kode_matakuliah }}</p>
                                    <p class="mb-1"><i class="fas fa-user-tie text-secondary me-2"></i><strong>Dosen:</strong> {{ $jadwal->dosen->nama }}</p>
                                </div>
                                <div class="col-md-6">
                                    <p class="mb-1"><i class="fas fa-calendar text-secondary me-2"></i><strong>Tanggal:</strong> {{ $jadwal->tanggal ? $jadwal->tanggal->format('d/m/Y') . ' (' . $jadwal->tanggal->format('l') . ')' : 'Belum diatur' }}</p>
                                    <p class="mb-1"><i class="fas fa-clock text-secondary me-2"></i><strong>Waktu:</strong> {{ $jadwal->jam_mulai }} - {{ $jadwal->jam_selesai }}</p>
                                    <p class="mb-1"><i class="fas fa-map-marker-alt text-secondary me-2"></i><strong>Ruang:</strong> {{ $jadwal->ruang }}</p>
                                </div>
                            </div>
                            <div class="text-center mt-3">
                                <span class="badge bg-success">
                                    <i class="fas fa-check-circle me-1"></i>QR Code Valid
                                </span>
                                <span class="badge bg-info ms-2">
                                    <i class="fas fa-clock me-1"></i>Berlaku sampai: {{ $qrcode->expired_at->format('H:i') }}
                                </span>
                            </div>
                        </div>

                        @if(session('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <i class="fas fa-exclamation-triangle me-2"></i>{{ session('error') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        <!-- Form Absensi -->
                        <form action="{{ route('absensi.store', $qrcode->kode_qr) }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="nim" class="form-label"><i class="fas fa-id-card me-2"></i>NIM</label>
                                <input type="text" class="form-control @error('nim') is-invalid @enderror" 
                                       id="nim" name="nim" value="{{ old('nim') }}" 
                                       placeholder="Masukkan NIM Anda" required>
                                @error('nim')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="nama" class="form-label"><i class="fas fa-user me-2"></i>Nama Lengkap</label>
                                <input type="text" class="form-control @error('nama') is-invalid @enderror" 
                                       id="nama" name="nama" value="{{ old('nama') }}" 
                                       placeholder="Masukkan Nama Lengkap Anda" required>
                                @error('nama')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary btn-lg">
                                    <i class="fas fa-check me-2"></i>Absen Sekarang
                                </button>
                            </div>
                        </form>

                        <!-- Info Tambahan -->
                        <div class="mt-4 text-center">
                            <small class="text-muted">
                                <i class="fas fa-info-circle me-1"></i>
                                Pastikan data yang Anda masukkan sudah benar. Absensi hanya dapat dilakukan sekali per pertemuan.
                            </small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Auto focus pada input NIM
        document.getElementById('nim').focus();
        
        // Auto format NIM
        document.getElementById('nim').addEventListener('input', function(e) {
            // Hanya allow angka
            this.value = this.value.replace(/[^0-9]/g, '');
        });
    </script>
</body>
</html>
