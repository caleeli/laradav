<?php

namespace Illuminate\Console;

class Command
{
    protected $signature;
    protected $description;
    public $callback;

    public function __construct($signature, $callback = null)
    {
        $this->signature = $signature;
        $this->callback = $callback;
    }

    public function call(array $parameters = [], $outputBuffer = null)
    {
        return $this->callback ? call_user_func($this->callback, $parameters, $outputBuffer) : null;
    }

    public function getUsage()
    {
        return '  ' . ($this->signature ?: 'command') . ' [options] [arguments]';
    }

    /**
     * Get the value of signature
     */
    public function getSignature()
    {
        return $this->signature;
    }

    /**
     * Get the value of description
     */
    public function getDescription()
    {
        return $this->description;
    }

    public function describe($description)
    {
        $this->description = $description;
    }
}
