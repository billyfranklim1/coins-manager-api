<?php

use Illuminate\Support\Facades\Schedule;
use App\Console\Commands\FetchCryptoData;
use App\Console\Commands\SaveCoinsCommand;


Schedule::command(FetchCryptoData::class)->everyFiveMinutes();
Schedule::command(SaveCoinsCommand::class)->everyMinute();

