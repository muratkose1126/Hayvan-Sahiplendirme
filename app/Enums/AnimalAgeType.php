<?php

namespace App\Enums;
use Filament\Support\Contracts\HasLabel;

enum AnimalAgeType: string implements HasLabel
{
    case Age = "age";
    case Monthly = "monthly";

    public function getLabel() : string|null
    {
        return __($this->name);
    }
}
