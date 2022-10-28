<?php
namespace App\Repositories;
/**
 * 
 */
trait ExportInputPortTrait
{
    
    public function get_host($model,$limit)
    {
        return $model::limit($limit)
                        ->orderBy('noid','desc')
                        ->get();
    }
    public function get_master_where($model,$master)
    {
        return $model::select(['Origin','Destination'])->where('MasterAWB',$master)->first();
    }
}
