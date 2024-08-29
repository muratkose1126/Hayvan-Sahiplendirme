<?php

namespace App\Filament\Resources\AdoptedResource\Pages;

use App\Filament\Resources\AdoptedResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAdopteds extends ListRecords
{
    protected static string $resource = AdoptedResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
