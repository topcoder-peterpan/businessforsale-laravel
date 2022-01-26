<?php

namespace App\Providers;

use App\Models\Cms;
use App\Models\ModuleSetting;
use App\Models\Theme;
use App\Models\Setting;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider;
use Modules\Category\Entities\Category;
use Modules\Wishlist\Entities\Wishlist;
use Illuminate\Support\Facades\Validator;
use Modules\Category\Transformers\CategoryResource;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if (!app()->runningInConsole()) {
            $moduleSetting = ModuleSetting::first();
            View::share('top_categories', CategoryResource::collection(Category::withCount('ads as ad_count')->latest('ad_count')->take(8)->get()));
            View::share('footer_categories', Category::latest()->take(4)->get());
            View::share('categories', Category::with('subcategories')->get());
            View::share('settings', Setting::first());
            View::share('theme_page', Theme::first()->home_page);
            View::share('blog_enable', $moduleSetting->blog);
            View::share('newsletter_enable', $moduleSetting->newsletter);
            View::share('contact_enable', $moduleSetting->contact);
            View::share('faq_enable', $moduleSetting->faq);
            View::share('testimonial_enable', $moduleSetting->testimonial);
            View::share('priceplan_enable', $moduleSetting->price_plan);
            View::share('language_enable', $moduleSetting->language);
            View::share('appearance_enable', $moduleSetting->appearance);
            View::share('cms', Cms::first());
            Paginator::useBootstrap();

            //Add this custom validation rule.
            Validator::extend('alpha_spaces', function ($attribute, $value) {
                return preg_match('/^[\pL\s]+$/u', $value);
            });
        }
    }
}
