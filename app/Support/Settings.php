<?php

namespace App\Support;

use App\Models\Setting;
use Illuminate\Support\Facades\Cache;

class Settings
{
    /**
     * The cache key used to store all settings.
     */
    protected const CACHE_KEY = 'app.settings';

    /**
     * Retrieve all settings as a key => value array.
     *
     * @return array<string, mixed>
     */
    public static function all(): array
    {
        try {
            return Cache::rememberForever(self::CACHE_KEY, function () {
                return Setting::query()->pluck('value', 'key')->all();
            });
        } catch (\Throwable) {
            return [];
        }
    }

    /**
     * Get a single setting value.
     */
    public static function get(string $key, mixed $default = null): mixed
    {
        $value = self::all()[$key] ?? null;

        return ($value === null || $value === '') ? $default : $value;
    }

    /**
     * Persist a setting value.
     */
    public static function set(string $key, mixed $value, string $group = 'general'): void
    {
        Setting::query()->updateOrCreate(
            ['key' => $key],
            ['value' => is_array($value) ? json_encode($value) : $value, 'group' => $group],
        );

        self::forget();
    }

    /**
     * Set several settings at once.
     *
     * @param  array<string, mixed>  $values
     */
    public static function setMany(array $values, string $group = 'general'): void
    {
        foreach ($values as $key => $value) {
            Setting::query()->updateOrCreate(
                ['key' => $key],
                ['value' => is_array($value) ? json_encode($value) : $value, 'group' => $group],
            );
        }

        self::forget();
    }

    /**
     * Clear the settings cache.
     */
    public static function forget(): void
    {
        Cache::forget(self::CACHE_KEY);
    }
}
