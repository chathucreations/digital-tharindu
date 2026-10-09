<?php

namespace App\Filament\Resources\Roles\Pages;

use App\Filament\Resources\Roles\RoleResource;
use Filament\Resources\Pages\CreateRecord;

class CreateRole extends CreateRecord
{
    protected static string $resource = RoleResource::class;

    protected function afterCreate(): void
    {
        activity('role')
            ->causedBy(auth()->user())
            ->performedOn($this->record)
            ->withProperties(['permissions' => $this->record->permissions->pluck('name')->all()])
            ->log('Role created');
    }
}