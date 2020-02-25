<?php

namespace Illuminate\Events;

use Illuminate\Support\ServiceProvider;
use Laradav\Foundation\BelongsToAppTrait;

class EventServiceProvider extends ServiceProvider
{
    use BelongsToAppTrait;

    public function register()
    {
        $this->app->singleton('events', function ($app) {
            return (new Dispatcher($app))->setQueueResolver(function () use ($app) {
                return $app->make(QueueFactoryContract::class);
            });
        });
    }
}
