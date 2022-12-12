<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ModelCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:crot';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Kostum command model';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        return Command::SUCCESS;
    }
}
