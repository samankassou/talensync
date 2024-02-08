<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\JobPost;
use Filament\Forms\Get;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Enums\JobPostStatus;
use Filament\Resources\Resource;
use App\Enums\JobPostContractType;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Illuminate\Database\Eloquent\Builder;
use Filament\Infolists;
use Filament\Infolists\Infolist;
use App\Filament\Resources\JobPostResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\JobPostResource\RelationManagers;

class JobPostResource extends Resource
{
    protected static ?string $model = JobPost::class;

    protected static ?string $navigationGroup = 'Recruitment';

    protected static ?string $navigationIcon = 'heroicon-o-newspaper';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Grid::make(6)
                    ->schema([
                        Grid::make()
                            ->schema([
                                Section::make()
                                    ->schema([
                                        Forms\Components\TextInput::make('title')
                                            ->required()
                                            ->maxLength(255),
                                        Forms\Components\TextInput::make('available_positions')
                                            ->numeric()
                                            ->required(),
                                        Forms\Components\Select::make('contract_type')
                                            ->required()
                                            ->options(JobPostContractType::class),
                                        Forms\Components\Select::make('city_id')
                                            ->relationship('city', 'name'),
                                        Forms\Components\DatePicker::make('expiry_date')
                                            ->required()
                                            ->minDate(now()),
                                        Forms\Components\MarkdownEditor::make('description')
                                            ->required()
                                            ->maxLength(65535)
                                            ->columnSpan('full'),
                                        Forms\Components\FileUpload::make('banner')
                                            ->columnSpan('full'),
                                    ])->columns(2),
                            ])
                            ->columnSpan(4),
                        Grid::make()
                            ->schema([
                                Section::make('Publishing')
                                    ->description('Settings for publishing this job post.')
                                    ->schema([
                                        Forms\Components\ToggleButtons::make('status')
                                            ->inline()
                                            ->options(JobPostStatus::class)
                                            ->hiddenOn('create')
                                            ->required()
                                            ->live(),
                                        Forms\Components\DateTimePicker::make('publish_date')
                                            ->disabled()
                                            ->hidden(fn (Get $get) => $get('status') !== 'published'),
                                    ])->columns(1),
                            ])->columnSpan(2),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title'),
                Tables\Columns\TextColumn::make('status')
                    ->badge(),
                Tables\Columns\TextColumn::make('city.name'),
                Tables\Columns\TextColumn::make('city.country.name'),
                Tables\Columns\TextColumn::make('description')
                    ->limit(30),
                Tables\Columns\TextColumn::make('contract_type')
                    ->badge(),
                Tables\Columns\TextColumn::make('candidates_count')
                    ->label('Candidates')
                    ->counts('candidates'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Infolists\Components\Grid::make(6)
                    ->schema([
                        Infolists\Components\Grid::make()
                            ->schema([
                                // left content
                                Infolists\Components\TextEntry::make('title'),
                                Infolists\Components\TextEntry::make('description')
                                    ->columnSpan(2)
                                    ->markdown(),
                                Infolists\Components\TextEntry::make('city.name'),
                                Infolists\Components\TextEntry::make('city.country.name')
                                    ->label('Country'),
                            ])->columns(4),
                        Infolists\Components\Grid::make()
                            ->schema([
                                // right content
                                Infolists\Components\TextEntry::make('status')
                                    ->badge(),
                                Infolists\Components\TextEntry::make('contract_type')
                                    ->badge(),
                                Infolists\Components\ImageEntry::make('banner'),
                            ])->columns(2)
                    ])
            ]);
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\CandidatesRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListJobPosts::route('/'),
            'create' => Pages\CreateJobPost::route('/create'),
            'view' => Pages\ViewJobPost::route('/{record}'),
            'edit' => Pages\EditJobPost::route('/{record}/edit'),
        ];
    }
}
