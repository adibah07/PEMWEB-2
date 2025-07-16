<?php

namespace App\Filament\Widgets;

use App\Models\Absensi;
use Carbon\Carbon;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Database\Eloquent\Builder;

class LatestAbsensiTable extends BaseWidget
{
    protected static bool $isDiscovered = false;
    protected static ?int $sort = 3;
    protected static ?string $heading = 'Absensi Terbaru';
    protected static ?string $pollingInterval = '30s';
    protected int | string | array $columnSpan = 'full';
    protected static ?string $maxHeight = '400px';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Absensi::query()
                    ->with(['mahasiswa', 'jadwal.matakuliah'])
                    ->latest('waktu_absen')
                    ->limit(8)
            )
            ->columns([
                Tables\Columns\TextColumn::make('waktu_absen')
                    ->label('Waktu')
                    ->dateTime('H:i')
                    ->description(fn (Absensi $record): string => $record->waktu_absen->format('d M Y'))
                    ->sortable()
                    ->searchable(),
                    
                Tables\Columns\TextColumn::make('mahasiswa.nama')
                    ->label('Mahasiswa')
                    ->description(fn (Absensi $record): string => $record->mahasiswa->nim ?? '-')
                    ->sortable()
                    ->searchable()
                    ->weight('medium'),
                    
                Tables\Columns\TextColumn::make('jadwal.matakuliah.nama')
                    ->label('Mata Kuliah')
                    ->description(fn (Absensi $record): string => $record->jadwal->ruangan ?? '-')
                    ->sortable()
                    ->searchable()
                    ->wrap(),
                    
                Tables\Columns\BadgeColumn::make('status')
                    ->label('Status')
                    ->colors([
                        'success' => 'hadir',
                        'warning' => 'izin',
                        'info' => 'sakit',
                        'danger' => 'alfa',
                    ])
                    ->formatStateUsing(fn (string $state): string => ucfirst($state))
                    ->sortable(),
                    
                Tables\Columns\TextColumn::make('keterangan')
                    ->label('Keterangan')
                    ->limit(25)
                    ->tooltip(function (Tables\Columns\TextColumn $column): ?string {
                        $state = $column->getState();
                        return strlen($state) > 25 ? $state : null;
                    })
                    ->placeholder('Tidak ada keterangan')
                    ->toggleable(),
            ])
            ->defaultSort('waktu_absen', 'desc')
            ->emptyStateHeading('Belum Ada Data Absensi')
            ->emptyStateDescription('Data absensi akan muncul di sini setelah mahasiswa melakukan absensi.')
            ->emptyStateIcon('heroicon-o-clipboard-document-check')
            ->striped()
            ->paginated(false);
    }
}
