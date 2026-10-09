<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::query()->updateOrCreate(
            ['email' => 'admin@digitalstore.test'],
            [
                'name' => 'Super Admin',
                'phone' => '94712345678',
                'role' => 'admin',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
            ],
        );
        $admin->assignRole('super-admin');

        $customer = User::query()->updateOrCreate(
            ['email' => 'customer@digitalstore.test'],
            [
                'name' => 'Demo Customer',
                'phone' => '94771234567',
                'role' => 'customer',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
            ],
        );
        $customer->assignRole('customer');
    }
}
