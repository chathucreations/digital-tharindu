<?php

namespace App\Filament\Resources\Orders\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class OrderForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Order')
                    ->schema([
                        TextInput::make('order_number')
                            ->disabled(),
                        TextInput::make('total_amount')
                            ->disabled()
                            ->prefix('Rs.'),
                        TextInput::make('payment_method')
                            ->disabled()
                            ->formatStateUsing(fn ($state) => $state === 'online_gateway' ? 'Online Gateway' : 'Offline / Bank Transfer'),
                        TextInput::make('gateway_reference')
                            ->disabled()
                            ->label('Gateway Reference'),
                    ])
                    ->columns(2),
                Section::make('Status')
                    ->schema([
                        Select::make('payment_status')
                            ->options([
                                'pending' => 'Pending',
                                'paid' => 'Paid',
                                'failed' => 'Failed',
                            ])
                            ->required(),
                        Select::make('order_status')
                            ->options([
                                'pending' => 'Pending',
                                'completed' => 'Completed',
                                'cancelled' => 'Cancelled',
                            ])
                            ->required(),
                        Textarea::make('offline_note')
                            ->rows(2)
                            ->columnSpanFull(),
                    ])
                    ->columns(2),
            ]);
    }
}
