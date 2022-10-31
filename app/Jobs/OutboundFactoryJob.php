<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Repositories\WarehouseExportOutputPort;

use App\Driver\LoggingRotateTrait;
use App\Driver\TimeTrait;

class OutboundFactoryJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    use LoggingRotateTrait, TimeTrait;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    protected $data;
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(WarehouseExportOutputPort $out)
    {
        $this->awal();
        $out->save_outbound($this->data);
        $this->akhir();
        $this->debug_log(['durasi eksekusi save_outbound '. $this->durasi()],'export.log');
    }
}
