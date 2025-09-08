    <?php

    use App\Http\Controllers\ProfileController;
    use App\Http\Controllers\OnboardingController;
    use App\Http\Controllers\ChangelogCategoryController;
    use App\Http\Controllers\ChangelogTagController;
    use App\Http\Controllers\ChangelogController;
    use Illuminate\Support\Facades\Route;
    use Illuminate\Http\Request;

    Route::get('/', function () {
        return redirect()->route('login');
    });
/*    Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware(['auth', 'verified'])->name('dashboard');*/
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    Route::get('/announcement', function () {
        return view('announcement');
    })->name('announcement');
    Route::get('/guide_setup', function () {
        return view('guide_setup');
    })->name('guide_setup');

    // Branding
    Route::get('/guide_setup/themes', function () {
        return view('guide_setup.themes');
    })->name('guide.setup.themes');

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

    Route::get('/add_Changelog', [ChangelogController::class, 'index'])
        ->name('add_changelog');





    require __DIR__.'/auth.php';
