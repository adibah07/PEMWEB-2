<?php

namespace App\Livewire\UnitKerja;

use App\Models\UnitKerja;
use Livewire\Component;

class ListUnitKerja extends Component
{
    public function render()
    {
        return view('livewire.unit-kerja.list-unit-kerja', [
            'units' => UnitKerja::all(),
        ]);
    }

    public function delete($id)
    {
        $unit = UnitKerja::find($id);
        if ($unit) {
            $unit->delete();
            session()->flash('message', 'Unit Kerja berhasil dihapus.');
        }
    }
}
