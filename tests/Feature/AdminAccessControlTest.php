<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminAccessControlTest extends TestCase
{
    use RefreshDatabase;

    public function test_super_admin_can_access_every_admin_area(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);

        foreach ([
            '/digitalsup',
            '/digitalsup/products',
            '/digitalsup/orders',
            '/digitalsup/users',
            '/digitalsup/roles',
            '/digitalsup/permissions',
            '/digitalsup/manage-settings',
            '/digitalsup/activities',
        ] as $url) {
            $this->actingAs($admin)->get($url)->assertOk();
        }
    }

    public function test_manager_is_blocked_from_user_role_and_settings_management(): void
    {
        $manager = User::factory()->create(['role' => 'customer']);
        $manager->assignRole('manager');

        $this->actingAs($manager)->get('/digitalsup/products')->assertOk();
        $this->actingAs($manager)->get('/digitalsup/orders')->assertOk();

        $this->actingAs($manager)->get('/digitalsup/users')->assertForbidden();
        $this->actingAs($manager)->get('/digitalsup/roles')->assertForbidden();
        $this->actingAs($manager)->get('/digitalsup/permissions')->assertForbidden();
        $this->actingAs($manager)->get('/digitalsup/manage-settings')->assertForbidden();
    }

    public function test_plain_customer_cannot_access_admin_panel(): void
    {
        $customer = User::factory()->create(['role' => 'customer']);

        $this->actingAs($customer)->get('/digitalsup')->assertForbidden();
    }
}