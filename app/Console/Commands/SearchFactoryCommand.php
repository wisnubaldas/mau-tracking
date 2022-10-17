<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Domain\SearchFactory;

class SearchFactoryCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'run:search_factory';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate data search dari table2 tps';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        SearchFactory::run();
        return 0;
    }
}
