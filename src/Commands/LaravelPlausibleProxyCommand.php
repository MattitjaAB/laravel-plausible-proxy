<?php

namespace MattitjaAB\LaravelPlausibleProxy\Commands;

use Illuminate\Console\Command;

class LaravelPlausibleProxyCommand extends Command
{
    public $signature = 'laravel-plausible-proxy';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
