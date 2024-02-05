<?php

namespace App\Filament\Resources\JobPostResource\RelationManagers;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use App\Models\Candidate;
use Filament\Tables\Table;
use App\Enums\CandidateStatus;
use Filament\Forms\Components\Section;
use Filament\Resources\Components\Tab;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Resources\RelationManagers\RelationManager;

class CandidatesRelationManager extends RelationManager
{
    protected static string $relationship = 'candidates';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('firstname')
                    ->maxLength(255),
                Forms\Components\TextInput::make('lastname')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('email')
                    ->label('Email address')
                    ->email()
                    ->required()
                    ->maxLength(255),
                Forms\Components\Select::make('gender')
                    ->options([
                        'M' => 'Masculin',
                        'F' => 'Féminin',
                    ])
                    ->required(),
                Forms\Components\DatePicker::make('date_of_birth')
                    ->required()
                    ->maxDate(now()),
                Forms\Components\TextInput::make('phone')
                    ->label('Phone number')
                    ->tel(),
                Forms\Components\Select::make('city_id')
                    ->relationship('city', 'name'),
                Forms\Components\ToggleButtons::make('status')
                    ->inline()
                    ->options(CandidateStatus::class)
                    ->hiddenOn('create')
                    ->required(),
                Forms\Components\Select::make('job_post_id')
                    ->relationship('jobPost', 'title'),
                Forms\Components\FileUpload::make('resume'),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('lastname')
            ->columns([
                Tables\Columns\TextColumn::make('firstname'),
                Tables\Columns\TextColumn::make('lastname'),
                Tables\Columns\TextColumn::make('date_of_birth'),
                Tables\Columns\TextColumn::make('gender'),
                Tables\Columns\TextColumn::make('city.country.name'),
                Tables\Columns\TextColumn::make('jobPost.title'),
                Tables\Columns\TextColumn::make('status')
                    ->badge(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
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
