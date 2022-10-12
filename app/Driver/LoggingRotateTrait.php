<?php
namespace App\Driver;

use Illuminate\Support\Facades\Log;

trait LoggingRotateTrait {
    public function inbound_to_tracking_log($data)
    {
        Log::build([
            'driver' => 'single',
            'path' => storage_path('logs/inbound_tracking.log'),
          ])->info(\json_encode($data));
    }

    public function warehouse_log(array $data,$file_name = 'warehouse.log')
    {
        Log::build([
            'driver' => 'single',
            'path' => storage_path('logs/'.$file_name),
          ])->info(\json_encode($data));
    }
}