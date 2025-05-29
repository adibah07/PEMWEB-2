<?php

namespace App\Livewire\UnitKerja;

use App\Models\UnitKerja;
use Livewire\Component;

class EditUnitKerja extends Component
{
    public UnitKerja $unit;
    public string $kode = '';
    public string $nama = '';
    public $unit_id;

    public function mount($unit_id)
    {
        $this->unit_id = $unit_id;
    $unit = UnitKerja::findOrFail($unit_id);
    $this->kode = $unit->kode;
    $this->nama = $unit->nama;
    }

    public function update()
    {
        $unit = UnitKerja::findOrFail($this->unit_id);
        $unit->update([
            'kode' => $this->kode,
            'nama' => $this->nama,
        ]);
        session()->flash('message', 'Unit Kerja berhasil diperbarui.');
        $this->redirectRoute('unitkerja.index');
    }

    public function render()
    {
        return view('livewire.unit-kerja.edit-unit-kerja');
    }
}
