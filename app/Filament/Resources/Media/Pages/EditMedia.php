<?php

namespace App\Filament\Resources\Media\Pages;

use App\Filament\Resources\Media\MediaResource;
use Filament\Actions;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
use Filament\Support\Icons\Heroicon;
use Illuminate\Database\Eloquent\Model;

class EditMedia extends EditRecord
{
    protected static string $resource = MediaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
            Actions\Action::make('download')
                ->label(__('Download'))
                ->icon(Heroicon::OutlinedDocumentArrowDown)
                ->color('gray')
                ->action(fn ($record) => response()->download($record->getPath(), $record->name)),
        ];
    }

    protected function handleRecordUpdate(Model $record, array $data): Model
    {
        [
            'name' => $name,
            'model_type' => $modelType,
            'model_id' => $modelId,
            'file' => $file,
            'collection_name' => $collectionName,
        ] = $data;

        if ($file) {
            $record->delete();
            $media = $modelType::find($modelId)
                ->addMedia($file)
                ->usingName($name)
                ->toMediaCollection($collectionName);
        } else {
            $record->name = $name;
            $record->save();
        }

        return $record;
    }
}
