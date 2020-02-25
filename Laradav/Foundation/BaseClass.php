<?php

namespace Laradav\Foundation;

use ReflectionClass;
use ReflectionObject;

class BaseClass
{
    public function __construct(...$arguments)
    {
        $reflection = new ReflectionObject($this);
        foreach ($reflection->getTraits() as $trait) {
            $this->loadTrait($arguments, $trait, $reflection);
        }
    }

    private function loadTrait($arguments, ReflectionClass $trait, ReflectionObject $reflection, array $executed = [])
    {
        $name = $trait->getShortName();
        if (in_array($name, $executed)) {
            return;
        }
        $executed[] = $name;
        foreach ($trait->getTraits() as $trait) {
            $this->loadTrait($arguments, $trait, $reflection, $executed);
        }
        !$reflection->hasMethod($name) ?: $this->$name(...$arguments);
    }
}
