<?php

declare(strict_types=1);

namespace RamaID\LaravelRestify\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class GenerateCommand extends Command
{
    public $signature = 'restify:gen {name}';

    public $description = 'Generate files from stubs.';

    public function handle(): int
    {
        $name = $this->argument('name');

        $path = app_path();

        $filePath = $path.'/Data/'.$name.'Data.php';
        $this->info('Generating data object class: '.$filePath);
        Artisan::call('restify:gen-data '.$name.'Data');

        $filePath = $path.'/Http/Controllers/Api/'.$name.'Controller.php';

        $this->info('Generating controller class: '.$filePath);
        Artisan::call('restify:gen-controller '.$name.'Controller');

        return self::SUCCESS;
    }
}
