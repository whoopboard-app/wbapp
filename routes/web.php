    <?php

    use App\Http\Controllers\ProfileController;
    use App\Http\Controllers\OnboardingController;
    use App\Http\Controllers\ChangelogCategoryController;
    use App\Http\Controllers\ChangelogTagController;
    use App\Http\Controllers\GuideSetupController;
    use Illuminate\Support\Facades\Route;
    use Illuminate\Http\Request;
    use App\Http\Controllers\ThemeController;
    use App\Http\Controllers\ChangelogController;
    use App\Http\Controllers\KBArticleController;
    use App\Http\Controllers\KBCategoryController;
    use App\Http\Controllers\KBBoardController;
    use App\Http\Controllers\InviteController;
    use App\Http\Controllers\ComingSoonController;
    use App\Http\Controllers\DashboardController;
    use App\Http\Controllers\AppSettingsController;
    Route::get('/debug', function () {
        return response()->json([
            'host' => request()->getHost(),
            'url' => request()->fullUrl(),
            'message' => 'Laravel is handling this request!'
        ]);
    });

    Route::fallback(function () {
        $path = request()->path();
        $query = request()->getQueryString();

        // Define known routes for self-healing
        $knownRoutes = [
            'announcement',
            'announcementlist',
            'announcement/list',
            'dashboard',
            'login',
            'register',
            'contact',
            'about',
        ];
        $closest = null;
        $shortest = -1;
        foreach ($knownRoutes as $route) {
            $lev = levenshtein($path, $route);
            if ($lev <= strlen($path) / 2 && ($lev < $shortest || $shortest < 0)) {
                $closest = $route;
                $shortest = $lev;
            }
        }
        if ($closest) {
            $url = '/' . $closest . ($query ? '?' . $query : '');
            return redirect($url, 301);
        }
        abort(404);
    });
    Route::middleware(['auth'])->group(function () {
        Route::get('/themes', [ThemeController::class, 'index'])->name('themes.index');
        Route::post('/themes/select', [ThemeController::class, 'selectTheme'])->name('themes.select');
        Route::post('/themes/customize/settings', [ThemeController::class, 'customizeThemeSettings'])->name('themes.customize.settings');
        Route::post('/themes/customize/content', [ThemeController::class, 'customizeContent'])
            ->name('themes.customizeContent');
        Route::post('/themes/customize/seo', [ThemeController::class, 'customizeThemeSeo'])->name('themes.customize.seo');

        Route::post('/themes/customize', [ThemeController::class, 'customize'])->name('themes.customize');
        Route::post('/themes/base-config', [ThemeController::class, 'saveBaseConfig'])
            ->name('themes.base-config');
    });
    Route::get('/', function () {
        return redirect()->route('login');
    });
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->middleware(['auth', 'verified'])
        ->name('dashboard');
