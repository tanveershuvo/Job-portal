<?php

namespace App\Providers;

use App\Option;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if (config('app.env') === 'production') {
            \URL::forceScheme('https');
        }
        if (Schema::hasTable('options')) {
            $options = Option::all()->pluck('option_value', 'option_key')->toArray();
            Config::set(['options' => $options]);
        }
        try {
            $facebookConfig = [
                'services.facebook' =>
                [
                    'client_id' => get_option('fb_app_id'),
                    'client_secret' => get_option('fb_app_secret'),
                    'redirect' => url('job-seeker-register/facebook/callback'),
                ],
            ];
            $googleConfig = [
                'services.google' =>
                [
                    'client_id' => get_option('google_client_id'),
                    'client_secret' => get_option('google_client_secret'),
                    'redirect' => url('login/google-callback'),
                ],
            ];
            $githubConfig = [
                'services.github' =>
                [
                    'client_id' => get_option('git_app_id'),
                    'client_secret' => get_option('git_app_secret'),
                    'redirect' => url('job-seeker-register/github/callback'),
                ],
            ];

            config($githubConfig);
            config($facebookConfig);

        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->isLocal()) {
            $this->app->register(TelescopeServiceProvider::class);
        }
    }
}
