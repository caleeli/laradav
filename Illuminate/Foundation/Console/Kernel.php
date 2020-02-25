<?php

namespace Illuminate\Foundation\Console;

use Exception;
use Illuminate\Console\Command;
use Illuminate\Contracts\Console\Kernel as IlluminateKernel;
use Illuminate\Foundation\Application;
use Laradav\Foundation\SingletonTrait;
use Laradav\Console\Output;

class Kernel implements IlluminateKernel
{
    use SingletonTrait;

    /**
     * @var Application
     */
    public $app;
    protected $commands = [];
    protected $commandsBuilt = [];
    private $commandsLoaded = false;
    /** @var Output */
    private $output;

    public function __construct(Application $app)
    {
        $this->app = $app;
        foreach ($this->commands as $cmd) {
            $this->commandsBuilt[] = new $cmd($this);
        }
        $this->output = new Output(STDOUT);
    }

    public function handle($input, $output = null)
    {
        $this->output = $output;
        //boot
        $this->bootstrap();
        //call
        array_shift($input);
        $command = array_shift($input);
        $this->call($command, $input, $output);
    }

    /**
     * Run an Artisan console command by name.
     *
     * @param  string  $command
     * @param  array  $parameters
     * @param  \Symfony\Component\Console\Output\OutputInterface|null  $outputBuffer
     * @return int
     */
    public function call($command, array $parameters = [], $outputBuffer = null)
    {
        return $this->buildCommand($command)->call($parameters, $outputBuffer);
    }

    private function buildCommand($signature)
    {
        if (!$signature) {
            return new Artisan($this);
        }
        foreach ($this->all() as $command) {
            if ($command->getSignature() === $signature) {
                return $command;
            }
        }
        throw new Exception("Command '$signature' not found");
    }

    /**
     * Queue an Artisan console command by name.
     *
     * @param  string  $command
     * @param  array  $parameters
     * @return \Illuminate\Foundation\Bus\PendingDispatch
     */
    public function queue($command, array $parameters = [])
    {
    }

    /**
     * Get all of the commands registered with the console.
     *
     * @return array
     */
    public function all()
    {
        return $this->commandsBuilt;
    }

    /**
     * Get the output for the last run command.
     *
     * @return string
     */
    public function output()
    {
    }

    /**
     * Terminate the application.
     *
     * @param  \Symfony\Component\Console\Input\InputInterface  $input
     * @param  int  $status
     * @return void
     */
    public function terminate($input, $status)
    {
    }

    public function bootstrap()
    {
        if (!$this->commandsLoaded) {
            $this->commands();

            $this->commandsLoaded = true;
        }
    }

    public function load($path)
    {
        foreach (glob("$path/*.php") as $file) {
            $class = substr(str_replace([app_path(), '/', '.php'], ['', '\\', ''], $file), 1);
            if (is_subclass_of($class, Command::class)) {
                $this->commandsBuilt[] = new $class;
            }
        }
    }

    public function command($signature, callable $callback)
    {
        $this->commandsBuilt[] = $c = new Command($signature, $callback);
        return $c;
    }

    public function comment($text)
    {
        $this->output->print($text);
        return $this;
    }
}
