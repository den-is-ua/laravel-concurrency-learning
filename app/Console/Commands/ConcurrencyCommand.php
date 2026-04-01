<?php

namespace App\Console\Commands;

use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Concurrency;

#[Signature('concurrency')]
#[Description('Command description')]
class ConcurrencyCommand extends Command
{
    /**
     * Execute the console command.
     */
    public function handle()
    {
        $result = Concurrency::run([
            function () {
                sleep(2);
                return 'Hello, world!';
            },
            function () {
                sleep(2);
                return 'Hello, world2!';
            },
            function () {
                sleep(2);
                return 'Hello, world!3';
            },
        ]);

        $this->info('Result: ' . json_encode($result));

        $start = $_SERVER['REQUEST_TIME_FLOAT']; // або REQUEST_TIME
        $now = microtime(true);
        $this->info('Timeout: ' . $now - $start);
    }
}
