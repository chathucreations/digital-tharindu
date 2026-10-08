<?php

namespace Database\Seeders;

use App\Models\Slider;
use Illuminate\Database\Seeder;

class SliderSeeder extends Seeder
{
    public function run(): void
    {
        $sliders = [
            [
                'title' => 'Unlock Premium Digital Tools',
                'subtitle' => 'Get instant access to the software, subscriptions and services you need — no waiting, no shipping.',
                'button_text' => 'Shop Now',
                'image' => 'https://picsum.photos/seed/digitalstore-hero-1/1600/700',
            ],
            [
                'title' => 'Save More With Annual Plans',
                'subtitle' => 'Switch to yearly billing and enjoy the best value on all your favourite digital products.',
                'button_text' => 'Explore Plans',
                'image' => 'https://picsum.photos/seed/digitalstore-hero-2/1600/700',
            ],
            [
                'title' => 'Delivered Instantly To Your Inbox',
                'subtitle' => 'Automatic delivery, professional invoices and dedicated support — every single time.',
                'button_text' => 'Get Started',
                'image' => 'https://picsum.photos/seed/digitalstore-hero-3/1600/700',
            ],
        ];

        foreach ($sliders as $index => $slider) {
            Slider::query()->updateOrCreate(
                ['title' => $slider['title']],
                array_merge($slider, ['sort_order' => $index, 'is_active' => true]),
            );
        }
    }
}