/*    Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware(['auth', 'verified'])->name('dashboard');*/
/*    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');*/
    Route::get('/guide_setup', [GuideSetupController::class, 'index'])->name('guide_setup');
    Route::post('/guide_setup/completed', [GuideSetupController::class, 'completed'])->name('guide.setup.completed');

    // Branding
    Route::get('/guide_setup/themes', function () {
        return view('guide_setup.themes');
    })->name('guide.setup.themes');
    Route::post('/themes/update-setting', [ThemeController::class, 'updateSetting'])->name('themes.updateSetting');
    Route::get('/guide_setup/system-config', function () {
        return view('guide_setup.system_config');
    })->name('guide.setup.system_config');

    // Changelog Category Routes
    Route::get('/guide_setup/changelog/category', [ChangelogCategoryController::class, 'index'])
        ->name('guide.setup.changelog.category');

    Route::post('/guide_setup/changelog/category', [ChangelogCategoryController::class, 'store'])
        ->name('categories.store');
    Route::get('/guide_setup/changelog/category/{category}/edit', [ChangelogCategoryController::class, 'edit'])
        ->name('categories.edit');
    Route::put('/guide_setup/changelog/category/{category}', [ChangelogCategoryController::class, 'update'])
        ->name('categories.update');
    Route::delete('/categories/{category}', [ChangelogCategoryController::class, 'destroy'])->name('categories.destroy');
    Route::get('/categories/check-name', [ChangelogCategoryController::class, 'checkName'])->name('categories.checkName');
    //Changelog tags
    Route::get('/guide_setup/changelog/tags', [ChangelogTagController::class, 'index'])
        ->name('guide.setup.changelog.tags');

    Route::post('/guide_setup/changelog/tags', [ChangelogTagController::class, 'store'])
        ->name('tags.store');

    Route::get('/guide_setup/changelog/tags/{tag}/edit', [ChangelogTagController::class, 'edit'])
        ->name('tags.edit');

    Route::put('/guide_setup/changelog/tags/{tag}', [ChangelogTagController::class, 'update'])
        ->name('tags.update');

    Route::delete('/guide_setup/changelog/tags/{tag}', [ChangelogTagController::class, 'destroy'])
        ->name('tags.destroy');
    Route::get('/tags/check-name', [ChangelogTagController::class, 'checkName'])->name('tags.checkName');


    // Knowledge Base
    Route::get('/guide_setup/kb/category', function () {
        return view('guide_setup.kb_category');
    })->name('guide.setup.kb.category');

    Route::get('/guide_setup/kb/tags', function () {
        return view('guide_setup.kb_tags');
    })->name('guide.setup.kb.tags');

    Route::middleware('auth')->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::patch('/profile/change-password', [ProfileController::class, 'changePassword'])
        ->name('profile.changePassword');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });
    Route::get('/onboarding/step1', [OnboardingController::class, 'step1'])->name('onboarding.step1');
    Route::post('/onboarding/step1', [OnboardingController::class, 'storeStep1'])->name('onboarding.storeStep1');

    Route::get('/onboarding/step2', [OnboardingController::class, 'step2'])->name('onboarding.step2');
    Route::post('/onboarding/step2', [OnboardingController::class, 'storeStep2'])->name('onboarding.storeStep2');
    Route::post('/check-domain', [OnboardingController::class, 'checkDomain'])->name('check.domain');

    // Changelog Routes

    Route::prefix('announcement')->group(function () {
        Route::get('create', [ChangelogController::class, 'index'])
        ->name('changelog.create');
        Route::get('/', [ChangelogController::class, 'list'])
        ->name('announcement.list');
        Route::post('store', [ChangelogController::class, 'store'])
        ->name('announcement.store');
        Route::get('filter', [ChangelogController::class, 'filter'])->name('announcement.filter');
        Route::get('{id}', [ChangelogController::class, 'show'])
        ->name('announcement.show');
    });

    Route::prefix('kbarticles')->middleware('auth')->group(function () {
        Route::get('/', [KBArticleController::class, 'index'])->name('kbarticle.index');
        Route::get('create', [KBArticleController::class, 'create'])->name('kbarticle.create');
        Route::post('store', [KBArticleController::class, 'store'])->name('kbarticle.store');
        Route::get('{id}', [KBArticleController::class, 'view'])->name('kbarticle.view');
        Route::post('sort', [KBArticleController::class, 'sort'])->name('kbarticle.sort');
    });

    Route::prefix('kbboards')->middleware('auth')->group(function () {
        Route::get('/', [KBBoardController::class, 'index'])->name('board.index');
        Route::post('store', [KBBoardController::class, 'store'])->name('board.store');
        Route::get('{board}/categories', [KBBoardController::class, 'categories'])->name('board.categories');
        Route::delete('{board}', [KBBoardController::class, 'destroy'])->name('board.destroy');
        Route::put('{board}', [KBBoardController::class, 'update'])->name('board.update');
        Route::get('search', [KBBoardController::class, 'search'])->name('board.search');
    });

    Route::prefix('kbcategories')->middleware('auth')->group(function () {
        Route::post('store', [KBCategoryController::class, 'store'])->name('kbcategory.store');
        Route::get('{category}/articles', [KBCategoryController::class, 'articles'])->name('kbcategory.articles');
    });

    Route::prefix('invite')->group(function () {
        Route::get('create', [InviteController::class, 'create'])
        ->name('invite.create');
        Route::post('store', [InviteController::class, 'store'])
        ->name('invite.store');
        Route::get('accept/{token}', [InviteController::class, 'accept'])
        ->name('invite.accept');
        Route::post('complete', [InviteController::class, 'complete'])
        ->name('invite.complete');
        Route::get('search', [InviteController::class, 'search'])->name('invite.search');
        Route::put('update', [InviteController::class, 'update'])->name('invite.update');
        Route::delete('destroy/{invite}', [InviteController::class, 'destroy'])->name('invite.destroy');
    });
    Route::get('/app-settings', [App\Http\Controllers\AppSettingsController::class, 'index'])
        ->name('app.settings');

    $mainDomain = preg_replace('/^.*?([^.]+\.[^.]+)$/', '$1', request()->getHost());
    // Tenant Public Routes
    Route::domain('{subdomain}.'.$mainDomain)
        ->where(['subdomain' => '^(?!www$)[a-zA-Z0-9-]+$'])
        ->group(function () {
            Route::get('/coming-soon', [ComingSoonController::class, 'show'])->name('coming.soon');
            Route::post('/coming-soon', [ComingSoonController::class, 'checkPassword'])->name('coming.soon.check');
            Route::get('/announcementlist/category/{slug?}', [ComingSoonController::class, 'detailsByCategory'])->name('announcement.category');
            Route::get('/announcementlist/{title}', [ComingSoonController::class, 'detailsByTitle'])->name('announcement.details.title');
            Route::get('/announcementlist', [ComingSoonController::class, 'details'])->name('themes.details');
            Route::fallback(function () {
                abort(404, 'Page not available on tenant site.');
            });
        });



    require __DIR__.'/auth.php';
