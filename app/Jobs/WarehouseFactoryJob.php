<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Crypt;
use App\Driver\ClientRequest;
use App\Driver\LoggingRotateTrait;
class WarehouseFactoryJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, ClientRequest, LoggingRotateTrait;

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
    public function handle()
    {
        $token = Crypt::encrypt(env('TOKEN_API'));
        $response = $this->put_data(env('END_POINT').'th-inbound',$token,$this->data);
        $this->debug_log([$response->getBody()->getContents()],'api.log');
    }
}
