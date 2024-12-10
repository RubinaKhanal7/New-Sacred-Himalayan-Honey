<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Support\Facades\Notification;

use App\Models\About;
use App\Models\Favicon;
use App\Models\Category;
use App\Models\Product;
use App\Models\Sitesetting;
use App\Models\Whyus;
use App\Models\BlogPostsCategory;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Schema;

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
        if (Auth::guard('web')->check()) {
            Notification::observe(VerifyEmail::class);
    }

    
    // Check if Laravel is running in the console
    if (!app()->runningInConsole()) {

        $sitesetting = Sitesetting::first();
        View::share('sitesetting', $sitesetting);

        // Other view composers can be added here in the same way
        View::composer('frontend.includes.navbar', function ($view) {

            $categories = Category::all();
            $blogpostcategories = BlogPostsCategory::all();
            $sitesetting = Sitesetting::first();


            $view->with([
                'categories' => $categories,
                'blogpostcategories' => $blogpostcategories,
                'sitesetting' => $sitesetting
            ]);

        });

        view()->composer('frontend.includes.footer', function ($view) {
            $categories = Category::all();
            $siteSettings = Sitesetting::first();
            $about = About::first();
            $products = Product::all();
            $whyus = Whyus::all();

            $view->with([
                'siteSettings' => $siteSettings,
                'categories' => $categories,
                'about' => $about,
                'products' => $products,
                'whyus' => $whyus,
                'sitesetting' => Sitesetting::first(),
            ]);

        });
    }
}
}
