<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function index(Request $request): View
    {
        $categories = Category::query()
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->get();

        $query = Product::query()
            ->where('is_active', true)
            ->with(['variations', 'category']);

        $selected = null;

        if ($request->filled('category')) {
            $selected = Category::query()->where('slug', $request->string('category'))->first();

            if ($selected) {
                $query->where('category_id', $selected->id);
            }
        }

        if ($request->filled('q')) {
            $query->where('name', 'like', '%' . $request->string('q') . '%');
        }

        $products = $query->latest()->paginate(12)->withQueryString();

        return view('products.index', compact('categories', 'products', 'selected'));
    }

    public function show(Product $product): View
    {
        abort_unless($product->is_active, 404);

        $product->load(['variations', 'category']);

        $related = Product::query()
            ->where('is_active', true)
            ->where('category_id', $product->category_id)
            ->whereKeyNot($product->getKey())
            ->with('variations')
            ->take(4)
            ->get();

        return view('products.show', compact('product', 'related'));
    }
}
