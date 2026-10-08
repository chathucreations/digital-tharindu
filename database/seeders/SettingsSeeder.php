<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingsSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            // General
            'site_name' => 'Digital Store',
            'tagline' => 'Premium digital products, delivered instantly',
            'currency_symbol' => 'Rs.',
            'site_description' => 'Buy premium digital products and subscriptions online with instant delivery.',
            'contact_email' => 'support@digitalstore.test',
            'contact_phone' => '94712345678',
            'whatsapp_number' => '94712345678',
            'contact_address' => '123 Galle Road, Colombo 03, Sri Lanka',

            // Branding / home
            'featured_title' => 'Featured Products',
            'featured_subtitle' => 'Our most popular digital products, handpicked for you.',
            'hero_cta_text' => 'Browse Products',

            // Bank transfer
            'bank_name' => 'Commercial Bank of Ceylon',
            'bank_branch' => 'Colombo 03',
            'bank_account_name' => 'Digital Store (Pvt) Ltd',
            'bank_account_number' => '8001234567',
            'bank_swift' => 'CCEYLKLX',
            'bank_instructions' => "1. Transfer the exact order total to the account above.\n2. Use your Order Number as the payment reference.\n3. Upload your receipt or send it to us on WhatsApp.\n4. We will verify and activate your products within a few hours.",

            // Mail
            'mail_mailer' => 'log',
            'mail_encryption' => 'tls',
            'mail_host' => 'smtp.gmail.com',
            'mail_port' => '587',
            'mail_username' => '',
            'mail_from_address' => 'no-reply@digitalstore.test',
            'mail_from_name' => 'Digital Store',

            // Payment gateway (Marx IPG)
            'marx_enabled' => '1',
            'marx_mode' => 'sandbox',
            'marx_merchant_id' => '',
            'marx_api_key' => '',
            'marx_secret' => '',
            'marx_currency' => 'LKR',
            'marx_endpoint' => 'https://dev.app.marx.lk/api/v2/ipg/orders',
            'marx_valid_time_limit' => '5',

            // Invoice
            'invoice_prefix' => 'INV',

            // SEO / Meta
            'default_meta_description' => 'Buy premium digital products and subscriptions online with instant delivery.',
            'default_meta_keywords' => 'digital products, subscriptions, online store',
            'meta_home_title' => '',
            'meta_home_description' => '',
            'meta_products_title' => 'Products',
            'meta_products_description' => 'Browse our full catalogue of premium digital products.',
            'meta_about_title' => 'About Us',
            'meta_about_description' => '',
            'meta_contact_title' => 'Contact Us',
            'meta_contact_description' => '',

            // Security / reCAPTCHA (Google test keys — always pass, work on localhost)
            'recaptcha_enabled' => '1',
            'recaptcha_site_key' => '6LeIxAcTAAAAAJcZVRqyHh71UMIEGNQ_MXjiZKhI',
            'recaptcha_secret_key' => '6LeIxAcTAAAAAGG-vFI1TnRWxMZNFuojJ4WifJWe',
        ];

        foreach ($settings as $key => $value) {
            Setting::query()->updateOrCreate(
                ['key' => $key],
                ['value' => $value, 'group' => 'general'],
            );
        }
    }
}
