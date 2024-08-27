<?php

namespace App\Filament\Resources\AdoptableResource\Pages;

use App\Filament\Resources\AdoptableResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateAdoptable extends CreateRecord
{
    protected static string $resource = AdoptableResource::class;
}
