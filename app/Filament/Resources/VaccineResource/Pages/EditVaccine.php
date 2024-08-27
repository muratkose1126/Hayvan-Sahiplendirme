<?php

namespace App\Filament\Resources\VaccineResource\Pages;

use App\Filament\Resources\VaccineResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditVaccine extends EditRecord
{
    protected static string $resource = VaccineResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            Actions\ForceDeleteAction::make(),
            Actions\RestoreAction::make(),
        ];
    }
}
