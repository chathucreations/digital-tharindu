<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\View\View;

class PageController extends Controller
{
    public function about(): View
    {
        return view('pages.about', [
            'categories' => Category::query()->where('is_active', true)->orderBy('sort_order')->get(),
        ]);
    }
}
