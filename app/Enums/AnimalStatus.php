<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum AnimalStatus: string implements HasLabel
{
    case New = "new";
    case Pending = "pending";
    case Published = "published";
    case Adopted = "adopted";

    public function getLabel() : string|null
    {
        return __($this->name);
    }
}
