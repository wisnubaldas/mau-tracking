<?php
namespace App\Driver;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log; 

class CounterHandler {
    public $file;
    public $content;
    public function __construct($file) {
        $this->file = $file;
    }
    public function save($jumlah)
    {
        Storage::disk('local')->put($this->file, $jumlah);

    }
    public function get() : int
    {
        return Storage::get($this->file);
    }
    public function time_format($str)
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