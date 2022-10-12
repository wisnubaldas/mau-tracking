<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Repositories\BreakdownInputPort;
use App\Repositories\BreakdownOutputPort;

class Breakdown extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'run:breakdown';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Jalanin cron breakdown';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $input = new BreakdownInputPort;
        $input->get_breakdown();
        $output = new BreakdownOutputPort;
        $result = $output->save_to_tps($input->data_breakdown);
        return 0;
    }
}
