<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PengajarResource\Pages;
use App\Filament\Resources\PengajarResource\RelationManagers;
use App\Models\Pengajar;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;

class PengajarResource extends Resource
{
    protected static ?string $model = Pengajar::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('nama')
                    ->required()
                    ->maxLength(255),
                TextInput::make('jabatan')
                    ->label('Jabatan / Mata Pelajaran')
                    ->required()
                    ->maxLength(255),
                FileUpload::make('foto')
                    ->image()
                    ->directory('pengajar') // Simpan di folder storage/app/public/pengajar
                    ->disk('public') // Wajib disk public
                    ->columnSpanFull(),
                Textarea::make('deskripsi')
                    ->label('Deskripsi Singkat')
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('foto')
                    ->circular(),
                TextColumn::make('nama')
                    ->sortable()
                    ->searchable()
                    ->weight('bold'),
                TextColumn::make('jabatan')
                    ->searchable(),
            ])
            // ... sisa kode default ...
        ;
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
            'index' => Pages\ListPengajars::route('/'),
            'create' => Pages\CreatePengajar::route('/create'),
            'edit' => Pages\EditPengajar::route('/{record}/edit'),
        ];
    }
}
