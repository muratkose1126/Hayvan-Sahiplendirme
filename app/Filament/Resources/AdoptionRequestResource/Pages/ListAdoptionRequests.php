<?php

namespace App\Filament\Resources\AdoptionRequestResource\Pages;

use App\Enums\AdoptionStatus;
use App\Filament\Resources\AdoptionRequestResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Tables;
use Filament\Resources\Components\Tab;

class ListAdoptionRequests extends ListRecords
{
    protected static string $resource = AdoptionRequestResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function getTabs(): array
    {
        return [
            Tab::make(__('All')),
            Tab::make(__('New'))->modifyQueryUsing(fn ($query) =>$query->where("status",AdoptionStatus::New)),
            Tab::make(__('Pending'))->modifyQueryUsing(fn ($query) =>$query->where("status",AdoptionStatus::Pending)),
            Tab::make(__('Complete'))->modifyQueryUsing(fn ($query) =>$query->where("status",AdoptionStatus::Complete)),
            Tab::make(__('Reject'))->modifyQueryUsing(fn ($query) =>$query->where("status",AdoptionStatus::Reject)),
        ];
    }
}
