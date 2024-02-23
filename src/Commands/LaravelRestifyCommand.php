<?php

namespace RamaID\LaravelRestify\Commands;

use Illuminate\Console\Command;

class LaravelRestifyCommand extends Command
{
    public $signature = 'laravel-restify';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
