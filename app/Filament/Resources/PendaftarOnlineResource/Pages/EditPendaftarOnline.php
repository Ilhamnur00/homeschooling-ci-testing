<?php

namespace App\Filament\Resources\PendaftarOnlineResource\Pages;

use App\Filament\Resources\PendaftarOnlineResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPendaftarOnline extends EditRecord
{
    protected static string $resource = PendaftarOnlineResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
