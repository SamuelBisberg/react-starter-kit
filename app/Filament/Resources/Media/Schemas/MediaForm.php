<?php

namespace App\Filament\Resources\Media\Schemas;

use App\Enums\UserMediaCollectionEum;
use App\Interfaces\HasTitleAttributeName;
use App\Support\ReflectionCollection;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\MorphToSelect;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Spatie\MediaLibrary\HasMedia;

class MediaForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                MorphToSelect::make('model')
                    ->label('Related Model')
                    ->types(
                        ReflectionCollection::fromDirectory('Models')
                            ->implementsInterface(HasMedia::class, HasTitleAttributeName::class)
                            ->getClassNames()
                            ->map(function (string $className) {
                                $attributeName = $className::getTitleAttributeName();

                                return MorphToSelect\Type::make($className)
                                    ->titleAttribute($attributeName)
                                    ->getOptionLabelFromRecordUsing(fn ($state) => $state?->{$attributeName}.' ('.$state->id.')');
                            })->toArray()
                    )
                    ->searchable()
                    ->native()
                    ->columnSpanFull(),

                TextInput::make('name')
                    ->label('Name')
                    ->required()
                    ->maxLength(500)
                    ->columnSpanFull(),

                Select::make('collection_name')
                    ->label('Collection')
                    ->options(UserMediaCollectionEum::plucked())
                    ->afterStateUpdated(fn (callable $set, $state) => $set('disk', UserMediaCollectionEum::tryFrom($state)?->disk()))
                    ->reactive()
                    ->required(),

                TextInput::make('disk')
                    ->label('Disk')
                    ->readOnly()
                    ->maxLength(255),

                TextInput::make('mime_type')
                    ->label('MIME Type')
                    ->maxLength(255)
                    ->readOnly(),

                TextInput::make('size')
                    ->numeric()
                    ->label('Size (bytes)')
                    ->readOnly(),

                FileUpload::make('file')
                    ->label('Upload File')
                    ->columnSpanFull()
                    ->storeFiles(false)
                    ->afterStateUpdated(function (callable $set, $state) {
                        if (is_string($state)) {
                            return;
                        }

                        if ($state?->getClientOriginalName()) {
                            $set('name', $state->getClientOriginalName());
                            $set('mime_type', $state->getMimeType());
                            $set('size', $state->getSize());
                        } else {
                            $set('name', null);
                            $set('mime_type', null);
                            $set('size', null);
                        }
                    })
                    ->required(fn (string $context): bool => $context === 'create'),
            ]);
    }
}
