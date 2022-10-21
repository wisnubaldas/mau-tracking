<?php
namespace App\Repositories;
use App\Driver\CounterTraits;
use App\Driver\LoggingRotateTrait;
class WarehouseEntities implements WarehouseFactoryInterface {
    use CounterTraits, LoggingRotateTrait;

    public $c_file;

    public function count_data($model)
    {
         $jml_breakdown = $model::count();
         if($jml_breakdown > $this->get_counter($this->c_file)){
            $limit = ($jml_breakdown - $this->get_counter($this->c_file));
            $this->save_counter($jml_breakdown,$this->c_file);
            return $limit;
         }else{
            $this->debug_log(['message'=>'Tidak ada data yg di proses...']);
            return 0;
         }
    }
    public function get_host($model,$master)
    {
        return $model::where('MasterAWB',$master)->get();
    }
    public function get_master($model,$limit = null)
    {
        if($limit){
            return $model::limit($limit)
                        ->orderBy('created_at','desc')
                        ->get();
        }
    }
    public function get_breakdown($model,$limit)
    {
        return $model::with('detail')
                        ->limit($limit)
                        ->orderBy('noid','desc')
                        ->get();
    }
    public function get_breakdown_detail($model,$limit)
    {
        return $model::limit($limit)
                        ->orderBy('noid','desc')
                        ->get();
    }
    public function get_breakdown_detail_storage()
    {
        # code...
    }
    public function get_deliorder()
    {
        # code...
    }
    public function get_pod()
    {
        # code...
    }
}