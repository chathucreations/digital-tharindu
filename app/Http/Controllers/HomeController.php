<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Category;
use App\Models\Product;
use App\Models\Slider;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $sliders = Slider::query()
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->get();

        $banners = Banner::query()
            ->where('is_active', true)
            ->where('position', 'home_after_featured')
            ->orderBy('sort_order')
            ->get();

        $categories = Category::query()
            ->where('is_active', true)
            ->with(['products' => function ($query) {
                $query->where('is_active', true)->with('variations')->latest();
            }])
            ->orderBy('sort_order')
            ->get()
            ->filter(fn (Category $category) => $category->products->isNotEmpty());

        $featured = Product::query()
            ->where('is_active', true)
            ->where('is_featured', true)
            ->with(['variations', 'category'])
            ->latest()
            ->take(8)
            ->get();

        return view('home', compact('sliders', 'categories', 'featured', 'banners'));
    }
}
