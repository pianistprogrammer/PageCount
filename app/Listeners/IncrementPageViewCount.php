<?php

namespace App\Listeners;

use App\Models\PageView;
use App\Events\PageVisited;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class IncrementPageViewCount
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(PageVisited $event)
    {
        $pageView = PageView::firstOrCreate(['url' => $event->url]);

        if ($event->userId) {
            $pageView->logs()->create(['user_id' => $event->userId]);
        } else {
            $pageView->increment('views_count');
        }
    }
}
