<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();


Artisan::command('log', function () {
    Log::info("hello I am logging from scheduler");
})->purpose('logs message')->everyMinute();

Artisan::command('auth:clear-resets', function () {
    Log::info("The token has expired");
})->purpose('Token deleting')->hourly();

