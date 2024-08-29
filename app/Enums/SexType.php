<?php

namespace App\Enums;
use Filament\Support\Contracts\HasLabel;

enum SexType: string implements HasLabel
{
    case Male = "male";
    case Female = "female";

    public function getLabel() : string|null
    {
        return __($this->name);
    }
}
