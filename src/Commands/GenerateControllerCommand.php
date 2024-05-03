<?php

declare(strict_types=1);

namespace RapidKit\LaravelRestify\Commands;

use Illuminate\Console\GeneratorCommand;

class GenerateControllerCommand extends GeneratorCommand
{
    public $signature = 'restify:gen-controller {name}';

    public $description = 'Generate a new Restify controller.';

    protected function getStub()
    {
        return __DIR__.'/../../stubs/controller.stub';
    }

    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace.'\Http\Controllers\Api';
    }

    protected function replaceClass($stub, $name)
    {
        $class = str_replace($this->getNamespace($name).'\\', '', $name);

        // Do string replacement
        return str_replace('{{ name }}', $class, $stub);
    }
}
