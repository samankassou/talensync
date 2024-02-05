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
            self::Draft => 'Draft',
            self::Scheduled => 'Scheduled',
            self::Published => 'Published',
            self::Cancelled => 'Cancelled',
            self::Expired => 'Expired',
        };
    }

    public function getColor(): string | array | null
    {
        return match ($this) {
            self::Draft => 'primary',
            self::Scheduled => 'info',
            self::Published, => 'success',
            self::Cancelled, => 'danger',
            self::Expired, => 'warning',
        };
    }

    public function getIcon(): ?string
    {
        return match ($this) {
            self::Draft => 'heroicon-m-sparkles',
            self::Scheduled => 'heroicon-m-arrow-path',
            self::Published => 'heroicon-m-paper-airplane',
            self::Expired => 'heroicon-m-clock',
            self::Cancelled => 'heroicon-m-x-circle',
        };
    }
}
