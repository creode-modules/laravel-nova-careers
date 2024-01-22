<?php

namespace Creode\LaravelNovaCareers\Commands;

use Illuminate\Console\Command;

class LaravelNovaCareersCommand extends Command
{
    public $signature = 'laravel-nova-careers';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
