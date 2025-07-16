-- Drop table if exists (untuk menghindari duplikat jika diimpor ulang)
DROP TABLE IF EXISTS absensi, qrcodes, jadwal, matakuliah, dosen, mahasiswa, users;

-- Tabel users (admin, dosen, mahasiswa)
CREATE TABLE users (
    id BIGINT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin', 'dosen', 'mahasiswa') NOT NULL,
    created_at TIMESTAMP NULL DEFAULT NULL,
    updated_at TIMESTAMP NULL DEFAULT NULL
);

-- Tabel mahasiswa
CREATE TABLE mahasiswa (
    id BIGINT AUTO_INCREMENT PRIMARY KEY,
    user_id BIGINT NOT NULL,
    nim VARCHAR(20) NOT NULL UNIQUE,
    kelas VARCHAR(10),
    jurusan VARCHAR(100),
    created_at TIMESTAMP NULL DEFAULT NULL,
    updated_at TIMESTAMP NULL DEFAULT NULL,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

-- Tabel dosen
CREATE TABLE dosen (
    id BIGINT AUTO_INCREMENT PRIMARY KEY,
    user_id BIGINT NOT NULL,
    nidn VARCHAR(20) NOT NULL UNIQUE,
    created_at TIMESTAMP NULL DEFAULT NULL,
    updated_at TIMESTAMP NULL DEFAULT NULL,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

-- Tabel matakuliah
CREATE TABLE matakuliah (
    id BIGINT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(100) NOT NULL,
    kode VARCHAR(20) NOT NULL UNIQUE,
    dosen_id BIGINT,
    created_at TIMESTAMP NULL DEFAULT NULL,
    updated_at TIMESTAMP NULL DEFAULT NULL,
    FOREIGN KEY (dosen_id) REFERENCES dosen(id) ON DELETE SET NULL
);

-- Tabel jadwal
CREATE TABLE jadwal (
    id BIGINT AUTO_INCREMENT PRIMARY KEY,
    matakuliah_id BIGINT NOT NULL,
    tanggal DATE NOT NULL,
    jam_mulai TIME NOT NULL,
    jam_selesai TIME NOT NULL,
    ruangan VARCHAR(50),
    created_at TIMESTAMP NULL DEFAULT NULL,
    updated_at TIMESTAMP NULL DEFAULT NULL,
    FOREIGN KEY (matakuliah_id) REFERENCES matakuliah(id) ON DELETE CASCADE
);

-- Tabel qrcodes
CREATE TABLE qrcodes (
    id BIGINT AUTO_INCREMENT PRIMARY KEY,
    jadwal_id BIGINT NOT NULL,
    kode_qr TEXT NOT NULL,
    expired_at DATETIME NOT NULL,
    created_at TIMESTAMP NULL DEFAULT NULL,
    updated_at TIMESTAMP NULL DEFAULT NULL,
    FOREIGN KEY (jadwal_id) REFERENCES jadwal(id) ON DELETE CASCADE
);

-- Tabel absensi
CREATE TABLE absensi (
    id BIGINT AUTO_INCREMENT PRIMARY KEY,
    mahasiswa_id BIGINT NOT NULL,
    jadwal_id BIGINT NOT NULL,
    tanggal DATE NOT NULL,
    waktu_absen DATETIME NOT NULL,
    status ENUM('hadir', 'izin', 'sakit', 'alpa') DEFAULT 'hadir',
    created_at TIMESTAMP NULL DEFAULT NULL,
    updated_at TIMESTAMP NULL DEFAULT NULL,
    FOREIGN KEY (mahasiswa_id) REFERENCES mahasiswa(id) ON DELETE CASCADE,
    FOREIGN KEY (jadwal_id) REFERENCES jadwal(id) ON DELETE CASCADE
);
