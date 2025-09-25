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

    Route::middleware(['auth'])->group(function () {
        Route::get('/themes', [ThemeController::class, 'index'])->name('themes.index');
        Route::post('/themes/select', [ThemeController::class, 'selectTheme'])->name('themes.select');
        Route::post('/themes/customize', [ThemeController::class, 'customize'])->name('themes.customize');
        Route::post('/themes/base-config', [ThemeController::class, 'saveBaseConfig'])
            ->name('themes.base-config');
    });
    Route::get('/', function () {
        return redirect()->route('login');
    });
/*    Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware(['auth', 'verified'])->name('dashboard');*/
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
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
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });
    Route::get('/onboarding/step1', [OnboardingController::class, 'step1'])->name('onboarding.step1');
    Route::post('/onboarding/step1', [OnboardingController::class, 'storeStep1'])->name('onboarding.storeStep1');

    Route::get('/onboarding/step2', [OnboardingController::class, 'step2'])->name('onboarding.step2');
    Route::post('/onboarding/step2', [OnboardingController::class, 'storeStep2'])->name('onboarding.storeStep2');
    Route::post('/check-domain', [OnboardingController::class, 'checkDomain'])->name('check.domain');
    Route::domain('{tenant}.insighthq.test')->group(function () {
        Route::get('/dashboard', function ($tenant) {
            $tenantData = \DB::table('tenants')->where('custom_url', $tenant)->first();

            if (! $tenantData) {
                abort(404, 'Tenant not found.');
            }

            return view('dashboard', compact('tenantData'));
        })->name('tenant.dashboard')->withoutMiddleware(['auth', 'verified']);
    });


    // Changelog Routes

    Route::prefix('announcement')->group(function () {
        Route::get('create', [ChangelogController::class, 'index'])
        ->name('changelog.create');
        Route::get('/', [ChangelogController::class, 'list'])
        ->name('announcement.list');
        Route::post('store', [ChangelogController::class, 'store'])
        ->name('announcement.store');
        Route::get('filter', [ChangelogController::class, 'filter'])->name('announcement.filter');
    });

    Route::prefix('kbarticle')->group(function () {
        Route::get('/', [KBArticleController::class, 'index'])->name('kbarticle.index');
        Route::get('create', [KBArticleController::class, 'create'])->name('kbarticle.create');
        Route::post('store', [KBArticleController::class, 'store'])->name('kbarticle.store');
        Route::post('/store-board', [KBArticleController::class, 'storeBoard'])->name('kbarticle.storeBoard');
        Route::post('/store-boardcategory', [KBArticleController::class, 'storeBoardcategory'])->name('kbarticle.storeBoardcategory');
        Route::get('/boards/{board}/categories', [KBArticleController::class, 'getBoardCategories']);

    });







    require __DIR__.'/auth.php';
