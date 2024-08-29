<?php

namespace App\Filament\Resources\AdoptedResource\Pages;

use App\Filament\Resources\AdoptedResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAdopted extends EditRecord
{
    protected static string $resource = AdoptedResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            Actions\ForceDeleteAction::make(),
            Actions\RestoreAction::make(),
        ];
    }
}
