<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\CareerController;
use App\Http\Controllers\ContactController;

use App\Http\Controllers\Admin\AuthController as AdminAuthController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\CompanyProfileController as AdminCompanyController;
use App\Http\Controllers\Admin\ServiceController as AdminServiceController;
use App\Http\Controllers\Admin\ProjectController as AdminProjectController;
use App\Http\Controllers\Admin\GalleryController as AdminGalleryController;
use App\Http\Controllers\Admin\CareerController as AdminCareerController;
use App\Http\Controllers\Admin\ContactSettingController as AdminContactController;
use App\Http\Controllers\Admin\InquiryController as AdminInquiryController;

/*
|--------------------------------------------------------------------------
| Public Routes - PT. KUBU MANAGEMENT BALI
|--------------------------------------------------------------------------
*/

// Language Switcher
Route::get('/lang/{locale}', function (string $locale) {
    if (in_array($locale, ['id', 'en'])) {
        session(['locale' => $locale]);
    }
    return back();
})->name('lang.switch');

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [AboutController::class, 'index'])->name('about');

// Services Hierarchy
Route::get('/services', [ServiceController::class, 'index'])->name('services.index');
Route::get('/services/landscape', [ServiceController::class, 'landscape'])->name('services.landscape');
Route::get('/services/housekeeping', [ServiceController::class, 'housekeeping'])->name('services.housekeeping');
Route::get('/services/{slug}', [ServiceController::class, 'show'])->name('services.show');

// Projects & Portfolio
Route::get('/projects', [ProjectController::class, 'index'])->name('projects.index');
Route::get('/projects/{slug}', [ProjectController::class, 'show'])->name('projects.show');

// Gallery
Route::get('/gallery', [GalleryController::class, 'index'])->name('gallery.index');

// Career / Loker
Route::get('/career', [CareerController::class, 'index'])->name('career.index');
Route::get('/career/{slug}', [CareerController::class, 'show'])->name('career.show');

// Contact & Inquiries
Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');
Route::post('/contact/send', [ContactController::class, 'send'])->middleware('throttle:6,1')->name('contact.send');

// SEO: robots.txt and sitemap.xml
Route::get('/robots.txt', function () {
    $content = "User-agent: *\nAllow: /\nDisallow: /admin\nSitemap: " . url('/sitemap.xml');
    return response($content, 200)->header('Content-Type', 'text/plain');
});

Route::get('/sitemap.xml', function () {
    $urls = [
        ['loc' => url('/'), 'priority' => '1.0', 'changefreq' => 'weekly'],
        ['loc' => url('/about'), 'priority' => '0.8', 'changefreq' => 'monthly'],
        ['loc' => url('/services'), 'priority' => '0.9', 'changefreq' => 'weekly'],
        ['loc' => url('/services/landscape'), 'priority' => '0.9', 'changefreq' => 'weekly'],
        ['loc' => url('/services/housekeeping'), 'priority' => '0.9', 'changefreq' => 'weekly'],
        ['loc' => url('/projects'), 'priority' => '0.8', 'changefreq' => 'weekly'],
        ['loc' => url('/gallery'), 'priority' => '0.8', 'changefreq' => 'weekly'],
        ['loc' => url('/career'), 'priority' => '0.6', 'changefreq' => 'monthly'],
        ['loc' => url('/contact'), 'priority' => '0.9', 'changefreq' => 'monthly'],
    ];

    $xml = '<?xml version="1.0" encoding="UTF-8"?>';
    $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
    foreach ($urls as $u) {
        $xml .= '<url>';
        $xml .= '<loc>' . htmlspecialchars($u['loc']) . '</loc>';
        $xml .= '<priority>' . $u['priority'] . '</priority>';
        $xml .= '<changefreq>' . $u['changefreq'] . '</changefreq>';
        $xml .= '</url>';
    }
    $xml .= '</urlset>';

    return response($xml, 200)->header('Content-Type', 'application/xml');
});

/*
|--------------------------------------------------------------------------
| Admin CMS Routes (Protected by Auth)
|--------------------------------------------------------------------------
*/

// Standard login route alias (prevents RouteNotFoundException for default auth redirects)
Route::get('/login', [AdminAuthController::class, 'showLogin'])->name('login');

Route::prefix('admin')->name('admin.')->group(function () {
    // Guest Auth
    Route::get('/login', [AdminAuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AdminAuthController::class, 'login'])->middleware('throttle:5,1')->name('login.submit');

    // Authenticated Admin
    Route::middleware('auth')->group(function () {
        Route::post('/logout', [AdminAuthController::class, 'logout'])->name('logout');
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

        // Company Profile & Settings
        Route::get('/company', [AdminCompanyController::class, 'edit'])->name('company.edit');
        Route::put('/company', [AdminCompanyController::class, 'update'])->name('company.update');

        // Services
        Route::resource('services', AdminServiceController::class);

        // Projects
        Route::resource('projects', AdminProjectController::class);

        // Gallery
        Route::get('/gallery', [AdminGalleryController::class, 'index'])->name('gallery.index');
        Route::post('/gallery', [AdminGalleryController::class, 'store'])->name('gallery.store');
        Route::delete('/gallery/{image}', [AdminGalleryController::class, 'destroy'])->name('gallery.destroy');

        // Careers
        Route::resource('careers', AdminCareerController::class);
        Route::post('/careers/{career}/toggle', [AdminCareerController::class, 'togglePublish'])->name('careers.toggle');

        // Contact Settings & WhatsApp
        Route::get('/contact', [AdminContactController::class, 'edit'])->name('contact.edit');
        Route::put('/contact', [AdminContactController::class, 'update'])->name('contact.update');

        // Inquiries
        Route::get('/inquiries', [AdminInquiryController::class, 'index'])->name('inquiries.index');
        Route::get('/inquiries/{inquiry}', [AdminInquiryController::class, 'show'])->name('inquiries.show');
        Route::put('/inquiries/{inquiry}/status', [AdminInquiryController::class, 'updateStatus'])->name('inquiries.status');
        Route::delete('/inquiries/{inquiry}', [AdminInquiryController::class, 'destroy'])->name('inquiries.destroy');
    });
});
