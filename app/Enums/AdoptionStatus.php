<?php

namespace App\Enums;
use Filament\Support\Contracts\HasLabel;

enum AdoptionStatus: string implements HasLabel
{
    case New = "new";
    case Pending = "pending";
    case Reject = "reject";
    case Complete = "complete";

    public function getLabel() : string|null
    {
        return __($this->name);
    }
}
