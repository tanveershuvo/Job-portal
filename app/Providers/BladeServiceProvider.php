<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class BladeServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::directive('langis', function ($expression) {
            return "<?php if(session()->get('locale') === $expression){ ?>";
        });

        Blade::directive('elselangis', function () {
            return "<?php }else{ ?>";
        });

        Blade::directive('endlangis', function ($expression) {
            return "<?php } ?>";
        });
    }
}
