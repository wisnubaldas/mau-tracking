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

class BreakdownJob implements ShouldQueue
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
        $response = $this->put_data(env('END_POINT').'th-breakdown',$token,['data'=>$this->data]);
        $content = $response->getBody()->getContents();
        // dump($content);
        $this->debug_log(\json_decode($content,true),'api.log');
    }
}
