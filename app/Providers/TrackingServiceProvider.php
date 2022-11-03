<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class TrackingServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        if(DB::connection()->getDatabaseName())
        {
            DB::listen(function ($query){
                $bindings = json_encode($query->bindings);
                Log::build([
                    'driver' => 'single',
                    'path' => storage_path('logs/query.log'),
                  ])->info("$query->sql|$bindings|$query->time");
              });
        }
    }
}
