<?php

namespace App\Filament\Resources\Users\Pages;

use App\Filament\Resources\Users\UserResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditUser extends EditRecord
{
    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        // ignore password if not provided
        if (empty($data['password'])) {
            unset($data['password']);
        }

        // set email_verified_at to null if email has changed
        if (isset($data['email']) && $data['email'] !== $this->record->email) {
            $data['email_verified_at'] = null;
        }

        return $data;
    }

    protected function afterSave(): void
    {
        $this->fillForm();
    }
}
