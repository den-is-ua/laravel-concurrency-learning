<?php

namespace App\Console\Commands;

use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Concurrency;

#[Signature('app:concurrency-command')]
#[Description('Command description')]
class ConcurrencyCommand extends Command
{
    /**
     * Execute the console command.
     */
    public function handle()
    {
        Concurrency::run(function () {
            $this->info('Hello, world!');
        });
    }
}
