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
        $x = new SearchFactory;
        $x->get_aircarft_count();
        $x->get_aircarft_data();
        return 0;
    }
}
