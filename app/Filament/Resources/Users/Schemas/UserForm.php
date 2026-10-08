<?php

namespace App\Filament\Resources\Users\Schemas;

use App\Rules\SriLankanPhone;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Hash;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                TextInput::make('email')
                    ->email()
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->maxLength(255),
                TextInput::make('phone')
                    ->tel()
                    ->rule(new SriLankanPhone())
                    ->helperText('Format: 947XXXXXXXX (e.g. 94712345678)'),
                Select::make('role')
                    ->options([
                        'customer' => 'Customer',
                        'admin' => 'Super Admin',
                    ])
                    ->default('customer')
                    ->required(),
                TextInput::make('password')
                    ->password()
                    ->revealable()
                    ->dehydrateStateUsing(fn ($state) => filled($state) ? Hash::make($state) : null)
                    ->dehydrated(fn ($state) => filled($state))
                    ->required(fn (string $operation) => $operation === 'create')
                    ->maxLength(255),
            ])
            ->columns(2);
    }
}
