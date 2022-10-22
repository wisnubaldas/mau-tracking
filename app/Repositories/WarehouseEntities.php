<?php
namespace App\Repositories;
use App\Driver\CounterTraits;
use App\Driver\LoggingRotateTrait;
use App\Driver\TimeTrait;
class WarehouseEntities implements WarehouseFactoryInterface {
    use CounterTraits, LoggingRotateTrait, TimeTrait;

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
    
    public function get_deliorder($model,$limit)
    {
        return $model::select(['MasterAWB','DateOfDeliveryOrder','TimeOfDeliveryOrder'])
                        ->limit($limit)
                        ->orderBy('noid','desc')
                        ->get();
    }
    public function get_pod($model,$limit)
    {
        return $model::select(['DateOfOut','TimeOfOut','InvoiceNumber'])
                        ->limit($limit)
                        ->orderBy('noid','desc')
                        ->get();
    }
    public function get_pod_detail($model,$inv_number)
    {
        $mawb = $model::select(['HostAWB'])->where('InvoiceNumber',$inv_number)->first();
        if($mawb){
            return $mawb->HostAWB;
        }else{
            $this->error_log(['message'=>'Error ngga ada master inv '.$inv_number],'warehouse.log');
        }
    }
}