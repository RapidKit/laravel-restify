<?php

declare(strict_types=1);

namespace RapidKit\LaravelRestify\Commands;

use Illuminate\Console\GeneratorCommand;

class GenerateRequestCommand extends GeneratorCommand
{
    public $signature = 'restify:gen-request {name}';

    public $description = 'Generate a new Restify request class for storing resource.';

    protected function getStub()
    {
        return __DIR__.'/../../stubs/request.stub';
    }

    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace.'\Http\Requests';
    }

    protected function replaceClass($stub, $name)
    {
        $class = str_replace($this->getNamespace($name).'\\', '', $name);

        // Do string replacement
        return str_replace('{{ name }}', $class, $stub);
    }
}
