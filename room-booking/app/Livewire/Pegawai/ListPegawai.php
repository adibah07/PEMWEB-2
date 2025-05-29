<?php

namespace App\Livewire\Pegawai;

use Livewire\Component;
use App\Models\Pegawai;

class ListPegawai extends Component
{
    public function render()
    {
        return view('livewire.pegawai.list-pegawai', [
            'pegawais' => Pegawai::with('unitKerja')->get(),  // Pastikan ini
        ]);
    }

    public function delete($id)
    {
        // Menggunakan model Ruang untuk mencari data ruang berdasarkan id yang diberikan
        $pegawai = Pegawai::find($id);
 
        // Jika data pegawai ditemukan, maka hapus data tersebut dari database dan tampilkan pesan sukses
        // Menggunakan session untuk menyimpan pesan sukses setelah data pegawai berhasil dihapus
        if ($pegawai) {
            $pegawai->delete();
            session()->flash('message', 'Pegawai berhasil dihapus.');
        }
    }
}
