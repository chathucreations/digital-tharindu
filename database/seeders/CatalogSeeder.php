<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CatalogSeeder extends Seeder
{
    public function run(): void
    {
        $catalog = [
            [
                'category' => ['name' => 'Software & Tools', 'description' => 'Productivity, business and developer software licences.'],
                'products' => [
                    ['name' => 'Cloud Office Suite', 'price' => [9.99, 99.00], 'featured' => true, 'short' => 'Documents, spreadsheets and slides with real-time collaboration.'],
                    ['name' => 'Antivirus Total Security', 'price' => [6.50, 65.00], 'featured' => false, 'short' => 'Multi-device protection with VPN and password manager.'],
                    ['name' => 'Project Management Pro', 'price' => [12.00, 120.00], 'featured' => true, 'short' => 'Plan, track and deliver projects with your whole team.'],
                ],
            ],
            [
                'category' => ['name' => 'Streaming & Entertainment', 'description' => 'Movies, music and TV subscriptions for every screen.'],
                'products' => [
                    ['name' => 'Movies+ Premium', 'price' => [7.99, 79.00], 'featured' => true, 'short' => 'Unlimited movies and series in 4K across all devices.'],
                    ['name' => 'Music Unlimited', 'price' => [4.99, 49.00], 'featured' => false, 'short' => 'Ad-free music streaming with offline downloads.'],
                    ['name' => 'Live Sports Pass', 'price' => [15.00, 150.00], 'featured' => false, 'short' => 'Stream live sports and highlights all season long.'],
                ],
            ],
            [
                'category' => ['name' => 'Web Hosting & Domains', 'description' => 'Fast, reliable hosting and domain registration.'],
                'products' => [
                    ['name' => 'Business Cloud Hosting', 'price' => [8.00, 80.00], 'featured' => true, 'short' => 'SSD-powered hosting with free SSL and daily backups.'],
                    ['name' => 'Premium Domain Name', 'price' => [12.00, 120.00], 'featured' => false, 'short' => 'Secure your brand with a premium domain registration.'],
                    ['name' => 'Managed WordPress Hosting', 'price' => [14.00, 140.00], 'featured' => false, 'short' => 'Optimised, auto-updating WordPress hosting with staging.'],
                ],
            ],
            [
                'category' => ['name' => 'Learning & Courses', 'description' => 'Learn new skills with expert-led online courses.'],
                'products' => [
                    ['name' => 'Full-Stack Web Development', 'price' => [19.00, 190.00], 'featured' => true, 'short' => 'Master HTML, CSS, JavaScript, PHP and modern frameworks.'],
                    ['name' => 'Digital Marketing Masterclass', 'price' => [15.00, 150.00], 'featured' => false, 'short' => 'SEO, social media and paid ads that actually convert.'],
                    ['name' => 'Graphic Design Fundamentals', 'price' => [13.00, 130.00], 'featured' => false, 'short' => 'Design beautiful branding and graphics from scratch.'],
                ],
            ],
            [
                'category' => ['name' => 'Design & Graphics', 'description' => 'Creative software, templates and asset libraries.'],
                'products' => [
                    ['name' => 'Design Suite Pro', 'price' => [10.00, 100.00], 'featured' => true, 'short' => 'Professional design tools for print, web and social media.'],
                    ['name' => 'Ultimate Stock Assets Bundle', 'price' => [25.00, 250.00], 'featured' => false, 'short' => 'Thousands of photos, icons and illustrations with full licence.'],
                ],
            ],
        ];

        $sort = 0;

        foreach ($catalog as $entry) {
            $category = Category::query()->updateOrCreate(
                ['slug' => Str::slug($entry['category']['name'])],
                [
                    'name' => $entry['category']['name'],
                    'description' => $entry['category']['description'],
                    'image' => 'https://picsum.photos/seed/' . Str::slug($entry['category']['name']) . '/600/400',
                    'is_active' => true,
                    'sort_order' => $sort++,
                ],
            );

            foreach ($entry['products'] as $productData) {
                $slug = Str::slug($productData['name']);

                $product = Product::query()->updateOrCreate(
                    ['slug' => $slug],
                    [
                        'category_id' => $category->id,
                        'name' => $productData['name'],
                        'short_description' => $productData['short'],
                        'description' => $this->description($productData['name'], $productData['short']),
                        'image' => 'https://picsum.photos/seed/' . $slug . '/800/600',
                        'is_digital' => true,
                        'is_active' => true,
                        'is_featured' => $productData['featured'],
                        'access_details' => "Thank you for your purchase!\n\nYour licence key: DS-" . strtoupper(Str::random(4)) . "-" . strtoupper(Str::random(4)) . "-" . strtoupper(Str::random(4)) . "\n\nLogin at https://app.digitalstore.test with this email to manage your subscription.",
                        'file_path' => null,
                    ],
                );

                $product->variations()->updateOrCreate(
                    ['billing_cycle' => 'monthly'],
                    ['price' => $productData['price'][0]],
                );
                $product->variations()->updateOrCreate(
                    ['billing_cycle' => 'yearly'],
                    ['price' => $productData['price'][1]],
                );
            }
        }
    }

    protected function description(string $name, string $short): string
    {
        return <<<HTML
        <p>{$short}</p>
        <p><strong>{$name}</strong> is a fully digital product. As soon as your payment is confirmed you will receive
        instant access details and a professional invoice by email — no waiting and no shipping required.</p>
        <ul>
            <li>Instant digital delivery</li>
            <li>Monthly and yearly plans available</li>
            <li>Secure online payment or bank transfer</li>
            <li>Dedicated customer support</li>
        </ul>
        HTML;
    }
}
