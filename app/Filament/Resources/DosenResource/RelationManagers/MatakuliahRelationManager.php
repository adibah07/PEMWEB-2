<?php

namespace App\Filament\Resources\DosenResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MatakuliahRelationManager extends RelationManager
{
    protected static string $relationship = 'matakuliah';

    protected static ?string $title = 'Mata Kuliah';

    public function form(Form $form): Form
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
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('nama')
            ->columns([
                Tables\Columns\TextColumn::make('kode')
                    ->label('Kode')
                    ->searchable()
                    ->sortable(),
                
                Tables\Columns\TextColumn::make('nama')
                    ->label('Nama Mata Kuliah')
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
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()
                    ->mutateFormDataUsing(function (array $data): array {
                        $data['dosen_id'] = $this->ownerRecord->id;
                        return $data;
                    }),
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
}
