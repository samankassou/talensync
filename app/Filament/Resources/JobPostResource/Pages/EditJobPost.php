<?php

namespace App\Filament\Resources\JobPostResource\Pages;

use App\Enums\JobPostStatus;
use App\Filament\Resources\JobPostResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditJobPost extends EditRecord
{
    protected static string $resource = JobPostResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $data['is_published'] = $data['status'] === JobPostStatus::Published->value;

        return $data;
    }
}
