<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
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
        //
    }
    

    // public $bindings = [
    //     ServerProvider::class => CounterHanler::class,
    // ];
}
