<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DosenResource\Pages;
use App\Filament\Resources\DosenResource\RelationManagers;
use App\Models\Dosen;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\ViewField;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\ImageColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class DosenResource extends Resource
{
    protected static ?string $model = Dosen::class;

    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';
    protected static ?string $navigationGroup = 'Manajemen Data';
    protected static ?string $navigationLabel = 'Dosen';
    protected static ?int $navigationSort = 1;
    protected static ?string $modelLabel = 'Dosen';
    protected static ?string $pluralModelLabel = 'Dosen';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Data User')
                    ->schema([
                        Forms\Components\TextInput::make('user.name')
                            ->label('Nama Lengkap')
                            ->required()
                            ->maxLength(100)
                            ->placeholder('Contoh: Dr. Ahmad Rahman'),
                        
                        Forms\Components\TextInput::make('user.email')
                            ->label('Email')
                            ->email()
                            ->required()
                            ->rules(function ($record) {
                                $ignoreId = $record ? $record->user_id : null;
                                return [
                                    'required',
                                    'email',
                                    'unique:users,email' . ($ignoreId ? ',' . $ignoreId : ''),
                                ];
                            })
                            ->maxLength(100)
                            ->placeholder('Contoh: ahmad.rahman@university.ac.id'),
                        
                        Forms\Components\TextInput::make('user.password')
                            ->label('Password')
                            ->password()
                            ->required(fn (string $context): bool => $context === 'create')
                            ->minLength(8)
                            ->placeholder('Minimal 8 karakter'),
                    ])
                    ->columns(2),
                
                Forms\Components\Section::make('Data Dosen')
                    ->schema([
                        Forms\Components\TextInput::make('nidn')
                            ->label('NIDN (Nomor Induk Dosen Nasional)')
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->maxLength(20)
                            ->placeholder('Contoh: 0012345678'),
                        
                        Forms\Components\Group::make([
                            // Field hidden untuk menyimpan foto lama
                            Forms\Components\Hidden::make('foto_existing')
                                ->default(fn ($record) => $record?->foto),

                            // Tampilan foto saat ini (read-only)
                            Forms\Components\Placeholder::make('current_photo_display')
                                ->label('Foto Saat Ini')
                                ->content(function ($record) {
                                    if (!$record || !$record->foto) {
                                        return new \Illuminate\Support\HtmlString('
                                            <div class="flex items-center space-x-3">
                                                <img src="' . asset('images/default-avatar.svg') . '" 
                                                     alt="No Photo" 
                                                     class="w-16 h-16 rounded-full object-cover border-2 border-gray-200">
                                                <span class="text-sm text-gray-500">Belum ada foto</span>
                                            </div>
                                        ');
                                    }
                                    
                                    $photoUrl = asset('storage/' . $record->foto);
                                    return new \Illuminate\Support\HtmlString('
                                        <div class="flex items-center space-x-3">
                                            <img src="' . $photoUrl . '" 
                                                 alt="Foto Dosen" 
                                                 class="w-16 h-16 rounded-full object-cover border-2 border-gray-200"
                                                 onerror="this.src=\'' . asset('images/default-avatar.svg') . '\'">
                                            <div>
                                                <p class="text-sm font-medium">Foto tersimpan</p>
                                                <p class="text-xs text-gray-500">' . basename($record->foto) . '</p>
                                            </div>
                                        </div>
                                    ');
                                })
                                ->visibleOn('edit'),

                            // Upload foto - untuk create dan edit
                            FileUpload::make('foto_upload')
                                ->label(function (string $operation) {
                                    return $operation === 'edit' ? 'Upload Foto Baru (Opsional)' : 'Foto Dosen';
                                })
                                ->image()
                                ->disk('public')
                                ->directory('dosen-photos')
                                ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/jpg'])
                                ->maxSize(2048)
                                ->imagePreviewHeight('150')
                                ->helperText(function (string $operation) {
                                    return $operation === 'edit' 
                                        ? 'Upload foto baru untuk mengganti yang lama'
                                        : 'Upload foto dosen (JPG, PNG, maksimal 2MB)';
                                })
                                ->nullable()
                                ->live()
                                ->afterStateUpdated(function ($state, $set, $get) {
                                    if ($state) {
                                        // Set flag bahwa ada foto baru
                                        $set('has_new_photo', true);
                                    }
                                }),

                            // Field hidden untuk tracking apakah ada foto baru
                            Forms\Components\Hidden::make('has_new_photo')
                                ->default(false),
                        ])
                        ->columnSpanFull(),
                    ])
                    ->columns(1),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('foto')
                    ->label('Foto')
                    ->circular()
                    ->size(50)
                    ->disk('public')
                    ->defaultImageUrl(function () {
                        return asset('images/default-avatar.svg');
                    })
                    ->visibility('public'),
                
                Tables\Columns\TextColumn::make('user.name')
                    ->label('Nama Dosen')
                    ->searchable()
                    ->sortable(),
                
                Tables\Columns\TextColumn::make('user.email')
                    ->label('Email')
                    ->searchable()
                    ->sortable(),
                
                Tables\Columns\TextColumn::make('nidn')
                    ->label('NIDN')
                    ->searchable()
                    ->sortable(),
                
                Tables\Columns\TextColumn::make('matakuliah_count')
                    ->label('Jumlah Mata Kuliah')
                    ->counts('matakuliah')
                    ->sortable(),
                
                Tables\Columns\TextColumn::make('user.role')
                    ->label('Role')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'dosen' => 'success',
                        default => 'gray',
                    }),
                
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\Filter::make('has_matakuliah')
                    ->label('Memiliki Mata Kuliah')
                    ->query(fn (Builder $query): Builder => $query->has('matakuliah')),
                
                Tables\Filters\Filter::make('no_matakuliah')
                    ->label('Belum Memiliki Mata Kuliah')
                    ->query(fn (Builder $query): Builder => $query->doesntHave('matakuliah')),
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
            ]);
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\MatakuliahRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListDosens::route('/'),
            'create' => Pages\CreateDosen::route('/create'),
            'view' => Pages\ViewDosen::route('/{record}'),
            'edit' => Pages\EditDosen::route('/{record}/edit'),
        ];
    }
}
