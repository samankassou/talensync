<?php

namespace App\Filament\Resources;

use App\Enums\CandidateStatus;
use App\Filament\Resources\CandidateResource\Pages;
use App\Filament\Resources\CandidateResource\RelationManagers;
use App\Models\Candidate;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\Section;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CandidateResource extends Resource
{
    protected static ?string $model = Candidate::class;

    protected static ?string $navigationGroup = 'Recruitment';

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()
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
                    ])->columns(2)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCandidates::route('/'),
            'create' => Pages\CreateCandidate::route('/create'),
            'edit' => Pages\EditCandidate::route('/{record}/edit'),
        ];
    }
}
