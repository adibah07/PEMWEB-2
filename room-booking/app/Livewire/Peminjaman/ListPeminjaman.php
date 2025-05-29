<?php

namespace App\Livewire\Peminjaman;

use App\Models\Peminjaman;
use Livewire\Component;

class ListPeminjaman extends Component
{
    public function render()
    {
        return view('livewire.peminjaman.list-peminjaman', [
            'peminjamans' => Peminjaman::with(['pegawai', 'ruang'])->get(),
        ]);
    }
    public function delete($id)
    {
        // Menggunakan model Ruang untuk mencari data ruang berdasarkan id yang diberikan
        $peminjaman = Peminjaman::find($id);
 
        // Jika data peminjaman ditemukan, maka hapus data tersebut dari database dan tampilkan pesan sukses
        // Menggunakan session untuk menyimpan pesan sukses setelah data peminjaman berhasil dihapus
        if ($peminjaman) {
            $peminjaman->delete();
            session()->flash('message', 'Peminjaman berhasil dihapus.');
        }
    }
}
