<?php

namespace Illuminate\Database\Eloquent\Concerns;

use Illuminate\Events\Dispatcher;

trait HasEvents
{
    protected static $dispatcher;

    public static function setEventDispatcher(Dispatcher $dispatcher)
    {
        static::$dispatcher = $dispatcher;
    }
}
