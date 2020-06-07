<?php

namespace App\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Post;
use Cache;



class PostCacheListener
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
        Cache::forget('postCache');
        $blog_posts = Post::whereType('post')->with('author')->orderBy('id', 'desc')->take(3)->get();
        Cache::forever('postCache', $blog_posts);
    }
}
