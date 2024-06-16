<?php

use function Pest\Laravel\artisan;

it('can setup requirements', function () {
    artisan('restify:setup')->assertExitCode(0);
});

it('can generate data stub', function () {
    artisan('restify:gen-data CategoryData')->assertExitCode(0);
});

it('can generate controller stub', function () {
    artisan('restify:gen-controller CategoryController')->assertExitCode(0);
});

it('can generate request stub', function () {
    artisan('restify:gen-request AuthorStoreRequest')->assertExitCode(0);
});

it('can generate file from stubs', function () {
    artisan('restify:gen Category')->assertExitCode(0);
});
