<?php

use Illuminate\Foundation\Application;

function dump(...$args)
{
    $trace = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS)[1];
    !isset($trace['file']) ?: print($trace['file'] . ':' . $trace['line'] . "\n");
    var_dump(...$args);
}
function dd(...$args)
{
    dump(...$args);
    die;
}
function env($name, $default = null)
{
    return getenv($name) ?: $default;
}
function base_path($path = '')
{
    return Application::getInstance()->getBasePath() . ($path ? DIRECTORY_SEPARATOR . $path : $path);
}
function storage_path($path = '')
{
    return base_path('storage' . ($path ? DIRECTORY_SEPARATOR . $path : $path));
}
function database_path($path = '')
{
    return base_path('database' . ($path ? DIRECTORY_SEPARATOR . $path : $path));
}
function resource_path($path = '')
{
    return base_path('resources' . ($path ? DIRECTORY_SEPARATOR . $path : $path));
}
function app_path($path = '')
{
    return app('path') . ($path ? DIRECTORY_SEPARATOR . $path : $path);
}
function app($abstract = null, array $parameters = [])
{
    $app = Application::getInstance();
    return $abstract ? $app->make($abstract, $parameters) : $app;
}
function config($key = null, $default = null)
{
    $config = app('config');
    return $key ? is_array($key) ? $config->set($key) : $config->get($key, $default) : $config;
}
function class_uses_recursive($class)
{
    if (is_object($class)) {
        $class = get_class($class);
    }

    $results = [];

    foreach (array_reverse(class_parents($class)) + [$class => $class] as $class) {
        $results += trait_uses_recursive($class);
    }

    return array_unique($results);
}
function trait_uses_recursive($trait)
{
    $traits = class_uses($trait);

    foreach ($traits as $trait) {
        $traits += trait_uses_recursive($trait);
    }

    return $traits;
}
