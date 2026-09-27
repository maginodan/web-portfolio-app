<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\URL;
use Illuminate\Http\Request;
use App\Models\SiteSetting;
use App\Models\SeoSetting;
use App\Models\Media;
use App\Models\ChatbotSetting;
use App\Models\ChatbotKnowledge;

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
        if (config('app.env') === 'production') {
            // Force all generated URLs (asset(), route(), url()) to use https
            URL::forceScheme('https');

            // Redirect any stray http:// request to https://
            if (! request()->secure() && ! request()->header('X-Forwarded-Proto') === 'https') {
                redirect()->secure(request()->getRequestUri())->send();
                exit;
            }
        }

        View::composer('*', function ($view) {
            $view->with([
                'siteSetting' => SiteSetting::first(),
                'seo' => SeoSetting::first(),
                'medias' => Media::orderBy('id', 'DESC')->take(3)->get(),
            ]);
        });

        /**
         * Share chatbot widget data (only on the chatbot partial)
         */
        View::composer('layouts.pages.chatbot_widget', function ($view) {

            $settings = ChatbotSetting::first();

            $categories = ChatbotKnowledge::with('category')
                ->where('status', 'active')
                ->get()
                ->pluck('category.name')
                ->unique()
                ->filter()
                ->values()
                ->toArray();

            // Never pass raw provider config (with api_key) to the view — @json()-ing
            // that leaks keys into every page's HTML source. Only expose whether a
            // provider is available.
            $providers = config('ai.providers');
            $hasEnabledProvider = collect($providers)
                ->contains(fn ($p) => !empty($p['enabled']) && !empty($p['api_key']));

            $view->with(compact('settings', 'categories', 'hasEnabledProvider'));

        });
    }
}