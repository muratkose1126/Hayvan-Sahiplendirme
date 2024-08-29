<?php

namespace App\Filament\Resources\AnimalResource\Pages;

use App\Filament\Resources\AnimalResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Resources\Components\Tab;
use Illuminate\Database\Eloquent\Builder;

class ListAnimals extends ListRecords
{
    protected static string $resource = AnimalResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function getTabs(): array
    {
        return [
            'tüm' => Tab::make('Tüm Hayvanlar'),
            'sahiplenilmeyen' => Tab::make('Sahiplenilmeyen Hayvanlar')
                ->modifyQueryUsing(fn (Builder $query) => $query->whereDoesntHave('adopted')),
            'sahiplenilen' => Tab::make('Sahiplenilen Hayvanlar')
                ->modifyQueryUsing(fn (Builder $query) => $query->whereHas('adopted')),
        ];
    }
}
