<?php

namespace App\Filament\Resources\Banners\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class BannerForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Banner content')
                    ->schema([
                        TextInput::make('title')
                            ->required()
                            ->maxLength(255)
                            ->columnSpanFull(),
                        TextInput::make('subtitle')
                            ->maxLength(255)
                            ->columnSpanFull(),
                        FileUpload::make('image')
                            ->image()
                            ->imageEditor()
                            ->directory('banners')
                            ->helperText('Recommended wide image (e.g. 1920×600). Leave empty for a gradient background.')
                            ->columnSpanFull(),
                        TextInput::make('link')
                            ->helperText('e.g. /products or a full URL. Leave blank to hide the button.'),
                        TextInput::make('button_text')
                            ->default('Shop Now'),
                    ])
                    ->columns(2),
                Section::make('Placement')
                    ->schema([
                        Select::make('position')
                            ->options([
                                'home_after_featured' => 'Home — below featured products',
                            ])
                            ->default('home_after_featured')
                            ->required(),
                        Select::make('alignment')
                            ->options([
                                'left' => 'Left',
                                'center' => 'Center',
                                'right' => 'Right',
                            ])
                            ->default('center'),
                        Toggle::make('is_active')
                            ->default(true),
                        TextInput::make('sort_order')
                            ->numeric()
                            ->default(0),
                    ])
                    ->columns(2),
            ]);
    }
}
