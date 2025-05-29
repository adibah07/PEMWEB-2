<div class="container mx-auto">
    <h1 class="text-2xl font-bold mb-4">Create Peminjaman</h1>
    <form wire:submit.prevent="save" class="space-y-4">
        <flux:select wire:model.defer="pegawai_id" label="Pilih Pegawai" required>
            <flux:select.option value="">Pilih Pegawai</flux:select.option>
            @foreach($pegawais as $pegawai)
                <flux:select.option value="{{ $pegawai->id }}">{{ $pegawai->nama }}</flux:select.option>
            @endforeach
        </flux:select>

        <flux:select wire:model.defer="ruang_id" label="Pilih Ruang" required>
            <flux:select.option value="">Pilih Ruang</flux:select.option>
            @foreach($ruangs as $ruang)
                <flux:select.option value="{{ $ruang->id }}">{{ $ruang->nama }}</flux:select.option>
            @endforeach
        </flux:select>

        <flux:input type="date" wire:model.defer="tanggal" label="Tanggal" required />
        <flux:input type="time" wire:model.defer="jam_mulai" label="Jam Mulai" required />
        <flux:input type="time" wire:model.defer="jam_akhir" label="Jam Akhir" required />
        <flux:input type="text" wire:model.defer="keterangan" label="keterangan" required />

        <flux:button type="submit" variant="primary">Save</flux:button>
    </form>
</div>
