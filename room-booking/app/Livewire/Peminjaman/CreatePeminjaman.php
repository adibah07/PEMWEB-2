<?php

namespace App\Livewire\Peminjaman;

use App\Models\Peminjaman;
use App\Models\Pegawai;
use App\Models\Ruang;
use Livewire\Attributes\Validate;
use Livewire\Component;

class CreatePeminjaman extends Component
{
    #[Validate('required|exists:pegawai,id')]
    public $pegawai_id = '';

    #[Validate('required|exists:ruang,id')]
    public $ruang_id = '';

    #[Validate('required|date')]
    public $tanggal = '';

    #[Validate('required')]
    public $jam_mulai = '';

    #[Validate('required')]
    public $jam_akhir = '';

    #[Validate('required|string')]
    public $keterangan = '';

    public function save()
    {
        $this->validate();

        Peminjaman::create([
            'pegawai_id' => $this->pegawai_id,
            'ruang_id' => $this->ruang_id,
            'tanggal' => $this->tanggal,
            'jam_mulai' => $this->jam_mulai,
            'jam_akhir' => $this->jam_akhir,
            'keterangan' => $this->keterangan,
        ]);

        session()->flash('message', 'Peminjaman berhasil ditambahkan.');
        $this->redirectRoute('peminjaman.index');
    }

    public function render()
    {
        return view('livewire.peminjaman.create-peminjaman', [
            'pegawais' => Pegawai::all(),
            'ruangs' => Ruang::all(),
        ]);
    }
}

