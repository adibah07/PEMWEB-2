<?php

namespace App\Livewire\Pegawai;

use App\Models\Pegawai;
use App\Models\UnitKerja;
use Livewire\Attributes\Validate;
use Livewire\Component;

class CreatePegawai extends Component
{
    #[Validate('required|string|max:20')]
    public string $nip = '';

    #[Validate('required|string|max:100')]
    public string $nama = '';

    #[Validate('required|integer')]
    public $unit_kerja_id = '';

    public function save()
    {
        $this->validate();

        Pegawai::create([
            'nip' => $this->nip,
            'nama' => $this->nama,
            'unit_kerja_id' => $this->unit_kerja_id,
        ]);

        session()->flash('message', 'Pegawai berhasil ditambahkan.');

        $this->redirectRoute('pegawai.index'); // Sesuaikan dengan route list pegawai
    }

    public function render()
    {
        return view('livewire.pegawai.create-pegawai', [
            'units' => UnitKerja::all(),  // Mengirim data unit kerja ke view
        ]);
    }
}
