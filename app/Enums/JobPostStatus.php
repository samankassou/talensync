<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

enum JobPostStatus: string implements HasColor, HasIcon, HasLabel
{
    case Draft = 'draft';

    case Scheduled = 'sheduled';

    case Published = 'published';

    case Cancelled = 'cancelled';

    case Expired = 'expired';

    public function getLabel(): string
    {
        return match ($this) {
            self::Draft => 'draft',
            self::Scheduled => 'Contacted',
            self::Published => 'published',
            self::Cancelled => 'cancelled',
            self::Expired => 'expired',
        };
    }

    public function getColor(): string | array | null
    {
        return match ($this) {
            self::Draft => 'info',
            self::Scheduled => 'warning',
            self::Published, => 'warning',
            self::Cancelled, => 'danger',
            self::Expired, => 'danger',
        };
    }

    public function getIcon(): ?string
    {
        return match ($this) {
            self::Draft => 'heroicon-m-sparkles',
            self::Scheduled => 'heroicon-m-arrow-path',
            self::Published => 'heroicon-m-truck',
            self::Cancelled => 'heroicon-m-truck',
            self::Expired => 'heroicon-m-truck',
        };
    }
}
