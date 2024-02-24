<?php

declare(strict_types=1);

namespace RamaID\LaravelRestify\Commands;

use Illuminate\Console\GeneratorCommand;

class GenerateDataCommand extends GeneratorCommand
{
    public $signature = 'restify:gen-data {name}';

    public $description = 'Generate a new Restify data object.';

    protected function getStub()
    {
        return __DIR__.'/../../stubs/data.stub';
    }

    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace.'\Data';
    }

    protected function replaceClass($stub, $name)
    {
        $class = str_replace($this->getNamespace($name).'\\', '', $name);

        // Do string replacement
        return str_replace('{{ name }}', $class, $stub);
    }
}
