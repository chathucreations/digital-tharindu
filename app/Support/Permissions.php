<?php

namespace App\Support;

/**
 * Central definition of every admin permission and role.
 *
 * Permission names follow the "<resource>.<ability>" convention so the
 * Filament resources (via model policies) and the RoleResource checkboxes
 * stay in sync automatically.
 */
class Permissions
{
    public const RESOURCE_CATEGORIES = 'categories';

    public const RESOURCE_PRODUCTS = 'products';

    public const RESOURCE_ORDERS = 'orders';

    public const RESOURCE_INVOICES = 'invoices';

    public const RESOURCE_USERS = 'users';

    public const RESOURCE_BANNERS = 'banners';

    public const RESOURCE_SLIDERS = 'sliders';

    public const RESOURCE_CONTACT_MESSAGES = 'contact_messages';

    public const RESOURCE_ACTIVITIES = 'activities';

    public const RESOURCE_ROLES = 'roles';

    public const RESOURCE_PERMISSIONS = 'permissions';

    public static function resource(string $resource, string $ability): string
    {
        return $resource . '.' . $ability;
    }

    public static function settingsManage(): string
    {
        return 'settings.manage';
    }

    /**
     * Every permission that exists in the application.
     *
     * @return array<string, string[]> resource => abilities
     */
    public static function list(): array
    {
        return [
            self::RESOURCE_CATEGORIES => ['view_any', 'create', 'update', 'delete'],
            self::RESOURCE_PRODUCTS => ['view_any', 'create', 'update', 'delete'],
            self::RESOURCE_ORDERS => ['view_any', 'update'],
            self::RESOURCE_INVOICES => ['view_any'],
            self::RESOURCE_USERS => ['view_any', 'create', 'update', 'delete'],
            self::RESOURCE_BANNERS => ['view_any', 'create', 'update', 'delete'],
            self::RESOURCE_SLIDERS => ['view_any', 'create', 'update', 'delete'],
            self::RESOURCE_CONTACT_MESSAGES => ['view_any', 'delete'],
            self::RESOURCE_ACTIVITIES => ['view_any'],
            self::RESOURCE_ROLES => ['view_any', 'create', 'update', 'delete'],
            self::RESOURCE_PERMISSIONS => ['view_any'],
        ];
    }

    /**
     * Flat list of all permission keys.
     *
     * @return string[]
     */
    public static function all(): array
    {
        $permissions = [];

        foreach (self::list() as $resource => $abilities) {
            foreach ($abilities as $ability) {
                $permissions[] = self::resource($resource, $ability);
            }
        }

        $permissions[] = self::settingsManage();

        return $permissions;
    }

    /**
     * Role definitions. `super-admin` is granted everything implicitly via
     * Gate::before; the explicit assignment just keeps the table readable.
     *
     * @return array<string, string[]>
     */
    public static function roles(): array
    {
        $restricted = [
            self::RESOURCE_ROLES,
            self::RESOURCE_PERMISSIONS,
            self::RESOURCE_USERS,
        ];

        return [
            'super-admin' => self::all(),
            'admin' => self::all(),
            'manager' => collect(self::list())
                ->reject(fn ($abilities, $resource) => in_array($resource, $restricted, true))
                ->flatMap(fn ($abilities, $resource) => array_map(
                    fn ($ability) => self::resource($resource, $ability),
                    $abilities,
                ))
                ->values()
                ->all(),
        ];
    }
}