<?php

namespace App\Filament\Resources\PendaftarTrialResource\Pages;

use App\Filament\Resources\PendaftarTrialResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPendaftarTrials extends ListRecords
{
    protected static string $resource = PendaftarTrialResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
