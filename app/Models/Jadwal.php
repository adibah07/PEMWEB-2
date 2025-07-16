<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    use HasFactory;

    protected $table = 'jadwal';

    protected $fillable = [
        'matakuliah_id',
        'tanggal',
        'jam_mulai',
        'jam_selesai',
        'ruangan',
    ];

    protected $casts = [
        'tanggal' => 'date',
        'jam_mulai' => 'string',
        'jam_selesai' => 'string',
    ];

    public function matakuliah()
    {
        return $this->belongsTo(Matakuliah::class);
    }

    public function qrcodes()
    {
        return $this->hasMany(QrCode::class);
    }

    public function absensi()
    {
        return $this->hasMany(Absensi::class);
    }

    public function mahasiswa()
    {
        return $this->belongsToMany(Mahasiswa::class, 'jadwal_mahasiswa');
    }
}
