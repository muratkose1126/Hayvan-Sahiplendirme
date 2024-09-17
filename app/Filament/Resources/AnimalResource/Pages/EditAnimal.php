<?php

namespace App\Filament\Resources\AnimalResource\Pages;

use App\Filament\Resources\AnimalResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAnimal extends EditRecord
{
    protected static string $resource = AnimalResource::class;

    protected function getHeaderActions() : array
    {
        return [
            Actions\Action::make('status')
                ->label(fn ($record) => $record->status->getLabel())
                ->color(fn ($record) => $record->status->getColor())
                ->outlined()
                ->disabled(),

            Actions\DeleteAction::make(),
            Actions\ForceDeleteAction::make(),
            Actions\RestoreAction::make(),
        ];
    }
}
