<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Domain\WarehouseFactory;
class BreakdownFactoryCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'run:warehouse_factory';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Cek data-data breakdown untuk cron';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        WarehouseFactory::run();
        return 0;
    }
}
