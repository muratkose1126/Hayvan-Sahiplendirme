<?php

namespace App\Filament\Resources\AdopterResource\Pages;

use App\Filament\Resources\AdopterResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAdopter extends EditRecord
{
    protected static string $resource = AdopterResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            Actions\ForceDeleteAction::make(),
            Actions\RestoreAction::make(),
        ];
    }
}
