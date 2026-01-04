<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PendaftarOnlineResource\Pages;
use App\Models\PendaftarOnline;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\FileUpload;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\Action; // Penting untuk tombol custom

class PendaftarOnlineResource extends Resource
{
    protected static ?string $model = PendaftarOnline::class;

    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';
    protected static ?string $navigationLabel = 'Pendaftar Online';
    protected static ?string $navigationGroup = 'Penerimaan Siswa';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Status & Validasi')
                    ->schema([
                        Select::make('status')
                            ->options([
                                'Baru' => 'Baru',
                                'Diverifikasi' => 'Diverifikasi',
                                'Diterima' => 'Diterima',
                                'Ditolak' => 'Ditolak',
                            ])
                            ->default('Baru')
                            ->required(),
                    ]),

                Section::make('Data Diri Siswa')
                    ->schema([
                        TextInput::make('nama_lengkap')->required(),
                        TextInput::make('nama_panggilan'),
                        TextInput::make('nik')->label('NIK')->maxLength(16),
                        TextInput::make('tempat_lahir'),
                        DatePicker::make('tanggal_lahir'),
                        Select::make('jenis_kelamin')
                            ->options(['Laki-laki' => 'Laki-laki', 'Perempuan' => 'Perempuan']),
                        TextInput::make('agama'),
                        TextInput::make('warga_negara'),
                    ])->columns(2),

                Section::make('Data Akademik')
                    ->schema([
                        TextInput::make('sekolah_asal'),
                        TextInput::make('nisn')->label('NISN'),
                        TextInput::make('tingkat'),
                        Select::make('program_hs')
                            ->options([
                                'SAC' => 'Study At Class (SAC)',
                                'LOS' => 'Learning On Site (LOS)',
                                'Mandiri' => 'Mandiri',
                            ]),
                    ])->columns(2),

                Section::make('Data Orang Tua & Kontak')
                    ->schema([
                        TextInput::make('nama_ayah'),
                        TextInput::make('nama_ibu'),
                        TextInput::make('email_ortu')->label('Email')->email(),
                        TextInput::make('telp_hp_ortu')->label('No HP/WA'),
                        Textarea::make('alamat')->columnSpanFull(),
                    ])->columns(2),

                Section::make('Berkas Lampiran')
                    ->schema([
                        FileUpload::make('file_kk_ktp')
                            ->label('File KK & KTP')
                            ->disk('public') // Pastikan disk public
                            ->directory('berkas_pendaftaran')
                            ->visibility('public')
                            ->downloadable()
                            ->openable(),
                        
                        FileUpload::make('file_ijazah')
                            ->label('File Ijazah')
                            ->disk('public')
                            ->directory('berkas_pendaftaran')
                            ->visibility('public')
                            ->downloadable()
                            ->openable(),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('created_at')->dateTime('d M Y')->label('Tanggal'),
                TextColumn::make('nama_lengkap')->searchable()->weight('bold'),
                TextColumn::make('program_hs')->badge()->color('info'),
                TextColumn::make('telp_hp_ortu')->label('WhatsApp'),
                TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'Baru' => 'gray',
                        'Diterima' => 'success',
                        'Ditolak' => 'danger',
                        'Diverifikasi' => 'warning',
                        default => 'primary',
                    }),
            ])
            ->filters([
                SelectFilter::make('status'),
            ])
            ->actions([
                EditAction::make(),
                ViewAction::make(),
                
                // TOMBOL DOWNLOAD PDF (Sudah diperbaiki posisinya)
                Action::make('download')
                    ->label('Unduh PDF')
                    ->icon('heroicon-o-arrow-down-tray')
                    ->color('success')
                    ->url(fn (PendaftarOnline $record) => route('admin.download.pdf', $record))
                    ->openUrlInNewTab(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
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
            'index' => Pages\ListPendaftarOnlines::route('/'),
            'create' => Pages\CreatePendaftarOnline::route('/create'),
            'edit' => Pages\EditPendaftarOnline::route('/{record}/edit'),
        ];
    }
}