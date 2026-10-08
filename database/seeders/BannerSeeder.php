<?php

namespace Database\Seeders;

use App\Models\Banner;
use Illuminate\Database\Seeder;

class BannerSeeder extends Seeder
{
    public function run(): void
    {
        Banner::query()->updateOrCreate(
            ['title' => 'Get 20% Off Your First Order'],
            [
                'subtitle' => 'Start with any digital product and enjoy instant delivery plus a professional invoice.',
                'image' => 'https://picsum.photos/seed/digitalstore-banner-1/1920/600',
                'link' => '/products',
                'button_text' => 'Claim Offer',
                'position' => 'home_after_featured',
                'alignment' => 'center',
                'is_active' => true,
                'sort_order' => 0,
            ],
        );
    }
}
