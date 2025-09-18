<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use App\Models\UserTheme;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;
use Laravel\Pail\PailServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        if ($this->app->environment('local')) {
            $this->app->register(PailServiceProvider::class);
        }
    }

    public function boot(): void
    {
        Schema::defaultStringLength(191);

        // Share labels with all views
        View::composer('*', function ($view) {
            $labels = [];

            if (Auth::check()) {
                $userTheme = UserTheme::where('user_id', Auth::id())->first();
                if ($userTheme && $userTheme->module_labels) {
                    $labels = json_decode($userTheme->module_labels, true);
                }
            }

            $view->with('globalLabels', $labels);
        });
        Blade::directive('customLabel', function ($expression) {
            return "<?php echo \$globalLabels[$expression] ?? ucfirst($expression); ?>";
        });
    }

}
