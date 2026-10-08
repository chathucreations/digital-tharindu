<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $user = auth()->user();

        $orders = $user->orders()
            ->with(['items', 'invoice'])
            ->latest()
            ->take(5)
            ->get();

        $stats = [
            'orders' => $user->orders()->count(),
            'completed' => $user->orders()->where('order_status', 'completed')->count(),
            'pending' => $user->orders()->where('payment_status', 'pending')->count(),
            'spent' => (float) $user->orders()->where('payment_status', 'paid')->sum('total_amount'),
        ];

        return view('customer.dashboard', compact('orders', 'stats'));
    }
}
