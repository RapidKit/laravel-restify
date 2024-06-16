<?php

declare(strict_types=1);

namespace RapidKit\LaravelRestify;

use RapidKit\LaravelRestify\Commands\GenerateCommand;
use RapidKit\LaravelRestify\Commands\GenerateControllerCommand;
use RapidKit\LaravelRestify\Commands\GenerateDataCommand;
use RapidKit\LaravelRestify\Commands\GenerateRequestCommand;
use RapidKit\LaravelRestify\Commands\SetupCommand;
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
            ->hasCommand(GenerateRequestCommand::class)
            ->hasCommand(GenerateCommand::class);
    }
}
