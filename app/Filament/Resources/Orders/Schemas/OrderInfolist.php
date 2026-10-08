<?php

namespace App\Filament\Resources\Orders\Schemas;

use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class OrderInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Order Information')
                    ->schema([
                        TextEntry::make('order_number'),
                        TextEntry::make('created_at')->label('Placed at')->dateTime(),
                        TextEntry::make('total_amount')
                            ->formatStateUsing(fn ($state) => 'Rs. ' . number_format((float) $state, 2)),
                        TextEntry::make('payment_method')
                            ->badge()
                            ->formatStateUsing(fn ($state) => $state === 'online_gateway' ? 'Online Gateway' : 'Offline / Bank Transfer'),
                        TextEntry::make('payment_status')
                            ->badge()
                            ->color(fn ($state) => match ($state) {
                                'paid' => 'success',
                                'pending' => 'warning',
                                'failed' => 'danger',
                                default => 'gray',
                            }),
                        TextEntry::make('order_status')
                            ->badge()
                            ->color(fn ($state) => match ($state) {
                                'completed' => 'success',
                                'pending' => 'warning',
                                'cancelled' => 'danger',
                                default => 'gray',
                            }),
                        TextEntry::make('gateway_reference')->placeholder('—'),
                        TextEntry::make('paid_at')->dateTime()->placeholder('—'),
                    ])
                    ->columns(3),
                Section::make('Customer')
                    ->schema([
                        TextEntry::make('user.name')->label('Name'),
                        TextEntry::make('user.email')->label('Email'),
                        TextEntry::make('user.phone')->label('Phone')->placeholder('—'),
                    ])
                    ->columns(3),
                Section::make('Offline Payment & Receipt')
                    ->description('The customer uploaded this bank-transfer receipt to confirm payment.')
                    ->visible(fn ($record) => $record->payment_method === 'offline')
                    ->schema([
                        TextEntry::make('offline_note')
                            ->label('Customer note')
                            ->placeholder('No note provided')
                            ->columnSpanFull(),
                        TextEntry::make('offline_receipt')
                            ->label('Payment receipt')
                            ->placeholder('Not uploaded yet')
                            ->formatStateUsing(fn ($state) => $state ? 'Open receipt in new tab' : 'Not uploaded yet')
                            ->url(fn ($record) => $record->offline_receipt
                                ? Storage::disk('public')->url($record->offline_receipt)
                                : null)
                            ->openUrlInNewTab()
                            ->color(fn ($state) => $state ? 'primary' : 'gray'),
                        TextEntry::make('offline_receipt_type')
                            ->label('Type')
                            ->state(fn ($record) => $record->offline_receipt
                                ? strtoupper(pathinfo($record->offline_receipt, PATHINFO_EXTENSION))
                                : '—'),
                        ImageEntry::make('offline_receipt')
                            ->label('Receipt preview')
                            ->disk('public')
                            ->visible(fn ($record) => $record->offline_receipt && Str::endsWith(
                                Str::lower($record->offline_receipt),
                                ['.jpg', '.jpeg', '.png', '.webp', '.gif'],
                            ))
                            ->columnSpanFull(),
                    ])
                    ->columns(2),
            ]);
    }
}
