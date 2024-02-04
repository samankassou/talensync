<?php

namespace App\Filament\Resources\CandidateResource\Pages;

use Filament\Actions;
use App\Models\Candidate;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\CandidateResource;

class ListCandidates extends ListRecords
{
    protected static string $resource = CandidateResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function getTabs(): array
    {
        return [
            'all' => Tab::make('All candidates')
                ->badge(Candidate::count()),
            'new' => Tab::make()
                ->icon('heroicon-m-sparkles')
                ->badge(Candidate::query()->where('status', 'new')->count())
                ->badgeColor('info')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', 'new')),
            'contated' => Tab::make()
                ->icon('heroicon-m-phone-arrow-up-right')
                ->badge(Candidate::query()->where('status', 'contated')->count())
                ->badgeColor('warning')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', 'contated')),
            'interviewed' => Tab::make()
                ->icon('heroicon-m-chat-bubble-left-right')
                ->badge(Candidate::query()->where('status', 'interviewed')->count())
                ->badgeColor('warning')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', 'interviewed')),
            'hired' => Tab::make()
                ->icon('heroicon-m-check-badge')
                ->badge(Candidate::query()->where('status', 'hired')->count())
                ->badgeColor('success')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', 'hired')),
            'rejected' => Tab::make()
                ->icon('heroicon-m-x-circle')
                ->badge(Candidate::query()->where('status', 'rejected')->count())
                ->badgeColor('danger')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', 'rejected')),
        ];
    }
}
