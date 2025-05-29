<?php

namespace App\Livewire\Peminjaman;

use App\Models\Peminjaman;
use Livewire\Component;
use Livewire\Attributes\Validate;

class EditPeminjaman extends Component
{
    public Peminjaman $peminjaman;

    #[Validate('required|integer')]
    public int $pegawai_id;
    #[Validate('required|integer')]
    public int $ruang_id;
    #[Validate('required|date')]
    public string $tanggal;
    #[Validate('required')]
    public string $jam_mulai;
    #[Validate('required')]
    public string $jam_akhir;
    #[Validate('nullable|string')]
    public ?string $keterangan = null;

    public function mount($peminjaman_id)
    {
        $this->peminjaman = Peminjaman::findOrFail($peminjaman_id);
        $this->pegawai_id = $this->peminjaman->pegawai_id;
        $this->ruang_id = $this->peminjaman->ruang_id;
        $this->tanggal = $this->peminjaman->tanggal;
        $this->jam_mulai = $this->peminjaman->jam_mulai;
        $this->jam_akhir = $this->peminjaman->jam_akhir;
        $this->keterangan = $this->peminjaman->keterangan;
    }

    public function save() {
        $this->validate();
    
        $this->peminjaman->update([
            'pegawai_id' => $this->pegawai_id,
            'ruang_id' => $this->ruang_id,
            'tanggal' => $this->tanggal,
            'jam_mulai' => $this->jam_mulai,
            'jam_akhir' => $this->jam_akhir,
            'keterangan' => $this->keterangan, // Bukan 'keterangan'
        ]);
    
        session()->flash('message', 'Peminjaman berhasil diperbarui.');
        $this->redirectRoute('peminjaman.index');
    }
    

    public function render()
    {
        return view('livewire.peminjaman.edit-peminjaman', [
            'pegawais' => \App\Models\Pegawai::all(),
            'ruangs' => \App\Models\Ruang::all(),
        ]);
    }
}
