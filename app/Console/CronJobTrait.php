<?php
namespace App\Console;
use App\Driver\LoggingRotateTrait;
use Carbon\Carbon;

trait CronJobTrait {
    use LoggingRotateTrait;
    public function export_factory($schedule)
    {
        $schedule->command('run:exp_factory')->dailyAt('05:00')
            ->onSuccess(function () {
                $this->info_log(['message'=>'cron inbound Export Sukses di eksekusi '],'cron.log');
            })
            ->onFailure(function () {
                $this->error_log(['message'=>'cron inbound Export Error  ','cron.log']);
            });
    }
    public function warehouse_factory($schedule)
    {
        $schedule->command('run:warehouse_factory')->dailyAt('04:00')
            ->before(function () {
                $this->debug_log(['message'=>'cron inbound warehouse_factory jalan '.Carbon::now()->toDateTimeString()],'cron.log');
            })
            ->after(function () {
                $this->debug_log(['message'=>'cron inbound warehouse_factory selesai '.Carbon::now()->toDateTimeString()],'cron.log');
            })
            ->onSuccess(function () {
                $this->info_log(['message'=>'cron inbound warehouse_factory Sukses di eksekusi '.Carbon::now()->toDateTimeString()],'cron.log');
            })
            ->onFailure(function () {
                $this->error_log(['message'=>'cron inbound warehouse_factory Error  '.Carbon::now()->toDateTimeString()],'cron.log');
            });
    }
    public function search_factory($schedule)
    {
        $schedule->command('run:search_factory')->dailyAt('02:00')
            ->before(function () {
                $this->debug_log(['message'=>'cron inbound search_factory jalan '.Carbon::now()->toDateTimeString()],'cron.log');
            })
            ->after(function () {
                $this->debug_log(['message'=>'cron inbound search_factory selesai '.Carbon::now()->toDateTimeString()],'cron.log');
            })
            ->onSuccess(function () {
                $this->info_log(['message'=>'cron inbound search_factory Sukses di eksekusi '.Carbon::now()->toDateTimeString()],'cron.log');
            })
            ->onFailure(function () {
                $this->error_log(['message'=>'cron inbound search_factory Error  '.Carbon::now()->toDateTimeString()],'cron.log');
            });
    }
    public function breakdown($schedule)
    {
        $schedule->command('run:breakdown')->dailyAt('00:00')
        ->before(function () {
            $this->debug_log(['message'=>'cron inbound breakdown jalan '.Carbon::now()->toDateTimeString()],'cron.log');
        })
        ->after(function () {
            $this->debug_log(['message'=>'cron inbound breakdown selesai '.Carbon::now()->toDateTimeString()],'cron.log');
        })
        ->onSuccess(function () {
            $this->info_log(['message'=>'cron inbound breakdown Sukses di eksekusi '.Carbon::now()->toDateTimeString()],'cron.log');
        })
        ->onFailure(function () {
            $this->error_log(['message'=>'cron inbound breakdown Error  '.Carbon::now()->toDateTimeString()],'cron.log');
        });
    }
}