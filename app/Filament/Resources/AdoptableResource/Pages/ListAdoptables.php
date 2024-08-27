<?php

namespace App\Filament\Resources\AdoptableResource\Pages;

use App\Filament\Resources\AdoptableResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAdoptables extends ListRecords
{
    protected static string $resource = AdoptableResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
