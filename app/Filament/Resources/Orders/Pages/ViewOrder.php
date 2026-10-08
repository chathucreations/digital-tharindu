<?php

namespace App\Filament\Resources\Orders\Pages;

use App\Filament\Resources\Orders\OrderResource;
use App\Models\Order;
use App\Services\InvoiceService;
use App\Services\OrderFulfillmentService;
use Filament\Actions\Action;
use Filament\Actions\EditAction;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ViewRecord;
use Filament\Support\Icons\Heroicon;
use Illuminate\Support\Facades\Storage;

class ViewOrder extends ViewRecord
{
    protected static string $resource = OrderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('receipt')
                ->label('View Receipt')
                ->icon(Heroicon::OutlinedPaperClip)
                ->color('gray')
                ->visible(fn (): bool => $this->getRecord()->payment_method === 'offline'
                    && filled($this->getRecord()->offline_receipt))
                ->url(fn (): string => Storage::disk('public')->url($this->getRecord()->offline_receipt))
                ->openUrlInNewTab(),
            Action::make('invoice')
                ->label('Download Invoice')
                ->icon(Heroicon::OutlinedDocumentArrowDown)
                ->action(function (): mixed {
                    /** @var Order $order */
                    $order = $this->getRecord();
                    $invoices = app(InvoiceService::class);

                    return $invoices->download($invoices->generateForOrder($order));
                }),
            Action::make('markPaid')
                ->label('Mark as Paid')
                ->icon(Heroicon::OutlinedCheckCircle)
                ->color('success')
                ->requiresConfirmation()
                ->visible(fn (): bool => ! $this->getRecord()->isPaid())
                ->action(function (): void {
                    /** @var Order $order */
                    $order = $this->getRecord();
                    app(OrderFulfillmentService::class)->complete($order, [], 'manual-admin');

                    Notification::make()
                        ->title('Order completed')
                        ->body('Invoice generated and the customer has been notified.')
                        ->success()
                        ->send();

                    $this->refreshFormData(['payment_status', 'order_status', 'paid_at']);
                }),
            EditAction::make(),
        ];
    }
}
