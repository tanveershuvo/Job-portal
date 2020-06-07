<?php

namespace App\Listeners;

use App\Category;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Cache;

class CategoryCacheListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        Cache::forget('categoryCache');
        $categories = Category::orderBy('category_name', 'asc')->get();
        Cache::forever('categoryCache',$categories);
    }
}
