<?php

namespace App\Filament\Resources\PendaftarTrialResource\Pages;

use App\Filament\Resources\PendaftarTrialResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPendaftarTrial extends EditRecord
{
    protected static string $resource = PendaftarTrialResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
