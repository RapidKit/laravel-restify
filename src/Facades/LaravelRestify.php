<?php

namespace RapidKit\LaravelRestify\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \RapidKit\LaravelRestify\LaravelRestify
 */
class LaravelRestify extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \RapidKit\LaravelRestify\LaravelRestify::class;
    }
}
