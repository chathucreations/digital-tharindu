<?php

namespace App\Filament\Resources\Activities\Tables;

use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class ActivitiesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('created_at')
                    ->label('When')
                    ->dateTime()
                    ->sortable()
                    ->since(),
                TextColumn::make('log_name')
                    ->label('Type')
                    ->badge()
                    ->color('gray')
                    ->formatStateUsing(fn ($state) => $state ? ucfirst(str_replace('_', ' ', $state)) : '—'),
                TextColumn::make('description')
                    ->searchable()
                    ->wrap()
                    ->weight('semibold'),
                TextColumn::make('event')
                    ->badge()
                    ->placeholder('—')
                    ->color(fn ($state) => match ($state) {
                        'created' => 'success',
                        'updated' => 'warning',
                        'deleted' => 'danger',
                        default => 'gray',
                    }),
                TextColumn::make('subject_type')
                    ->label('Subject')
                    ->formatStateUsing(fn ($state, $record) => $state
                        ? class_basename($state) . ($record->subject_id ? ' #' . $record->subject_id : '')
                        : '—')
                    ->searchable(),
                TextColumn::make('causer.name')
                    ->label('By')
                    ->placeholder('System')
                    ->searchable(),
            ])
            ->filters([
                SelectFilter::make('log_name')
                    ->label('Type')
                    ->options([
                        'user' => 'User',
                        'order' => 'Order',
                        'invoice' => 'Invoice',
                        'product' => 'Product',
                        'product_variation' => 'Price variation',
                        'category' => 'Category',
                        'slider' => 'Slider',
                        'settings' => 'Settings',
                        'contact' => 'Contact',
                        'auth' => 'Authentication',
                    ]),
                SelectFilter::make('event')
                    ->options([
                        'created' => 'Created',
                        'updated' => 'Updated',
                        'deleted' => 'Deleted',
                    ]),
            ])
            ->recordActions([
                ViewAction::make(),
            ])
            ->defaultSort('created_at', 'desc')
            ->defaultPaginationPageOption(25);
    }
}
