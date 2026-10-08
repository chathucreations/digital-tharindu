<?php

namespace App\Providers;

use App\Support\Settings;
use Illuminate\Auth\Events\Failed;
use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Logout;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->applyDynamicSettings();
        $this->logAuthenticationEvents();
    }

    /**
     * Record login / logout / failed login attempts in the activity log.
     */
    protected function logAuthenticationEvents(): void
    {
        Event::listen(Login::class, function (Login $event): void {
            activity('auth')
                ->causedBy($event->user)
                ->withProperties(['guard' => $event->guard, 'ip' => request()->ip()])
                ->log('Logged in');
        });

        Event::listen(Logout::class, function (Logout $event): void {
            if ($event->user) {
                activity('auth')
                    ->causedBy($event->user)
                    ->withProperties(['guard' => $event->guard, 'ip' => request()->ip()])
                    ->log('Logged out');
            }
        });

        Event::listen(Failed::class, function (Failed $event): void {
            activity('auth')
                ->withProperties([
                    'guard' => $event->guard,
                    'email' => $event->credentials['email'] ?? null,
                    'ip' => request()->ip(),
                ])
                ->log('Failed login attempt');
        });
    }

    /**
     * Override mail / app configuration with values managed from the admin
     * panel (Site Settings). Wrapped in try/catch so the app still boots
     * before the settings table exists (e.g. during a fresh install).
     */
    protected function applyDynamicSettings(): void
    {
        try {
            $settings = Settings::all();
        } catch (\Throwable) {
            return;
        }

        if (empty($settings)) {
            return;
        }

        if (! empty($settings['site_name'])) {
            config(['app.name' => $settings['site_name']]);
        }

        $mailer = $settings['mail_mailer'] ?? null;

        if ($mailer) {
            config(['mail.default' => $mailer]);
        }

        if (($mailer ?? config('mail.default')) === 'smtp') {
            config([
                'mail.mailers.smtp.host' => $settings['mail_host'] ?? config('mail.mailers.smtp.host'),
                'mail.mailers.smtp.port' => $settings['mail_port'] ?? config('mail.mailers.smtp.port'),
                'mail.mailers.smtp.username' => $settings['mail_username'] ?? config('mail.mailers.smtp.username'),
                'mail.mailers.smtp.password' => $settings['mail_password'] ?? config('mail.mailers.smtp.password'),
                'mail.mailers.smtp.scheme' => $this->smtpScheme($settings['mail_encryption'] ?? null),
            ]);
        }

        if (! empty($settings['mail_from_address'])) {
            config(['mail.from.address' => $settings['mail_from_address']]);
        }

        if (! empty($settings['mail_from_name'])) {
            config(['mail.from.name' => $settings['mail_from_name']]);
        }
    }

    protected function smtpScheme(?string $encryption): ?string
    {
        return match ($encryption) {
            'ssl' => 'smtps',
            'none' => 'smtp',
            default => null,
        };
    }
}
