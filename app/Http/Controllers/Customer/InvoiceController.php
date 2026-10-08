<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use Illuminate\View\View;

class InvoiceController extends Controller
{
    public function index(): View
    {
        $invoices = Invoice::query()
            ->whereHas('order', fn ($query) => $query->where('user_id', auth()->id()))
            ->with('order')
            ->latest()
            ->paginate(10);

        return view('customer.invoices.index', compact('invoices'));
    }
}
