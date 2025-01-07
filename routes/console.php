<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

//\Illuminate\Support\Facades\Schedule::command('app:notify-users')->everyTenSeconds();
\Illuminate\Support\Facades\Schedule::command('app:notify-users')->weekly()->mondays()->at('10:00');
