<?php

namespace App\Filament\Resources\AdoptableResource\Pages;

use App\Filament\Resources\AdoptableResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAdoptable extends EditRecord
{
    protected static string $resource = AdoptableResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            Actions\ForceDeleteAction::make(),
            Actions\RestoreAction::make(),
        ];
    }
}
