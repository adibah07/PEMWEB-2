<?php

namespace App\Filament\Resources\JadwalResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AbsensiRelationManager extends RelationManager
{
    protected static string $relationship = 'absensi';

    protected static ?string $title = 'Riwayat Absensi Hari Ini';

    protected static ?string $label = 'Absensi';

    protected static ?string $pluralLabel = 'Riwayat Absensi';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('mahasiswa_id')
                    ->label('Mahasiswa')
                    ->relationship('mahasiswa.user', 'name')
                    ->searchable()
                    ->preload()
                    ->required(),
                
                Forms\Components\Select::make('status')
                    ->label('Status')
                    ->options([
                        'hadir' => 'Hadir',
                        'izin' => 'Izin',
                        'sakit' => 'Sakit',
                        'alpa' => 'Alpa',
                    ])
                    ->required(),
                
                Forms\Components\DatePicker::make('tanggal')
                    ->label('Tanggal')
                    ->required()
                    ->default(today()),
                
                Forms\Components\TimePicker::make('waktu_absen')
                    ->label('Waktu Absen')
                    ->default(now()),
                
                Forms\Components\Textarea::make('keterangan')
                    ->label('Keterangan')
                    ->maxLength(255),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('id')
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('ID'),
                    
                Tables\Columns\TextColumn::make('mahasiswa_id')
                    ->label('Mahasiswa ID'),
                    
                Tables\Columns\TextColumn::make('jadwal_id')
                    ->label('Jadwal ID'),
                
                Tables\Columns\TextColumn::make('mahasiswa.user.name')
                    ->label('Nama Mahasiswa')
                    ->default('N/A'),
                
                Tables\Columns\TextColumn::make('mahasiswa.nim')
                    ->label('NIM')
                    ->default('N/A'),
                
                Tables\Columns\TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'hadir' => 'success',
                        'izin' => 'warning',
                        'sakit' => 'info',
                        'alpa' => 'danger',
                        default => 'gray',
                    }),
                
                Tables\Columns\TextColumn::make('tanggal')
                    ->label('Tanggal')
                    ->date('d M Y'),
                
                Tables\Columns\TextColumn::make('waktu_absen')
                    ->label('Waktu Absen')
                    ->time('H:i'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()
                    ->label('Tambah Absensi Manual'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('id', 'desc');
    }

    public function getTableQuery(): Builder
    {
        $query = parent::getTableQuery();
        return $query->with(['mahasiswa.user']);
    }

    public function isReadOnly(): bool
    {
        return false;
    }
}
