<?php

namespace App\Filament\Resources\Orders\Tables;

use App\Models\Order;
use App\Services\InvoiceService;
use App\Services\OrderFulfillmentService;
use Filament\Actions\Action;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Notifications\Notification;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Storage;

class OrdersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('order_number')
                    ->searchable()
                    ->copyable()
                    ->weight('bold'),
                TextColumn::make('user.name')
                    ->label('Customer')
                    ->searchable(),
                TextColumn::make('total_amount')
                    ->label('Total')
                    ->formatStateUsing(fn ($state) => 'Rs. ' . number_format((float) $state, 2))
                    ->sortable(),
                TextColumn::make('payment_method')
                    ->label('Method')
                    ->badge()
                    ->formatStateUsing(fn ($state) => $state === 'online_gateway' ? 'Online' : 'Offline')
                    ->color(fn ($state) => $state === 'online_gateway' ? 'info' : 'gray'),
                TextColumn::make('receipt_status')
                    ->label('Receipt')
                    ->badge()
                    ->state(fn (Order $record) => $record->payment_method !== 'offline'
                        ? '—'
                        : ($record->offline_receipt ? 'Uploaded' : 'Not uploaded'))
                    ->color(fn ($state) => match ($state) {
                        'Uploaded' => 'success',
                        'Not uploaded' => 'warning',
                        default => 'gray',
                    })
                    ->icon(fn ($state) => $state === 'Uploaded' ? Heroicon::OutlinedPaperClip : null),
                TextColumn::make('payment_status')
                    ->badge()
                    ->color(fn ($state) => match ($state) {
                        'paid' => 'success',
                        'pending' => 'warning',
                        'failed' => 'danger',
                        default => 'gray',
                    }),
                TextColumn::make('order_status')
                    ->badge()
                    ->color(fn ($state) => match ($state) {
                        'completed' => 'success',
                        'pending' => 'warning',
                        'cancelled' => 'danger',
                        default => 'gray',
                    }),
                TextColumn::make('created_at')
                    ->label('Placed')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                Filter::make('awaiting_verification')
                    ->label('Awaiting payment verification')
                    ->query(fn (Builder $query) => $query
                        ->where('payment_method', 'offline')
                        ->where('payment_status', 'pending')
                        ->whereNotNull('offline_receipt'))
                    ->toggle(),
                SelectFilter::make('payment_status')
                    ->options(['pending' => 'Pending', 'paid' => 'Paid', 'failed' => 'Failed']),
                SelectFilter::make('order_status')
                    ->options(['pending' => 'Pending', 'completed' => 'Completed', 'cancelled' => 'Cancelled']),
                SelectFilter::make('payment_method')
                    ->options(['online_gateway' => 'Online', 'offline' => 'Offline']),
            ])
            ->recordActions([
                Action::make('receipt')
                    ->label('Receipt')
                    ->icon(Heroicon::OutlinedPaperClip)
                    ->color('gray')
                    ->visible(fn (Order $record) => $record->payment_method === 'offline' && filled($record->offline_receipt))
                    ->url(fn (Order $record) => Storage::disk('public')->url($record->offline_receipt))
                    ->openUrlInNewTab(),
                ViewAction::make(),
                Action::make('invoice')
                    ->label('Invoice')
                    ->icon(Heroicon::OutlinedDocumentArrowDown)
                    ->color('gray')
                    ->action(function (Order $record) {
                        $invoices = app(InvoiceService::class);

                        return $invoices->download($invoices->generateForOrder($record));
                    }),
                Action::make('markPaid')
                    ->label('Mark Paid')
                    ->icon(Heroicon::OutlinedCheckCircle)
                    ->color('success')
                    ->requiresConfirmation()
                    ->modalDescription('This will mark the order as paid & completed, generate the invoice and email the customer.')
                    ->visible(fn (Order $record) => ! $record->isPaid())
                    ->action(function (Order $record): void {
                        app(OrderFulfillmentService::class)->complete($record, [], 'manual-admin');

                        Notification::make()
                            ->title('Order completed')
                            ->body('Invoice generated and the customer has been notified.')
                            ->success()
                            ->send();
                    }),
                EditAction::make(),
            ])
            ->defaultSort('created_at', 'desc');
    }
}
