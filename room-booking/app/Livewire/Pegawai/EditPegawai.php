<?php

namespace App\Livewire\Pegawai;

use App\Models\Pegawai;
use App\Models\UnitKerja;
use Livewire\Attributes\Validate;
use Livewire\Component;

class EditPegawai extends Component
{
    public Pegawai $pegawai;

    public string $nip = '';
    public string $nama = '';
    public $unit_kerja_id = '';
    public $pegawai_id; // 🆕 Properti untuk menyimpan ID Pegawai

    // Mount dengan menerima parameter via properti, bukan method argument
    public function mount($pegawai_id)
    {
        $this->pegawai_id = $pegawai_id;

        $this->pegawai = Pegawai::findOrFail($this->pegawai_id);
        $this->nip = $this->pegawai->nip;
        $this->nama = $this->pegawai->nama;
        $this->unit_kerja_id = $this->pegawai->unit_kerja_id;
    }

    public function update()
    {
        $this->validate([
            'nip' => 'required|string|max:20',
            'nama' => 'required|string|max:100',
            'unit_kerja_id' => 'required|integer',
        ]);

        $this->pegawai->update([
            'nip' => $this->nip,
            'nama' => $this->nama,
            'unit_kerja_id' => $this->unit_kerja_id,
        ]);

        session()->flash('message', 'Pegawai berhasil diperbarui.');
        $this->redirectRoute('pegawai.index');
    }

    public function render()
    {
        return view('livewire.pegawai.edit-pegawai', [
            'units' => UnitKerja::all(),
        ]);
    }
}
