<?php

namespace App\Filament\Resources\Media\Tables;

use Filament\Actions;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class MediaTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('name')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('file_name')
                    ->label('File')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('mime_type')
                    ->label('MIME')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: false),

                TextColumn::make('size')
                    ->label('Size')
                    ->formatStateUsing(
                        fn ($state) => $state
                            ? ($state >= 1048576
                                ? number_format($state / 1048576, 2).' MB'
                                : number_format($state / 1024, 2).' KB'
                            )
                            : '0 KB'
                    )
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: false),

                TextColumn::make('polymorphic')
                    ->label('Attached To')
                    ->getStateUsing(fn ($record) => "{$record->model_type} #{$record->model_id}")
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('collection_name')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('disk')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('conversions_disk')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('uuid')
                    ->copyable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('order_column')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('created_at')
                    ->dateTime('Y-m-d H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: false),

                TextColumn::make('updated_at')
                    ->dateTime('Y-m-d H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                // e.g. add filter by disk or collection_name later
            ])
            ->recordActions([
                Actions\Action::make('download')
                    ->label(__('Download'))
                    ->icon(Heroicon::OutlinedDocumentArrowDown)
                    ->color('success')
                    ->action(fn ($record) => response()->download($record->getPath(), $record->name)),
                EditAction::make(),

            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
