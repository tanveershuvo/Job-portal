<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

use App\Events\CategoryCreated;
use App\Events\CategoryDeleted; 
use App\Events\CategoryUpdated; 

use App\Events\PostCreated;
use App\Events\PostDeleted; 
use App\Events\PostUpdated; 

use App\Listeners\CategoryCacheListener;
use App\Listeners\PostCacheListener;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        CategoryCreated::class => [
            CategoryCacheListener::class,
        ],
        CategoryUpdated::class => [
            CategoryCacheListener::class,
        ],
        CategoryDeleted::class => [
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
