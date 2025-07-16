<?php

namespace App\Filament\Resources;

use App\Filament\Resources\JadwalResource\Pages;
use App\Models\Jadwal;
use App\Models\Mahasiswa;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class JadwalResource extends Resource
{
    protected static ?string $model = Jadwal::class;

    protected static ?string $navigationIcon = 'heroicon-o-calendar-days';
    protected static ?string $navigationGroup = 'Jadwal & Absensi';
    protected static ?string $navigationLabel = 'Jadwal Kuliah';
    protected static ?int $navigationSort = 1;
    protected static ?string $modelLabel = 'Jadwal';
    protected static ?string $pluralModelLabel = 'Jadwal Kuliah';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informasi Mata Kuliah')
                    ->schema([
                        Forms\Components\Select::make('matakuliah_id')
                            ->label('Mata Kuliah')
                            ->relationship('matakuliah', 'nama')
                            ->getOptionLabelFromRecordUsing(fn ($record) => $record->kode . ' - ' . $record->nama . ' (' . ($record->dosen->user->name ?? 'Tidak ada dosen') . ')')
                            ->searchable()
                            ->preload()
                            ->required()
                            ->placeholder('Pilih Mata Kuliah'),
                    ]),
                
                Forms\Components\Section::make('Jadwal Perkuliahan')
                    ->schema([
                        Forms\Components\DatePicker::make('tanggal')
                            ->label('Tanggal')
                            ->required()
                            ->displayFormat('d/m/Y')
                            ->placeholder('Pilih Tanggal'),
                        
                        Forms\Components\TimePicker::make('jam_mulai')
                            ->label('Jam Mulai')
                            ->required()
                            ->seconds(false),
                        
                        Forms\Components\TimePicker::make('jam_selesai')
                            ->label('Jam Selesai')
                            ->required()
                            ->seconds(false),
                        
                        Forms\Components\TextInput::make('ruangan')
                            ->label('Ruangan')
                            ->maxLength(50)
                            ->placeholder('Contoh: Lab Komputer 1'),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Mahasiswa yang Mengikuti')
                    ->schema([
                        Forms\Components\Select::make('mahasiswa')
                            ->label('Pilih Mahasiswa')
                            ->multiple()
                            ->relationship('mahasiswa', 'nim')
                            ->getOptionLabelFromRecordUsing(fn (Mahasiswa $record) => $record->nim . ' - ' . $record->user->name . ' (' . $record->kelas . ')')
                            ->searchable(['nim', 'kelas'])
                            ->preload()
                            ->placeholder('Pilih mahasiswa yang akan mengikuti jadwal ini')
                            ->helperText('Anda dapat memilih multiple mahasiswa sekaligus'),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('matakuliah.kode')
                    ->label('Kode MK')
                    ->searchable()
                    ->sortable(),
                
                Tables\Columns\TextColumn::make('matakuliah.nama')
                    ->label('Mata Kuliah')
                    ->searchable()
                    ->sortable()
                    ->wrap(),
                
                Tables\Columns\TextColumn::make('matakuliah.dosen.user.name')
                    ->label('Dosen')
                    ->searchable()
                    ->sortable(),
                
                Tables\Columns\TextColumn::make('tanggal')
                    ->label('Tanggal')
                    ->date('d/m/Y')
                    ->sortable()
                    ->badge()
                    ->formatStateUsing(fn ($state) => $state ? $state->format('d/m/Y') . ' (' . $state->format('l') . ')' : '-')
                    ->color('primary'),
                
                Tables\Columns\TextColumn::make('jam_mulai')
                    ->label('Jam Mulai')
                    ->sortable()
                    ->time('H:i'),
                
                Tables\Columns\TextColumn::make('jam_selesai')
                    ->label('Jam Selesai')
                    ->sortable()
                    ->time('H:i'),
                
                Tables\Columns\TextColumn::make('ruangan')
                    ->label('Ruangan')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('mahasiswa_count')
                    ->label('Jumlah Mahasiswa')
                    ->counts('mahasiswa')
                    ->sortable()
                    ->badge()
                    ->color('success'),
                
                Tables\Columns\TextColumn::make('absensi_count')
                    ->label('Total Absensi')
                    ->counts('absensi')
                    ->sortable(),
                
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\Filter::make('tanggal')
                    ->form([
                        Forms\Components\DatePicker::make('tanggal_dari')
                            ->label('Tanggal Dari')
                            ->displayFormat('d/m/Y'),
                        Forms\Components\DatePicker::make('tanggal_sampai')
                            ->label('Tanggal Sampai')
                            ->displayFormat('d/m/Y'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['tanggal_dari'],
                                fn (Builder $query, $date): Builder => $query->whereDate('tanggal', '>=', $date),
                            )
                            ->when(
                                $data['tanggal_sampai'],
                                fn (Builder $query, $date): Builder => $query->whereDate('tanggal', '<=', $date),
                            );
                    }),
                
                Tables\Filters\SelectFilter::make('matakuliah_id')
                    ->label('Mata Kuliah')
                    ->relationship('matakuliah', 'nama')
                    ->searchable()
                    ->preload(),
                
                Tables\Filters\Filter::make('dosen')
                    ->form([
                        Forms\Components\Select::make('dosen_id')
                            ->label('Dosen')
                            ->relationship('matakuliah.dosen.user', 'name')
                            ->searchable()
                            ->preload(),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query->when(
                            $data['dosen_id'],
                            fn (Builder $query, $dosenId): Builder => $query->whereHas('matakuliah.dosen', fn (Builder $query) => $query->where('user_id', $dosenId))
                        );
                    }),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('tanggal')
            ->defaultSort('jam_mulai');
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListJadwals::route('/'),
            'create' => Pages\CreateJadwal::route('/create'),
            'view' => Pages\ViewJadwal::route('/{record}'),
            'edit' => Pages\EditJadwal::route('/{record}/edit'),
        ];
    }
}
