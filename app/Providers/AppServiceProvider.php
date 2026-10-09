<?php

namespace App\Providers;

use App\Models\Banner;
use App\Models\Category;
use App\Models\ContactMessage;
use App\Models\Invoice;
use App\Models\Order;
use App\Models\Product;
use App\Models\Slider;
use App\Models\User;
use App\Policies\ActivityPolicy;
use App\Policies\BannerPolicy;
use App\Policies\CategoryPolicy;
use App\Policies\ContactMessagePolicy;
use App\Policies\InvoicePolicy;
use App\Policies\OrderPolicy;
use App\Policies\PermissionPolicy;
use App\Policies\ProductPolicy;
use App\Policies\RolePolicy;
use App\Policies\SliderPolicy;
use App\Policies\UserPolicy;
use App\Support\Permissions;
use App\Support\Settings;
use Illuminate\Auth\Events\Failed;
use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Logout;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;
use Illuminate\Validation\Rules\Password;
use Spatie\Activitylog\Models\Activity;
use Spatie\Permission\Models\Permission as PermissionModel;
use Spatie\Permission\Models\Role;

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
        $this->resolveUrlsToCurrentHost();
        $this->applyDynamicSettings();
        $this->logAuthenticationEvents();
        $this->configureSecurity();
        $this->configureRateLimiting();
        $this->authorizeAdminsByPermissions();
    }

    /**
     * Bind asset / storage URLs to the host the visitor is actually using.
     *
     * Filament renders absolute URLs from `APP_URL` (e.g.
     * http://localhost:8000). When the site is opened on a different host
     * (Laragon vhost, 127.0.0.1, a `.test` domain, ...) those links point at
     * a server that is not listening — the browser fails to load the images
     * and Filament's FileUpload previews get stuck on "Loading / tap to
     * cancel" forever. Resolving against the current request host fixes the
     * uploads everywhere.
     */
    protected function resolveUrlsToCurrentHost(): void
    {
        $host = request()->getHttpHost();

        if (blank($host)) {
            return;
        }

        $root = (request()->isSecure() ? 'https' : 'http') . '://' . $host;

        URL::forceRootUrl($root);
        config(['app.url' => $root]);
        config(['filesystems.disks.public.url' => $root . '/storage']);
    }

    /**
     * Route user authorization through roles & permissions.
     *
     * The `super-admin` role is granted every ability implicitly; everyone
     * else is governed by the model policies (which check the assigned
     * permissions) and by the permission abilities registered below.
     */
    protected function authorizeAdminsByPermissions(): void
    {
        // Explicit registration for models whose policy cannot be
        // auto-discovered (vendor models such as Spatie Role/Permission and
        // the activity log).
        Gate::policy(Product::class, ProductPolicy::class);
        Gate::policy(Category::class, CategoryPolicy::class);
        Gate::policy(Order::class, OrderPolicy::class);
        Gate::policy(Invoice::class, InvoicePolicy::class);
        Gate::policy(User::class, UserPolicy::class);
        Gate::policy(Banner::class, BannerPolicy::class);
        Gate::policy(Slider::class, SliderPolicy::class);
        Gate::policy(ContactMessage::class, ContactMessagePolicy::class);
        Gate::policy(Activity::class, ActivityPolicy::class);
        Gate::policy(Role::class, RolePolicy::class);
        Gate::policy(PermissionModel::class, PermissionPolicy::class);

        Gate::before(function (?User $user, string $ability) {
            return $user?->isSuperAdmin() ? true : null;
        });

        foreach (Permissions::all() as $permission) {
            Gate::define($permission, fn (?User $user) => (bool) $user?->hasPermissionTo($permission));
        }
    }

    /**
     * Production-grade security defaults: force HTTPS, secure cookies and
     * stronger password requirements.
     */
    protected function configureSecurity(): void
    {
        if ($this->app->environment('production')) {
            URL::forceScheme('https');
        }

        Password::defaults(function () {
            $rule = Password::min(8)->letters()->numbers();

            return $this->app->isProduction()
                ? $rule->mixedCase()
                : $rule;
        });
    }

    /**
     * Named rate limiters applied to sensitive public/authenticated routes.
     */
    protected function configureRateLimiting(): void
    {
        RateLimiter::for('contact', fn (Request $request) => Limit::perMinute(5)->by($request->ip()));

        RateLimiter::for('cart', fn (Request $request) => Limit::perMinute(30)
            ->by($request->user()?->id ?: $request->ip()));

        RateLimiter::for('checkout', fn (Request $request) => Limit::perMinute(10)
            ->by($request->user()?->id ?: $request->ip()));

        RateLimiter::for('upload', fn (Request $request) => Limit::perMinute(10)
            ->by($request->user()?->id ?: $request->ip()));

        RateLimiter::for('register', fn (Request $request) => Limit::perHour(5)->by($request->ip()));
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
