<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\URL;
use App\Models\UserTheme;
use App\Models\Tenant;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        if (config('app.env') === 'production') {
            URL::forceScheme('https');
        }
        if (Auth::check() && Auth::user()->tenant) {
        }

        Schema::defaultStringLength(191);

        // Share labels with all views
        View::composer('*', function ($view) {
            $labels = [];

            if (Auth::check()) {
                $tenantId = Auth::user()->tenant_id;
                $userTheme = UserTheme::where('tenant_id', $tenantId)->first();
                if ($userTheme && $userTheme->module_labels) {
                    $labels = json_decode($userTheme->module_labels, true);
                }
            }

            $view->with('globalLabels', $labels);
        });
        Blade::directive('customLabel', function ($expression) {
            return "<?php echo \$globalLabels[$expression] ?? ucfirst($expression); ?>";
        });

        Blade::if('isSuperAdmin', fn() => auth()->check() && (int) auth()->user()->user_type === 1);
    
        View::composer('*', function ($view) {
            $host = request()->getHost();
            $parts = explode('.', $host);
            $subdomain = count($parts) >= 3 ? $parts[0] : null;

            $tenant = null;

            if ($subdomain) {
                $tenant = Tenant::where('custom_url', $subdomain)->first();
            }

            if (!$tenant) {
                $tenant = Tenant::where('page_publish', 1)->first();
            }

            $view->with('tenant', $tenant);
        });
    }

}
