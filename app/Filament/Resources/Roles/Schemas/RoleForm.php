<?php

namespace App\Filament\Resources\Roles\Schemas;

use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Spatie\Permission\Models\Permission;

class RoleForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Role Details')
                    ->description('Roles group permissions together. Assign roles to admin users from the Users resource.')
                    ->columns(2)
                    ->schema([
                        TextInput::make('name')
                            ->required()
                            ->maxLength(255)
                            ->regex('/^[a-z][a-z0-9\-_]*$/')
                            ->unique(ignoreRecord: true)
                            ->helperText('Lowercase, e.g. "content-manager".'),
                        TextInput::make('guard_name')
                            ->default('web')
                            ->disabled()
                            ->helperText('Created with the "web" guard.'),
                    ]),
                Section::make('Permissions')
                    ->description('Tick the permissions this role should grant. The super-admin role always has access to everything.')
                    ->schema([
                        CheckboxList::make('permissions')
                            ->relationship('permissions', 'name')
                            ->searchable()
                            ->bulkToggleable()
                            ->columns(3)
                            ->gridDirection('row')
                            ->options(function (): array {
                                return Permission::query()
                                    ->orderBy('name')
                                    ->get()
                                    ->groupBy(fn (Permission $permission) => str($permission->name)
                                        ->before('.')
                                        ->headline()
                                        ->toString())
                                    ->mapWithKeys(fn ($permissions, $group) => [
                                        $group => $permissions->pluck('name', 'id'),
                                    ])
                                    ->all();
                            }),
                    ]),
            ]);
    }
}