<?php

namespace Laradav\Foundation;

use Illuminate\Contracts\Config\Repository;

class ConfigRepository extends BaseClass implements Repository
{
    use BelongsToAppTrait;

    private $config = [];

    public function __construct(...$args)
    {
        parent::__construct(...$args);
        foreach (glob($this->app->getBasePath() . '/config/*.php') as $file) {
            $this->config[basename($file, '.php')] = include $file;
        }
    }

    public function get($name, $default = null)
    {
        $loc = $this->config;
        foreach (explode('.', $name) as $step) {
            if (!isset($loc[$step])) {
                return $default;
            }
            $loc = $loc[$step];
        }
        return $loc;
    }

    public function set($key, $value = null)
    {
        is_array($key) ? list($name, $value) = $key : $name = $key;
        $loc = &$this->config;
        foreach (explode('.', $name) as $step) {
            $loc = &$loc[$step];
        }
        $loc = $value;
    }
}
