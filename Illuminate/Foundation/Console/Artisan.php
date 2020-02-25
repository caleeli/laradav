<?php

namespace Illuminate\Foundation\Console;

use Illuminate\Console\Command;

class Artisan extends Command
{
    /**
     * @var Kernel
     */
    private $kernel;

    public function __construct(Kernel $kernel)
    {
        $this->kernel = $kernel;
    }

    public function call(array $parameters = [], $outputBuffer = null)
    {
        $outputBuffer->print("Laradav Framework <em>{$this->kernel->app->version}</em>\n");
        $outputBuffer->print("\n<i>Usage:</i>\n");
        $outputBuffer->print($this->getUsage());
        $outputBuffer->print("\n<i>Available commands:</i>\n");
        $max = 0;
        $all = $this->kernel->all();
        foreach ($all as $cmd) {
            $max = strlen($cmd->getSignature()) > $max ? strlen($cmd->getSignature())  : $max;
        }
        foreach ($all as $cmd) {
            $outputBuffer->print(sprintf("  <em>%{$max}s</em>\t%s\n", $cmd->getSignature(), $cmd->getDescription()));
        }
    }
}
