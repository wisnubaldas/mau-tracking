<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories;
use App\Repositories\WarehouseExportOutputPort;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(WarehouseExportOutputPort::class,function($app){
            return new WarehouseExportOutputPort();
        });
        // $this->app->bind(
        //     Repositories\WarehouseFactoryInterface::class,
        //     Repositories\WarehouseEntities::class,
        // );

        if(env('NUMBER_OF_CONNECTION') !== null && env('NUMBER_OF_CONNECTION') !== '')
        {
            $this->mergeConfigFrom(
                __DIR__.'/../../config/connection.php','database.connections'
            );
        }

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Log::useFiles(storage_path() . '/logs/query.log');
        DB::listen(function ($query){
            $bindings = json_encode($query->bindings);
            Log::info("$query->sql|$bindings|$query->time");
          });
    }
    

    // public $bindings = [
    //     ServerProvider::class => CounterHanler::class,
    // ];
}
