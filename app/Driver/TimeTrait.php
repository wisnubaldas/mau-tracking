<?php
namespace App\Driver;
use Carbon\Carbon;

trait TimeTrait {
    public $awal = 0;
    public $akhir = 0;
    public function durasi()
    {
        $seconds = ($this->akhir - $this->awal);
        $hours = floor($seconds / 3600);
        $mins = floor($seconds / 60 % 60);
        $secs = floor($seconds % 60);
        return $hours." Jam, ".$mins." Menit, ".$secs." Detik";

    }
    public function akhir()
    {
        $this->akhir = microtime(true);
        return $this->akhir;
    }
    public function awal()
    {
        $this->awal = microtime(true); 
        return $this->awal;
    }
    public function tambah_jam(string $dt)
    {
        return Carbon::parse($dt);
    }
}