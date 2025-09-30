<?php

namespace App\Filament\Resources\Media\Pages;

use App\Filament\Resources\Media\MediaResource;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;

class CreateMedia extends CreateRecord
{
    protected static string $resource = MediaResource::class;

    protected function handleRecordCreation(array $data): Model
    {
        [
            'name' => $name,
            'model_type' => $modelType,
            'model_id' => $modelId,
            'file' => $file,
            'collection_name' => $collectionName,
        ] = $data;

        $media = $modelType::find($modelId)
            ->addMedia($file)
            ->usingName($name)
            ->toMediaCollection($collectionName);

        return $media;
    }
}
