<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PendaftarTrialResource\Pages;
use App\Models\PendaftarTrial;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\Section;

class PendaftarTrialResource extends Resource
{
    protected static ?string $model = PendaftarTrial::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-plus';
    protected static ?string $navigationLabel = 'Pendaftar Trial';
    protected static ?string $navigationGroup = 'Penerimaan Siswa';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Status Trial')
                    ->schema([
                        Forms\Components\Select::make('status')
                            ->options([
                                'Menunggu' => 'Menunggu',
                                'Dijadwalkan' => 'Dijadwalkan',
                                'Selesai' => 'Selesai',
                            ])
                            ->default('Menunggu')
                            ->required(),
                    ]),

                Section::make('Data Calon Siswa')
                    ->schema([
                        Forms\Components\TextInput::make('nama_lengkap')->required(),
                        Forms\Components\TextInput::make('nama_panggilan'),
                        Forms\Components\Select::make('jenis_kelamin')
                            ->options(['Laki-laki' => 'Laki-laki', 'Perempuan' => 'Perempuan']),
                        Forms\Components\TextInput::make('asal_sekolah'),
                        Forms\Components\TextInput::make('dari_kelas'),
                    ])->columns(2),

                Section::make('Kontak Orang Tua')
                    ->schema([
                        Forms\Components\TextInput::make('nama_orangtua')->label('Nama Orang Tua'),
                        Forms\Components\TextInput::make('telp_hp_ortu')->label('No HP/WA')->tel(),
                        Forms\Components\Textarea::make('alamat')->columnSpanFull(),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('created_at')->dateTime('d M Y')->label('Tanggal'),
                Tables\Columns\TextColumn::make('nama_lengkap')->searchable()->weight('bold'),
                Tables\Columns\TextColumn::make('dari_kelas')->label('Kelas'),
                Tables\Columns\TextColumn::make('telp_hp_ortu')->label('WhatsApp'),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'Menunggu' => 'danger',
                        'Dijadwalkan' => 'warning',
                        'Selesai' => 'success',
                        default => 'gray',
                    }),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                // Tombol Hubungi WA
                Tables\Actions\Action::make('Hubungi')
                    ->icon('heroicon-o-chat-bubble-left-right')
                    ->url(fn (PendaftarTrial $record) => "https://wa.me/" . preg_replace('/^0/', '62', preg_replace('/[^0-9]/', '', $record->telp_hp_ortu)), true)
                    ->openUrlInNewTab(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPendaftarTrials::route('/'),
            'create' => Pages\CreatePendaftarTrial::route('/create'),
            'edit' => Pages\EditPendaftarTrial::route('/{record}/edit'),
        ];
    }
}