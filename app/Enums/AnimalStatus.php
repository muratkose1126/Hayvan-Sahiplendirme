<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum AnimalStatus: string implements HasLabel, HasColor
{
    case New = "new";
    case Pending = "pending";
    case Published = "published";
    case Adopted = "adopted";
    case Expired = "expired";

    public function getLabel() : string|null
    {
        return __($this->name);
    }

    public function getColor() : string|array|null
    {
        return match ($this) {
            self::New => 'primary',
            self::Pending => 'warning',
            self::Published => 'success',
            self::Adopted => 'info',
            self::Expired => 'danger',
        };
    }
}
