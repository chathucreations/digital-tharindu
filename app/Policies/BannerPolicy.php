<?php

namespace App\Policies;

use App\Policies\Concerns\ResourcePermissions;
use App\Support\Permissions;

class BannerPolicy
{
    use ResourcePermissions;

    protected static function resourcePrefix(): string
    {
        return Permissions::RESOURCE_BANNERS;
    }
}