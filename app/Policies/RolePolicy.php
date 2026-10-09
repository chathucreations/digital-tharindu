<?php

namespace App\Policies;

use App\Policies\Concerns\ResourcePermissions;
use App\Support\Permissions;

class RolePolicy
{
    use ResourcePermissions;

    protected static function resourcePrefix(): string
    {
        return Permissions::RESOURCE_ROLES;
    }
}