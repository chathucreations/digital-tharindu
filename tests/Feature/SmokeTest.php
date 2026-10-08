<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class SmokeTest extends TestCase
{
    use RefreshDatabase;

    protected function createCatalog(): Product
    {
        $category = Category::create([
            'name' => 'Software',
            'slug' => 'software',
            'is_active' => true,
        ]);

        $product = Product::create([
            'category_id' => $category->id,
            'name' => 'Cloud Office Suite',
            'slug' => 'cloud-office-suite',
            'short_description' => 'A great product',
            'description' => '<p>Details</p>',
            'is_active' => true,
            'is_digital' => true,
        ]);

        $product->variations()->create(['billing_cycle' => 'monthly', 'price' => 9.99]);
        $product->variations()->create(['billing_cycle' => 'yearly', 'price' => 99.00]);

        return $product;
    }

    public function test_public_pages_render(): void
    {
        $product = $this->createCatalog();

        $this->get('/')->assertOk();
        $this->get('/products')->assertOk();
        $this->get('/products/' . $product->slug)->assertOk();
        $this->get('/about')->assertOk();
        $this->get('/contact')->assertOk();
        $this->get('/login')->assertOk();
        $this->get('/register')->assertOk();
    }

    public function test_customer_area_renders_for_authenticated_user(): void
    {
        $user = User::factory()->create(['role' => 'customer']);

        $this->actingAs($user)->get('/customer')->assertOk();
        $this->actingAs($user)->get('/customer/orders')->assertOk();
        $this->actingAs($user)->get('/customer/invoices')->assertOk();
        $this->actingAs($user)->get('/customer/products')->assertOk();
        $this->actingAs($user)->get('/profile')->assertOk();
        $this->actingAs($user)->get('/cart')->assertOk();
        $this->actingAs($user)->get('/checkout')->assertRedirect('/products');
    }

    public function test_admin_panel_pages_render(): void
    {
        $this->createCatalog();

        $admin = User::factory()->create(['role' => 'admin']);

        foreach ([
            '/digitalsup',
            '/digitalsup/categories',
            '/digitalsup/categories/create',
            '/digitalsup/products',
            '/digitalsup/products/create',
            '/digitalsup/orders',
            '/digitalsup/invoices',
            '/digitalsup/sliders',
            '/digitalsup/sliders/create',
            '/digitalsup/contact-messages',
            '/digitalsup/users',
            '/digitalsup/manage-settings',
            '/digitalsup/activities',
        ] as $url) {
            $this->actingAs($admin)->get($url)->assertOk();
        }
    }

    public function test_customer_cannot_access_admin_panel(): void
    {
        $user = User::factory()->create(['role' => 'customer']);

        $this->actingAs($user)->get('/digitalsup')->assertForbidden();
    }

    public function test_admin_can_create_product_with_variations(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $category = Category::create(['name' => 'Software', 'slug' => 'software', 'is_active' => true]);

        \Livewire\Livewire::actingAs($admin)
            ->test(\App\Filament\Resources\Products\Pages\CreateProduct::class)
            ->fillForm([
                'category_id' => $category->id,
                'name' => 'Brand New Product',
                'is_digital' => true,
                'is_active' => true,
                'variations' => [
                    ['billing_cycle' => 'monthly', 'price' => 10],
                    ['billing_cycle' => 'yearly', 'price' => 100],
                ],
            ])
            ->call('create')
            ->assertHasNoFormErrors();

        $this->assertDatabaseHas('products', ['name' => 'Brand New Product']);
        $this->assertDatabaseHas('product_variations', ['billing_cycle' => 'monthly', 'price' => 10]);
        $this->assertDatabaseHas('product_variations', ['billing_cycle' => 'yearly', 'price' => 100]);
    }

    public function test_customer_can_upload_payment_proof_for_offline_order(): void
    {
        Storage::fake('public');

        $user = User::factory()->create(['role' => 'customer']);
        $product = $this->createCatalog();

        $order = Order::create([
            'order_number' => 'ORD-TEST-0001',
            'user_id' => $user->id,
            'total_amount' => 9.99,
            'payment_method' => 'offline',
            'payment_status' => 'pending',
            'order_status' => 'pending',
        ]);
        $order->items()->create([
            'product_id' => $product->id,
            'product_name' => $product->name,
            'billing_cycle' => 'monthly',
            'price' => 9.99,
        ]);

        $this->actingAs($user)
            ->post(route('customer.orders.proof', $order), [
                'offline_receipt' => UploadedFile::fake()->create('receipt.pdf', 100, 'application/pdf'),
                'offline_note' => 'Paid via online banking, ref 12345',
            ])
            ->assertRedirect();

        $order->refresh();

        $this->assertNotNull($order->offline_receipt);
        Storage::disk('public')->assertExists($order->offline_receipt);
        $this->assertSame('Paid via online banking, ref 12345', $order->offline_note);
        $this->assertDatabaseHas('activity_log', ['description' => 'Payment receipt uploaded']);
    }

    public function test_activity_log_records_order_placement(): void
    {
        $customer = User::factory()->create(['role' => 'customer']);
        $product = $this->createCatalog();

        $order = Order::create([
            'order_number' => 'ORD-ACT-1',
            'user_id' => $customer->id,
            'total_amount' => 9.99,
            'payment_method' => 'offline',
            'payment_status' => 'pending',
            'order_status' => 'pending',
        ]);
        $order->items()->create([
            'product_id' => $product->id,
            'product_name' => $product->name,
            'price' => 9.99,
        ]);

        $this->assertDatabaseHas('activity_log', ['description' => 'Order placed']);
        $this->assertDatabaseHas('activity_log', ['description' => 'User registered']);
    }

    public function test_buy_now_adds_to_cart_and_redirects_to_checkout(): void
    {
        $product = $this->createCatalog();
        $user = User::factory()->create(['role' => 'customer']);

        $this->actingAs($user)
            ->post(route('cart.buy'), [
                'product_id' => $product->id,
                'variation_id' => $product->variations()->first()->id,
            ])
            ->assertRedirect(route('checkout.index'));
    }

    public function test_google_redirect_without_credentials_returns_to_login(): void
    {
        config([
            'services.google.client_id' => null,
            'services.google.client_secret' => null,
        ]);

        $this->get(route('auth.google'))->assertRedirect(route('login'));
    }

    public function test_admin_can_view_offline_order_with_receipt(): void
    {
        Storage::fake('public');

        $admin = User::factory()->create(['role' => 'admin']);
        $customer = User::factory()->create(['role' => 'customer']);
        $product = $this->createCatalog();

        $order = Order::create([
            'order_number' => 'ORD-OFFLINE-1',
            'user_id' => $customer->id,
            'total_amount' => 9.99,
            'payment_method' => 'offline',
            'payment_status' => 'pending',
            'order_status' => 'pending',
            'offline_receipt' => UploadedFile::fake()->image('receipt.jpg')->store('receipts', 'public'),
            'offline_note' => 'Bank ref 999',
        ]);
        $order->items()->create([
            'product_id' => $product->id,
            'product_name' => $product->name,
            'billing_cycle' => 'monthly',
            'price' => 9.99,
        ]);

        $this->actingAs($admin)->get('/digitalsup/orders')->assertOk();
        $this->actingAs($admin)->get('/digitalsup/orders/' . $order->id)->assertOk();
    }
}
