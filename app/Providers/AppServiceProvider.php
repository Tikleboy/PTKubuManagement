<?php

namespace App\Providers;

use App\Models\CompanyProfile;
use App\Models\ContactSetting;
use App\Models\WebsiteSetting;
use App\Models\ServiceCategory;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
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
        View::composer('*', function ($view) {
            try {
                $company = Schema::hasTable('company_profiles') ? CompanyProfile::first() : null;
                $contact = Schema::hasTable('contact_settings') ? ContactSetting::first() : null;
                $settings = Schema::hasTable('website_settings') ? WebsiteSetting::first() : null;
                $categories = Schema::hasTable('service_categories')
                    ? ServiceCategory::with('services')->where('is_active', true)->orderBy('sort_order')->get()
                    : collect();

                $view->with([
                    'globalCompany' => $company,
                    'globalContact' => $contact,
                    'globalSettings' => $settings,
                    'globalCategories' => $categories,
                ]);
            } catch (\Throwable $e) {
                $view->with([
                    'globalCompany' => null,
                    'globalContact' => null,
                    'globalSettings' => null,
                    'globalCategories' => collect(),
                ]);
            }
        });
    }
}
