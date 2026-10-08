<?php

namespace App\Filament\Resources\Activities\Schemas;

use Filament\Infolists\Components\CodeEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ActivityInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make()
                    ->schema([
                        TextEntry::make('description')
                            ->weight('bold')
                            ->columnSpanFull(),
                        TextEntry::make('log_name')
                            ->label('Type')
                            ->badge()
                            ->formatStateUsing(fn ($state) => $state ? ucfirst(str_replace('_', ' ', $state)) : '—'),
                        TextEntry::make('event')
                            ->badge()
                            ->placeholder('—')
                            ->color(fn ($state) => match ($state) {
                                'created' => 'success',
                                'updated' => 'warning',
                                'deleted' => 'danger',
                                default => 'gray',
                            }),
                        TextEntry::make('created_at')->label('When')->dateTime(),
                        TextEntry::make('causer.name')->label('Caused by')->placeholder('System'),
                        TextEntry::make('subject')
                            ->state(fn ($record) => $record->subject_type
                                ? class_basename($record->subject_type) . ' #' . $record->subject_id
                                : '—'),
                    ])
                    ->columns(3),
                Section::make('Changes / Details')
                    ->schema([
                        CodeEntry::make('properties')
                            ->state(fn ($record) => json_encode(
                                $record->properties->toArray(),
                                JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES,
                            ))
                            ->columnSpanFull(),
                    ]),
            ]);
    }
}
