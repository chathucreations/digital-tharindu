<?php

namespace App\Filament\Resources\Invoices\Tables;

use App\Models\Invoice;
use App\Services\InvoiceService;
use Filament\Actions\Action;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class InvoicesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('invoice_number')
                    ->searchable()
                    ->copyable()
                    ->weight('bold'),
                TextColumn::make('order.order_number')
                    ->label('Order')
                    ->searchable(),
                TextColumn::make('order.user.name')
                    ->label('Customer')
                    ->searchable(),
                TextColumn::make('order.total_amount')
                    ->label('Total')
                    ->formatStateUsing(fn ($state) => 'Rs. ' . number_format((float) $state, 2)),
                TextColumn::make('created_at')
                    ->label('Issued')
                    ->dateTime()
                    ->sortable(),
            ])
            ->recordActions([
                Action::make('download')
                    ->label('Download')
                    ->icon(Heroicon::OutlinedArrowDownTray)
                    ->action(function (Invoice $record) {
                        $invoices = app(InvoiceService::class);

                        return $invoices->download($invoices->generateForOrder($record->order));
                    }),
            ])
            ->defaultSort('created_at', 'desc');
    }
}
