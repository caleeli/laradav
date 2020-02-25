<?php

namespace Laradav\Foundation;

trait CanManageSingletonsTrait
{
    private $singletons = [];
    private $instances = [];

    public function singleton($contract, $class)
    {
        $this->singletons[$contract] = $class;
    }

    public function make($contract)
    {
        $class = $this->singletons[$contract] ?? $contract;
        return $this->instances[$contract] ?? $this->instances[$contract] = is_callable($class) ? call_user_func($class, $this) : new $class($this);
    }

    public function instance($contract, $instance)
    {
        $this->instances[$contract] = $instance;
        return $instance;
    }
}
