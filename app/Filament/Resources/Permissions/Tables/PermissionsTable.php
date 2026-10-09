<?php

namespace App\Filament\Resources\Permissions\Tables;

use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class PermissionsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable()
                    ->sortable()
                    ->weight('bold')
                    ->description(fn ($record) => str($record->name)->before('.')->headline()->toString()),
                TextColumn::make('guard_name')
                    ->label('Guard')
                    ->sortable(),
                TextColumn::make('roles_count')
                    ->counts('roles')
                    ->label('Roles')
                    ->badge()
                    ->color('warning'),
            ])
            ->recordActions([])
            ->defaultSort('name');
    }
}