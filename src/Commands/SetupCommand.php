<?php

declare(strict_types=1);

namespace RamaID\LaravelRestify\Commands;

use Illuminate\Console\Command;

class SetupCommand extends Command
{
    public $signature = 'restify:setup';

    public $description = 'Setup requirements, installing dependencies.';

    public function handle(): int
    {
        $packages = [
            'spatie/enum',
            'spatie/laravel-data',
            'spatie/laravel-query-builder',
            'spatie/laravel-typescript-transformer',
        ];
        $packages = implode(' ', $packages);

        $this->info('Running composer require command...');
        exec('composer require '.$packages.' -W', $output, $returnCode);

        $this->info('Copying transformer config to the path config/typescript-transformer.php');
        copy(__DIR__.'/../../stubs/typescript-transformer.php', config_path('typescript-transformer.php'));

        return self::SUCCESS;
    }
}
