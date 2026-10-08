@extends('layouts.frontend')

@section('content')
    @php
        $menu = [
            ['label' => 'Dashboard', 'route' => 'customer.dashboard', 'icon' => 'sparkles'],
            ['label' => 'My Orders', 'route' => 'customer.orders.index', 'icon' => 'receipt'],
            ['label' => 'My Invoices', 'route' => 'customer.invoices.index', 'icon' => 'download'],
            ['label' => 'My Products', 'route' => 'customer.products', 'icon' => 'bag'],
            ['label' => 'Profile Settings', 'route' => 'profile.edit', 'icon' => 'user'],
        ];
    @endphp

    <div class="mx-auto max-w-7xl px-4 py-10">
        <div class="grid gap-8 lg:grid-cols-[260px_1fr]">
            <aside>
                <div class="rounded-2xl border border-slate-200 bg-white p-4 lg:sticky lg:top-28">
                    <div class="flex items-center gap-3 border-b border-slate-100 px-2 pb-4">
                        @if (auth()->user()->avatar)
                            <img src="{{ auth()->user()->avatar }}" class="h-11 w-11 rounded-full object-cover" alt="">
                        @else
                            <span class="flex h-11 w-11 items-center justify-center rounded-full bg-indigo-600 font-bold text-white">
                                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                            </span>
                        @endif
                        <div class="min-w-0">
                            <div class="truncate font-bold text-slate-900">{{ auth()->user()->name }}</div>
                            <div class="truncate text-xs text-slate-500">{{ auth()->user()->email }}</div>
                        </div>
                    </div>

                    <nav class="mt-3 space-y-1">
                        @foreach ($menu as $item)
                            <a href="{{ route($item['route']) }}"
                               class="flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-semibold transition {{ request()->routeIs($item['route']) ? 'bg-indigo-600 text-white' : 'text-slate-600 hover:bg-slate-100' }}">
                                <x-ui-icon :name="$item['icon']" class="h-5 w-5" />
                                {{ $item['label'] }}
                            </a>
                        @endforeach
                        <a href="{{ route('cart.index') }}" class="flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-semibold text-slate-600 transition hover:bg-slate-100">
                            <x-ui-icon name="cart" class="h-5 w-5" /> Cart
                        </a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="flex w-full items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-semibold text-slate-600 transition hover:bg-rose-50 hover:text-rose-600">
                                <x-ui-icon name="x" class="h-5 w-5" /> Logout
                            </button>
                        </form>
                    </nav>
                </div>
            </aside>

            <section class="min-w-0">
                @yield('customer-content')
            </section>
        </div>
    </div>
@endsection
