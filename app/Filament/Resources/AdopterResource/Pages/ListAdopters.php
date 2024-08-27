<?php

namespace App\Filament\Resources\AdopterResource\Pages;

use App\Filament\Resources\AdopterResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAdopters extends ListRecords
{
    protected static string $resource = AdopterResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
