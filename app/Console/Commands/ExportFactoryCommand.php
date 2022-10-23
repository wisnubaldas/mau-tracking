<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Domain\ExportFactory;
class ExportFactoryCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'run:exp_factory';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Bikin data tracking untuk export';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        ExportFactory::run();
        return 0;
    }
}
