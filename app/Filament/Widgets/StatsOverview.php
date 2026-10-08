<?php

namespace App\Filament\Widgets;

use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends StatsOverviewWidget
{
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        $revenue = Order::query()->where('payment_status', 'paid')->sum('total_amount');
        $pendingOrders = Order::query()->where('payment_status', 'pending')->count();

        return [
            Stat::make('Revenue', 'Rs. ' . number_format((float) $revenue, 2))
                ->description('Paid orders')
                ->descriptionIcon('heroicon-m-banknotes')
                ->color('success'),
            Stat::make('Orders', (string) Order::query()->count())
                ->description($pendingOrders . ' awaiting payment')
                ->descriptionIcon('heroicon-m-shopping-cart')
                ->color('warning'),
            Stat::make('Products', (string) Product::query()->count())
                ->description(Category::query()->count() . ' categories')
                ->descriptionIcon('heroicon-m-squares-2x2'),
            Stat::make('Customers', (string) User::query()->where('role', 'customer')->count())
                ->description('Registered customers')
                ->descriptionIcon('heroicon-m-users'),
        ];
    }
}
