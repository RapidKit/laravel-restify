<?php

namespace RamaID\LaravelRestify\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \RamaID\LaravelRestify\LaravelRestify
 */
class LaravelRestify extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \RamaID\LaravelRestify\LaravelRestify::class;
    }
}
