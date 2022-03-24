<?php

namespace App\Observers;

use App\Models\Page;
use Carbon\Carbon;

class PageObserver
{
    /**
     * Handle the Page "created" event.
     *
     * @param Page $page
     * @return void
     */
    public function created(Page $page)
    {
        if($page->status === 'PUBLISHED') {
            $page->published_at = Carbon::now();
            $page->saveQuietly();
        }
    }

    /**
     * Handle the Page "updated" event.
     *
     * @param Page $page
     * @return void
     */
    public function updated(Page $page)
    {
        if($page->status === 'PUBLISHED' && $page->published_at === null) {
            $page->published_at = Carbon::now();
            $page->saveQuietly();
        }

        if ($page->status !== 'PUBLISHED') {
            $page->published_at = null;
            $page->saveQuietly();
        }
    }
}
