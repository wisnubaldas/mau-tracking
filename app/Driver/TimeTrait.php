<?php
namespace App\Driver;
use Carbon\Carbon;

trait TimeTrait {
    public function tambah_jam(string $dt)
    {
        return Carbon::parse($dt);
    }
}