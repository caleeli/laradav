<?php

namespace Laradav\Foundation;

use Illuminate\Foundation\Application;

trait BelongsToAppTrait
{
    /** @var Application */
    public $app;

    public function BelongsToAppTrait(Application $app)
    {
        $this->app = $app;
    }
}
