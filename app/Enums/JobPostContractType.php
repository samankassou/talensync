<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

enum JobPostContractType: string implements HasColor, HasIcon, HasLabel
{
    case Internship = 'internship';

    case PartTime = 'part_time';

    case FullTime = 'full_time';

    case Temporary = 'temporary';

    case IndependentContract = 'independent_contract';

    public function getLabel(): string
    {
        return match ($this) {
            self::Internship => 'Internship',
            self::PartTime => 'Part time',
            self::FullTime => 'Full time',
            self::Temporary => 'Temporary',
            self::IndependentContract => 'Independent contract',
        };
    }

    public function getColor(): string | array | null
    {
        return match ($this) {
            self::Internship => 'primary',
            self::PartTime => 'info',
            self::FullTime, => 'success',
            self::Temporary, => 'danger',
            self::IndependentContract, => 'warning',
        };
    }

    public function getIcon(): ?string
    {
        return match ($this) {
            self::Internship => 'heroicon-m-sparkles',
            self::PartTime => 'heroicon-m-calendar-days',
            self::FullTime => 'heroicon-m-briefcase',
            self::Temporary => 'heroicon-m-clock',
            self::IndependentContract => 'heroicon-m-receipt-percent',
        };
    }
}
