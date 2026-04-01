<?php

namespace App\Console\Commands;

use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Concurrency;
use Illuminate\Support\Facades\Log;

#[Signature('concurrency:defer')]
#[Description('Command description')]
class ConcurrencyDeferCommand extends Command
{
    /**
     * Execute the console command.
     */
    public function handle()
    {
        Concurrency::defer([
            function () {
                sleep(2);
                Log::info('Deferred 1');
            },
            function () {
                sleep(2);
                Log::info('Deferred 2');
            },
            function () {
                sleep(2);
                Log::info('Deferred 3');
            },
        ]);

        $start = $_SERVER['REQUEST_TIME_FLOAT']; // або REQUEST_TIME
        $now = microtime(true);
        $this->info('Timeout: ' . $now - $start);
    }
}
