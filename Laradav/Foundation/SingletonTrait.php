<?php

namespace Laradav\Foundation;

trait SingletonTrait
{
    private static $instance;

    protected function SingletonTrait()
    {
        static::$instance = $this;
    }

    public static function getInstance()
    {
        return static::$instance ?: new static();
    }
}
