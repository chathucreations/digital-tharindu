<?php

namespace Database\Factories;

use App\Models\User;
use App\Support\Permissions;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

/**
 * @extends Factory<User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),
            'role' => 'customer',
        ];
    }

    public function configure(): static
    {
        return $this->afterCreating(function (User $user): void {
            // Make sure every role/permission exists, then map the legacy
            // `role` column onto Spatie roles so tests are deterministic.
            foreach (Permissions::all() as $permission) {
                Permission::findOrCreate($permission, 'web');
            }

            foreach (array_merge(Permissions::roles(), ['customer' => []]) as $name => $permissions) {
                $role = Role::findOrCreate($name, 'web');
                $role->syncPermissions($permissions);
            }

            $user->assignRole($user->role === 'admin' ? 'super-admin' : 'customer');
        });
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
