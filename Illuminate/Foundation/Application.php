<?php

namespace Illuminate\Foundation;

use ArrayAccess;
use Laradav\Foundation\BaseClass;
use Laradav\Foundation\LoadConfigTrait;
use Laradav\Foundation\SingletonTrait;

class Application extends BaseClass implements ArrayAccess
{
    use SingletonTrait;
    use LoadConfigTrait;

    public $version = '1.0.0';

    public function offsetExists($offset)
    {
        $instance = $this->make($offset);
        return isset($instance);
    }

    public function offsetGet($offset)
    {
        return $this->make($offset);
    }

    public function offsetSet($offset, $value)
    {
    }

    public function offsetUnset($offset)
    {
    }
}
