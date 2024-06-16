<?php

declare(strict_types=1);

namespace RapidKit\LaravelRestify\Commands;

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
        $this->info('Generated data object class: '.$filePath);
        Artisan::call('restify:gen-data '.$name.'Data');

        $filePath = $path.'/Http/Controllers/Api/'.$name.'Controller.php';
        $this->info('Generated controller class: '.$filePath);
        Artisan::call('restify:gen-controller '.$name.'Controller');

        $filePath = $path.'/Http/Requests/'.$name.'StoreRequest.php';
        $this->info('Generated store request class: '.$filePath);
        Artisan::call('restify:gen-request '.$name.'StoreRequest');

        $filePath = $path.'/Http/Requests/'.$name.'UpdateRequest.php';
        $this->info('Generated update request class: '.$filePath);
        Artisan::call('restify:gen-request '.$name.'UpdateRequest');

        return self::SUCCESS;
    }
}
