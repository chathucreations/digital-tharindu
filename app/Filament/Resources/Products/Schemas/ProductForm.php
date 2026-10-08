<?php

namespace App\Filament\Resources\Products\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ProductForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Product Details')
                    ->schema([
                        Select::make('category_id')
                            ->relationship('category', 'name')
                            ->required()
                            ->searchable()
                            ->preload(),
                        TextInput::make('name')
                            ->required()
                            ->maxLength(255)
                            ->live(onBlur: true),
                        TextInput::make('slug')
                            ->maxLength(255)
                            ->unique(ignoreRecord: true)
                            ->helperText('Leave blank to auto-generate from the name.'),
                        Textarea::make('short_description')
                            ->rows(2)
                            ->columnSpanFull(),
                        RichEditor::make('description')
                            ->columnSpanFull(),
                        FileUpload::make('image')
                            ->image()
                            ->imageEditor()
                            ->directory('products'),
                        TextInput::make('file_path')
                            ->label('Digital file path')
                            ->helperText('Optional path on the public disk, e.g. downloads/product.zip'),
                        Textarea::make('access_details')
                            ->label('Digital access details')
                            ->helperText('Instructions / access details emailed to the customer after payment.')
                            ->rows(3)
                            ->columnSpanFull(),
                    ])
                    ->columns(2),
                Section::make('Visibility')
                    ->schema([
                        Toggle::make('is_digital')
                            ->default(true),
                        Toggle::make('is_active')
                            ->default(true),
                        Toggle::make('is_featured')
                            ->label('Featured on home page'),
                    ])
                    ->columns(3),
                Section::make('SEO / Meta')
                    ->description('Optional — used for search engines and social sharing.')
                    ->collapsed()
                    ->schema([
                        TextInput::make('meta_title')
                            ->label('Meta Title')
                            ->maxLength(255)
                            ->helperText('Leave blank to use the product name.'),
                        TextInput::make('meta_keywords')
                            ->label('Meta Keywords')
                            ->maxLength(255)
                            ->helperText('Comma separated keywords.'),
                        Textarea::make('meta_description')
                            ->label('Meta Description')
                            ->rows(3)
                            ->maxLength(300)
                            ->helperText('Recommended up to 160 characters.')
                            ->columnSpanFull(),
                        FileUpload::make('og_image')
                            ->label('Social share image (OG image)')
                            ->image()
                            ->imageEditor()
                            ->directory('seo'),
                    ])
                    ->columns(2),
                Section::make('Price Variations')
                    ->description('Add monthly and/or yearly billing prices.')
                    ->schema([
                        Repeater::make('variations')
                            ->relationship()
                            ->schema([
                                Select::make('billing_cycle')
                                    ->options([
                                        'monthly' => 'Monthly',
                                        'yearly' => 'Yearly',
                                    ])
                                    ->required()
                                    ->distinct(),
                                TextInput::make('price')
                                    ->numeric()
                                    ->prefix('Rs.')
                                    ->required()
                                    ->minValue(0),
                            ])
                            ->columns(2)
                            ->defaultItems(1)
                            ->addActionLabel('Add billing variation')
                            ->reorderable(false)
                            ->columnSpanFull(),
                    ]),
            ]);
    }
}
