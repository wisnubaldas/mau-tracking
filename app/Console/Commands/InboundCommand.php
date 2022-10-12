<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Repositories\InboundOutputPort;


class InboundCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'run:inbound';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Jalanin tarikan status tracking untuk inbound via cron tiap 1 menit';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $boot = InboundOutputPort::run();
        $boot->push_into_tracking();
        // return 0;
    }
}
