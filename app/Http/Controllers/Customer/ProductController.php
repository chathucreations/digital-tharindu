<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ProductController extends Controller
{
    public function index(): View
    {
        $items = OrderItem::query()
            ->whereHas('order', function ($query) {
                $query->where('user_id', auth()->id())
                    ->where('order_status', 'completed');
            })
            ->with(['product', 'variation', 'order'])
            ->latest()
            ->get();

        return view('customer.products', compact('items'));
    }

    public function download(OrderItem $item): StreamedResponse
    {
        $order = $item->order;

        abort_unless($order->user_id === auth()->id() && $order->order_status === 'completed', 403);
        abort_unless($item->product && filled($item->product->file_path), 404);
        abort_unless(Storage::disk('public')->exists($item->product->file_path), 404);

        return Storage::disk('public')->download($item->product->file_path);
    }
}
