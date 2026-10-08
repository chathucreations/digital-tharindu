<?php

namespace App\Filament\Resources\Sliders\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class SliderForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->required()
                    ->maxLength(255),
                TextInput::make('subtitle')
                    ->maxLength(255),
                FileUpload::make('image')
                    ->image()
                    ->imageEditor()
                    ->directory('sliders')
                    ->required()
                    ->columnSpanFull(),
                TextInput::make('link')
                    ->helperText('e.g. /products or a full URL.'),
                TextInput::make('button_text')
                    ->default('Shop Now'),
                TextInput::make('sort_order')
                    ->numeric()
                    ->default(0),
                Toggle::make('is_active')
                    ->default(true),
            ])
            ->columns(2);
    }
}
