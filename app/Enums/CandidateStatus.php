<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

enum CandidateStatus: string implements HasColor, HasIcon, HasLabel
{
    case New = 'new';

    case Contacted = 'contated';

    case Interviewed = 'interviewed';

    case Hired = 'hired';

    case Rejected = 'rejected';

    public function getLabel(): string
    {
        return match ($this) {
            self::New => 'New',
            self::Contacted => 'Contacted',
            self::Interviewed => 'Interviewed',
            self::Hired => 'Hired',
            self::Rejected => 'Rejected',
        };
    }

    public function getColor(): string | array | null
    {
        return match ($this) {
            self::New => 'info',
            self::Contacted => 'warning',
            self::Interviewed, => 'warning',
            self::Hired => 'success',
            self::Rejected => 'danger',
        };
    }

    public function getIcon(): ?string
    {
        return match ($this) {
            self::New => 'heroicon-m-sparkles',
            self::Contacted => 'heroicon-m-arrow-path',
            self::Interviewed => 'heroicon-m-truck',
            self::Hired => 'heroicon-m-check-badge',
            self::Rejected => 'heroicon-m-x-circle',
        };
    }
}
