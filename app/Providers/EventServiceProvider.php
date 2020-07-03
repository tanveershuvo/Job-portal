<?php

namespace App\Providers;

use App\Events\CategoryCacheCreated;
use App\Events\PostCreated;
use App\Events\PostDeleted;
use App\Events\PostUpdated;
use App\Listeners\CategoryCacheListener;
use App\Listeners\PostCacheListener;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        CategoryCacheCreated::class => [
            CategoryCacheListener::class,
        ],
        PostCreated::class => [
            PostCacheListener::class,
        ],
        PostUpdated::class => [
            PostCacheListener::class,
        ],
        PostDeleted::class => [
            PostCacheListener::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
    }
}
