<?php
namespace App\Driver;
/**
 * untuk semua counter  
 */
use Illuminate\Support\Facades\Storage;

trait CounterTraits
{
    static public function save_counter($jumlah,$file)
    {
        Storage::disk('local')->put($file, $jumlah);
    }
    static public function get_counter($file)
    {
        $s = Storage::get($file);
        if(!$s){
            Storage::disk('local')->put($file, 0);
            return 0;
        }
        return $s;
    }
    static public function time_format($str)
    {
        try {
            $date = \DateTime::createFromFormat('H:i:s', $str);
            return $date->format('H:i:s');
        } catch (\Throwable $th) {
            return date('H:i:s',strtotime("now"));
            // throw $th;
        }
       
    }

}
