<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MatakuliahResource\Pages;
use App\Models\Matakuliah;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;

class MatakuliahResource extends Resource
{
    protected static ?string $model = Matakuliah::class;

    protected static ?string $navigationIcon = 'heroicon-o-book-open';
    protected static ?string $navigationGroup = 'Manajemen Data';
    protected static ?string $navigationLabel = 'Mata Kuliah';
    protected static ?int $navigationSort = 3;
    protected static ?string $pluralModelLabel = 'Mata Kuliah';
    protected static ?string $modelLabel = 'Mata Kuliah';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('kode')
                    ->label('Kode Mata Kuliah')
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->maxLength(20)
                    ->placeholder('Contoh: TI001'),
                
                Forms\Components\TextInput::make('nama')
                    ->label('Nama Mata Kuliah')
                    ->required()
                    ->maxLength(100)
                    ->placeholder('Contoh: Pemrograman Web'),
                
                Forms\Components\TextInput::make('sks')
                    ->label('SKS')
                    ->required()
                    ->numeric()
                    ->minValue(1)
                    ->maxValue(6)
                    ->placeholder('Contoh: 3'),
                
                Forms\Components\TextInput::make('semester')
                    ->label('Semester')
                    ->required()
                    ->numeric()
                    ->minValue(1)
                    ->maxValue(8)
                    ->placeholder('Contoh: 4'),
                
                Forms\Components\Select::make('dosen_id')
                    ->label('Dosen Pengampu')
                    ->relationship('dosen', 'id')
                    ->getOptionLabelFromRecordUsing(fn ($record) => $record->user->name ?? 'Unknown')
                    ->searchable()
                    ->preload()
                    ->placeholder('Pilih Dosen')
                    ->nullable(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('kode')
                    ->label('Kode')
                    ->searchable()
                    ->sortable(),
                
                Tables\Columns\TextColumn::make('nama')
                    ->label('Nama Mata Kuliah')
                    ->searchable()
                    ->sortable(),
                
                Tables\Columns\TextColumn::make('sks')
                    ->label('SKS')
                    ->sortable(),
                
                Tables\Columns\TextColumn::make('semester')
                    ->label('Semester')
                    ->sortable(),
                
                Tables\Columns\TextColumn::make('dosen.user.name')
                    ->label('Dosen Pengampu')
                    ->searchable()
                    ->sortable(),
                
                Tables\Columns\TextColumn::make('jadwal_count')
                    ->label('Jumlah Jadwal')
                    ->counts('jadwal')
                    ->sortable(),
                
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('dosen_id')
                    ->label('Dosen')
                    ->relationship('dosen', 'id')
                    ->getOptionLabelFromRecordUsing(fn ($record) => $record->user->name ?? 'Unknown')
                    ->searchable()
                    ->preload(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
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
            'index' => Pages\ListMatakuliahs::route('/'),
            'create' => Pages\CreateMatakuliah::route('/create'),
            'edit' => Pages\EditMatakuliah::route('/{record}/edit'),
        ];
    }
}
