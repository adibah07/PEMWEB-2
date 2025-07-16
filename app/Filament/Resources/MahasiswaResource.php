<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MahasiswaResource\Pages;
use App\Filament\Resources\MahasiswaResource\RelationManagers;
use App\Models\Mahasiswa;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\FileUpload;
use Filament\Tables\Columns\ImageColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MahasiswaResource extends Resource
{
    protected static ?string $model = Mahasiswa::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';
    protected static ?string $navigationGroup = 'Manajemen Data';
    protected static ?string $navigationLabel = 'Mahasiswa';
    protected static ?int $navigationSort = 2;
    protected static ?string $modelLabel = 'Mahasiswa';
    protected static ?string $pluralModelLabel = 'Mahasiswa';

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
                            ->placeholder('Contoh: Ahmad Fauzi'),
                        
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
                            ->placeholder('Contoh: ahmad.fauzi@student.ac.id'),
                        
                        Forms\Components\TextInput::make('user.password')
                            ->label('Password')
                            ->password()
                            ->required(fn (string $context): bool => $context === 'create')
                            ->minLength(8)
                            ->placeholder('Minimal 8 karakter'),
                    ])
                    ->columns(2),
                
                Forms\Components\Section::make('Data Mahasiswa')
                    ->schema([
                        Forms\Components\TextInput::make('nim')
                            ->label('NIM')
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->maxLength(20)
                            ->placeholder('Contoh: 2021001'),
                        
                        Forms\Components\TextInput::make('kelas')
                            ->label('Kelas')
                            ->maxLength(10)
                            ->placeholder('Contoh: 3A'),
                        
                        Forms\Components\TextInput::make('jurusan')
                            ->label('Jurusan')
                            ->maxLength(100)
                            ->placeholder('Contoh: Teknik Informatika'),
                        
                        Forms\Components\Select::make('user.status')
                            ->label('Status')
                            ->options([
                                'normal' => 'Normal',
                                'ketua_kelas' => 'Ketua Kelas',
                            ])
                            ->default('normal')
                            ->required()
                            ->placeholder('Pilih status mahasiswa')
                            ->dehydrateStateUsing(fn ($state) => $state ?? 'normal'),
                        
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
                                                 alt="Foto Mahasiswa" 
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
                                    return $operation === 'edit' ? 'Upload Foto Baru (Opsional)' : 'Foto Mahasiswa';
                                })
                                ->image()
                                ->disk('public')
                                ->directory('mahasiswa-photos')
                                ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/jpg'])
                                ->maxSize(2048)
                                ->imagePreviewHeight('150')
                                ->helperText(function (string $operation) {
                                    return $operation === 'edit' 
                                        ? 'Upload foto baru untuk mengganti yang lama'
                                        : 'Upload foto mahasiswa (JPG, PNG, maksimal 2MB)';
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
                    ->columns(2),
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
                
                Tables\Columns\TextColumn::make('nim')
                    ->label('NIM')
                    ->searchable()
                    ->sortable(),
                
                Tables\Columns\TextColumn::make('user.name')
                    ->label('Nama Mahasiswa')
                    ->searchable()
                    ->sortable(),
                
                Tables\Columns\TextColumn::make('user.email')
                    ->label('Email')
                    ->searchable()
                    ->sortable(),
                
                Tables\Columns\TextColumn::make('kelas')
                    ->label('Kelas')
                    ->searchable()
                    ->sortable(),
                
                Tables\Columns\TextColumn::make('user.status')
                    ->label('Status')
                    ->badge()
                    ->color(fn ($state): string => match ($state) {
                        'ketua_kelas' => 'warning',
                        'normal' => 'gray',
                        null => 'gray',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn ($state): string => match ($state) {
                        'ketua_kelas' => 'Ketua Kelas',
                        'normal' => 'Normal',
                        null => 'Normal',
                        default => ucfirst($state ?? 'normal'),
                    })
                    ->searchable()
                    ->sortable(),
                
                Tables\Columns\TextColumn::make('jurusan')
                    ->label('Jurusan')
                    ->searchable()
                    ->sortable(),
                
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
                Tables\Filters\SelectFilter::make('kelas')
                    ->label('Kelas')
                    ->options(function () {
                        return \App\Models\Mahasiswa::whereNotNull('kelas')
                            ->distinct()
                            ->pluck('kelas', 'kelas')
                            ->toArray();
                    }),
                
                Tables\Filters\SelectFilter::make('jurusan')
                    ->label('Jurusan')
                    ->options(function () {
                        return \App\Models\Mahasiswa::whereNotNull('jurusan')
                            ->distinct()
                            ->pluck('jurusan', 'jurusan')
                            ->toArray();
                    }),
                
                Tables\Filters\SelectFilter::make('user.status')
                    ->label('Status')
                    ->relationship('user', 'status')
                    ->options([
                        'normal' => 'Normal',
                        'ketua_kelas' => 'Ketua Kelas',
                    ]),
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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMahasiswas::route('/'),
            'create' => Pages\CreateMahasiswa::route('/create'),
            'view' => Pages\ViewMahasiswa::route('/{record}'),
            'edit' => Pages\EditMahasiswa::route('/{record}/edit'),
        ];
    }
}
