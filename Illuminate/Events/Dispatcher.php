<?php

namespace Illuminate\Events;

use Laradav\Foundation\BaseClass;

class Dispatcher extends BaseClass
{
    private $queueResolver;

    public function setQueueResolver(callable $queueResolver)
    {
        $this->queueResolver = $queueResolver;
        return $this;
    }
}
