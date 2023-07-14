<?php

namespace App\Listeners;

use App\Events\ModelDataChanged;
use Illuminate\Support\Facades\Cache;

class ClearModelCache
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
     * @param ModelDataChanged $event
     * @return void
     */
    public function handle(ModelDataChanged $event)
    {
        Cache::tags(class_basename($event->model))->flush();
    }
}
