<?php

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

// $schedule = app(Schedule::class);
// $schedule->command('sensor:process')->everySecond()->withoutOverlapping()->appendOutputTo(storage_path('logs/scheduler.log'));
// ;
