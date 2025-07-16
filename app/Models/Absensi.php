<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    use HasFactory;

    protected $table = 'absensi';

    protected $fillable = [
        'mahasiswa_id',
        'jadwal_id',
        'qrcode_id',
        'tanggal',
        'waktu_absen',
        'status',
        'keterangan',
    ];

    protected $casts = [
        'tanggal' => 'date',
        'waktu_absen' => 'datetime',
    ];

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class);
    }

    public function jadwal()
    {
        return $this->belongsTo(Jadwal::class);
    }
    
    public function qrcode()
    {
        return $this->belongsTo(QrCode::class);
    }
}
