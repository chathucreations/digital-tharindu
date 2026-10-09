<?php

namespace App\Filament\Pages;

use App\Support\Settings;
use BackedEnum;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;

/**
 * @property-read Schema $form
 */
class ManageSettings extends Page
{
    protected string $view = 'filament.pages.manage-settings';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedCog6Tooth;

    protected static ?string $navigationLabel = 'Site Settings';

    protected static ?string $title = 'Site Settings';

    protected static ?int $navigationSort = 7;

    /** @var array<string, mixed>|null */
    public ?array $data = [];

    public static function canAccess(): bool
    {
        return auth()->user()?->can('settings.manage') ?? false;
    }

    public function mount(): void
    {
        $settings = Settings::all();
        $settings['mail_password'] = null;
        $settings['marx_secret'] = null;
        $settings['marx_api_key'] = null;
        $settings['recaptcha_secret_key'] = null;

        $this->form->fill($settings);
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Tabs::make('Settings')
                    ->persistTabInQueryString()
                    ->tabs([
                        Tab::make('General')
                            ->icon(Heroicon::OutlinedHome)
                            ->schema([
                                TextInput::make('site_name')->label('Site Name'),
                                TextInput::make('tagline')->label('Tagline'),
                                TextInput::make('currency_symbol')->label('Currency Symbol')->default('Rs.'),
                                Textarea::make('site_description')->label('Meta Description')->rows(2)->columnSpanFull(),
                                TextInput::make('contact_email')->label('Contact Email')->email(),
                                TextInput::make('contact_phone')->label('Contact Phone'),
                                TextInput::make('whatsapp_number')
                                    ->label('WhatsApp Number')
                                    ->helperText('Format: 947XXXXXXXX (used for the floating WhatsApp button).'),
                                Textarea::make('contact_address')->label('Address')->rows(2)->columnSpanFull(),
                            ])
                            ->columns(2),
                        Tab::make('Branding & Home')
                            ->icon(Heroicon::OutlinedPhoto)
                            ->schema([
                                FileUpload::make('logo')
                                    ->image()
                                    ->directory('settings')
                                    ->helperText('Uploaded to the public disk.'),
                                FileUpload::make('favicon')
                                    ->image()
                                    ->directory('settings'),
                                TextInput::make('featured_title')->label('Featured Section Title')->default('Featured Products'),
                                TextInput::make('featured_subtitle')->label('Featured Section Subtitle'),
                                TextInput::make('hero_cta_text')->label('Hero Button Text')->default('Browse Products'),
                            ])
                            ->columns(2),
                        Tab::make('Bank Transfer')
                            ->icon(Heroicon::OutlinedBuildingOffice2)
                            ->schema([
                                TextInput::make('bank_name')->label('Bank Name'),
                                TextInput::make('bank_branch')->label('Branch'),
                                TextInput::make('bank_account_name')->label('Account Name'),
                                TextInput::make('bank_account_number')->label('Account Number'),
                                TextInput::make('bank_swift')->label('SWIFT / Branch Code'),
                                Textarea::make('bank_instructions')
                                    ->label('Payment Instructions')
                                    ->helperText('Shown to customers on the offline checkout page.')
                                    ->rows(4)
                                    ->columnSpanFull(),
                            ])
                            ->columns(2),
                        Tab::make('Payment Gateway')
                            ->icon(Heroicon::OutlinedCreditCard)
                            ->schema([
                                Toggle::make('marx_enabled')
                                    ->label('Enable Online Payment Gateway')
                                    ->helperText('Turn off to only allow bank transfer (offline) payments.')
                                    ->default(true),
                                Select::make('marx_mode')
                                    ->label('Gateway Mode')
                                    ->options([
                                        'sandbox' => 'Sandbox / Test',
                                        'production' => 'Production / Live',
                                    ])
                                    ->default('sandbox')
                                    ->helperText('Sandbox simulates payments when no secret is set.'),
                                TextInput::make('marx_merchant_id')
                                    ->label('Merchant ID')
                                    ->maxLength(255),
                                TextInput::make('marx_api_key')
                                    ->label('API Key')
                                    ->password()
                                    ->revealable()
                                    ->helperText('Leave blank to keep the current API key.'),
                                TextInput::make('marx_secret')
                                    ->label('Merchant Secret')
                                    ->password()
                                    ->revealable()
                                    ->helperText('Leave blank to keep the current secret.'),
                                TextInput::make('marx_currency')
                                    ->label('Currency')
                                    ->default('LKR')
                                    ->maxLength(10),
                                TextInput::make('marx_endpoint')
                                    ->label('API Endpoint')
                                    ->url()
                                    ->default('https://dev.app.marx.lk/api/v2/ipg/orders')
                                    ->helperText('Marx IPG "create order" endpoint URL.')
                                    ->columnSpanFull(),
                                TextInput::make('marx_valid_time_limit')
                                    ->label('Payment Time Limit (hours)')
                                    ->numeric()
                                    ->default(5)
                                    ->minValue(1),
                            ])
                            ->columns(2),
                        Tab::make('Mail (SMTP)')
                            ->icon(Heroicon::OutlinedEnvelope)
                            ->schema([
                                Select::make('mail_mailer')
                                    ->label('Mailer')
                                    ->options(['smtp' => 'SMTP', 'log' => 'Log (development)', 'array' => 'Array'])
                                    ->default('log'),
                                Select::make('mail_encryption')
                                    ->label('Encryption')
                                    ->options(['tls' => 'TLS', 'ssl' => 'SSL', 'none' => 'None'])
                                    ->default('tls'),
                                TextInput::make('mail_host')->label('SMTP Host')->placeholder('smtp.gmail.com'),
                                TextInput::make('mail_port')->label('SMTP Port')->numeric()->placeholder('587'),
                                TextInput::make('mail_username')->label('SMTP Username'),
                                TextInput::make('mail_password')
                                    ->label('SMTP Password')
                                    ->password()
                                    ->revealable()
                                    ->helperText('Leave blank to keep the current password.'),
                                TextInput::make('mail_from_address')->label('From Address')->email(),
                                TextInput::make('mail_from_name')->label('From Name'),
                            ])
                            ->columns(2),
                        Tab::make('Invoices')
                            ->icon(Heroicon::OutlinedDocumentText)
                            ->schema([
                                TextInput::make('invoice_prefix')->label('Invoice Number Prefix')->default('INV'),
                            ]),
                        Tab::make('SEO / Meta')
                            ->icon(Heroicon::OutlinedGlobeAlt)
                            ->schema([
                                FileUpload::make('default_og_image')
                                    ->label('Default social share image')
                                    ->image()
                                    ->directory('seo')
                                    ->columnSpanFull(),
                                Textarea::make('default_meta_description')
                                    ->label('Default meta description')
                                    ->rows(2)
                                    ->helperText('Used when a page has no specific description.')
                                    ->columnSpanFull(),
                                TextInput::make('default_meta_keywords')
                                    ->label('Default meta keywords')
                                    ->helperText('Comma separated.')
                                    ->columnSpanFull(),

                                TextInput::make('meta_home_title')->label('Home — Meta Title')->maxLength(255),
                                TextInput::make('meta_products_title')->label('Products — Meta Title')->maxLength(255),
                                Textarea::make('meta_home_description')->label('Home — Meta Description')->rows(2),
                                Textarea::make('meta_products_description')->label('Products — Meta Description')->rows(2),
                                TextInput::make('meta_about_title')->label('About — Meta Title')->maxLength(255),
                                TextInput::make('meta_contact_title')->label('Contact — Meta Title')->maxLength(255),
                                Textarea::make('meta_about_description')->label('About — Meta Description')->rows(2),
                                Textarea::make('meta_contact_description')->label('Contact — Meta Description')->rows(2),
                            ])
                            ->columns(2),
                        Tab::make('Security')
                            ->icon(Heroicon::OutlinedShieldCheck)
                            ->schema([
                                Toggle::make('recaptcha_enabled')
                                    ->label('Enable Google reCAPTCHA')
                                    ->helperText('Protects the login and register forms from bots. Works on localhost with the default test keys.')
                                    ->default(false),
                                TextInput::make('recaptcha_site_key')
                                    ->label('reCAPTCHA Site Key')
                                    ->maxLength(255)
                                    ->helperText('Get your keys from https://www.google.com/recaptcha/admin (v2 checkbox).'),
                                TextInput::make('recaptcha_secret_key')
                                    ->label('reCAPTCHA Secret Key')
                                    ->password()
                                    ->revealable()
                                    ->helperText('Leave blank to keep the current secret.'),
                            ])
                            ->columns(2),
                    ])
                    ->columnSpanFull(),
            ])
            ->statePath('data');
    }

    public function save(): void
    {
        $data = $this->form->getState();

        if (blank($data['mail_password'] ?? null)) {
            unset($data['mail_password']);
        }

        if (blank($data['marx_secret'] ?? null)) {
            unset($data['marx_secret']);
        }

        if (blank($data['marx_api_key'] ?? null)) {
            unset($data['marx_api_key']);
        }

        if (blank($data['recaptcha_secret_key'] ?? null)) {
            unset($data['recaptcha_secret_key']);
        }

        $data['marx_enabled'] = ! empty($data['marx_enabled']) ? '1' : '0';
        $data['recaptcha_enabled'] = ! empty($data['recaptcha_enabled']) ? '1' : '0';

        Settings::setMany($data);

        activity('settings')
            ->causedBy(auth()->user())
            ->withProperties(['changed' => array_keys($data)])
            ->log('Site settings updated');

        Notification::make()
            ->title('Settings saved')
            ->success()
            ->send();
    }
}
