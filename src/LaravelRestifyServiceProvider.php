<?php

declare(strict_types=1);

namespace RamaID\LaravelRestify;

use RamaID\LaravelRestify\Commands\GenerateCommand;
use RamaID\LaravelRestify\Commands\GenerateControllerCommand;
use RamaID\LaravelRestify\Commands\GenerateDataCommand;
use RamaID\LaravelRestify\Commands\SetupCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class LaravelRestifyServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('laravel-restify')
            ->hasCommand(SetupCommand::class)
            ->hasCommand(GenerateDataCommand::class)
            ->hasCommand(GenerateControllerCommand::class)
            ->hasCommand(GenerateCommand::class);
    }
}
