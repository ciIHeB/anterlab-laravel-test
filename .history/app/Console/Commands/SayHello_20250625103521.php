<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class SayHello extends Command
{
    // Command signature with a required argument "name"
    protected $signature = 'say:hello {name}';

    protected $description = 'Say hello to the given name';

    public function handle()
    {
        $name = $this->argument('name');
        $this->info("Hello, {$name}");
        return 0;
    }
}
