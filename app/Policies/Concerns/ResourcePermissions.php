<?php

namespace App\Policies\Concerns;

use App\Models\User;
use App\Support\Permissions;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Permission;

/**
 * Maps a resource's CRUD policy methods to its permission keys
 * ("<resource>.view_any / create / update / delete").
 *
 * The super-admin role bypasses everything via Gate::before, so these
 * only matter for the explicitly-assigned roles (admin, manager, ...).
 */
trait ResourcePermissions
{
    abstract protected static function resourcePrefix(): string;

    protected static function can(User $user, string $ability): bool
    {
        $permission = Permissions::resource(static::resourcePrefix(), $ability);

        // Defensive: a permission may not exist for an ability a resource
        // never exposes (e.g. "orders.delete"). Treat it as denied.
        if (! Permission::query()->where('name', $permission)->where('guard_name', 'web')->exists()) {
            return false;
        }

        return $user->hasPermissionTo($permission);
    }

    public function viewAny(User $user): bool
    {
        return static::can($user, 'view_any');
    }

    public function view(User $user, Model $model): bool
    {
        return static::can($user, 'view_any');
    }

    public function create(User $user): bool
    {
        return static::can($user, 'create');
    }

    public function update(User $user, Model $model): bool
    {
        return static::can($user, 'update');
    }

    public function delete(User $user, Model $model): bool
    {
        return static::can($user, 'delete');
    }

    public function deleteAny(User $user): bool
    {
        return static::can($user, 'delete');
    }

    public function restore(User $user, Model $model): bool
    {
        return static::can($user, 'delete');
    }

    public function restoreAny(User $user): bool
    {
        return static::can($user, 'delete');
    }

    public function forceDelete(User $user, Model $model): bool
    {
        return static::can($user, 'delete');
    }

    public function forceDeleteAny(User $user): bool
    {
        return static::can($user, 'delete');
    }

    public function reorder(User $user): bool
    {
        return static::can($user, 'update');
    }

    public function replicate(User $user, Model $model): bool
    {
        return static::can($user, 'create');
    }
}