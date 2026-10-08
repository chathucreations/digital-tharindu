<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Resend, Postmark, AWS, and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'postmark' => [
        'key' => env('POSTMARK_API_KEY'),
    ],

    'resend' => [
        'key' => env('RESEND_API_KEY'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'slack' => [
        'notifications' => [
            'bot_user_oauth_token' => env('SLACK_BOT_USER_OAUTH_TOKEN'),
            'channel' => env('SLACK_BOT_USER_DEFAULT_CHANNEL'),
        ],
    ],

    'google' => [
        'client_id' => env('GOOGLE_CLIENT_ID'),
        'client_secret' => env('GOOGLE_CLIENT_SECRET'),
        'redirect' => env('GOOGLE_REDIRECT_URI', '/auth/google/callback'),
    ],

    /*
    |--------------------------------------------------------------------------
    | Marx Internet Payment Gateway (IPG)
    |--------------------------------------------------------------------------
    |
    | https://marx.lk — API v2 "create order" flow. The merchant secret is
    | sent as the "key" header. When credentials are absent (or mode is set
    | to "sandbox"), a built-in sandbox simulation page is used instead.
    |
    */

    'marx' => [
        'enabled' => env('MARX_IPG_ENABLED', true),
        'merchant_id' => env('MARX_IPG_MERCHANT_ID'),
        'api_key' => env('MARX_IPG_API_KEY'),
        'secret' => env('MARX_IPG_SECRET'),
        'endpoint' => env('MARX_IPG_ENDPOINT', 'https://dev.app.marx.lk/api/v2/ipg/orders'),
        'currency' => env('MARX_IPG_CURRENCY', 'LKR'),
        'mode' => env('MARX_IPG_MODE', 'sandbox'),
        'valid_time_limit' => (int) env('MARX_IPG_VALID_TIME_LIMIT', 5),
    ],

];
