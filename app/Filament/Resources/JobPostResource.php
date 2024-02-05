<?php

namespace App\Filament\Resources;

use App\Enums\JobPostStatus;
use App\Filament\Resources\JobPostResource\Pages;
use App\Filament\Resources\JobPostResource\RelationManagers;
use App\Models\JobPost;
use Filament\Forms;
use Filament\Forms\Components\Grid;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Section;

class JobPostResource extends Resource
{
    protected static ?string $model = JobPost::class;

    protected static ?string $navigationGroup = 'Recruitment';

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

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
                                            ->required(),
                                        Forms\Components\DateTimePicker::make('publish_date'),
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
                Tables\Columns\TextColumn::make('description')
                    ->limit(30),
                Tables\Columns\TextColumn::make('candidates_count')->counts('candidates'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
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
            'edit' => Pages\EditJobPost::route('/{record}/edit'),
        ];
    }
}
