<?php
namespace App\Repositories;
use App\Models\Tps\ThOutbound;

class WarehouseExportOutputPort extends WarehouseEntities{
    public function save_outbound($data)
    {
        foreach ($data as $v) {
            $head = ['waybill_smu'=>$v['waybill_smu'],'hawb'=>$v['hawb']];
            ThOutbound::updateOrCreate($head,$v);
            $this->debug_log(['message'=>'Input th_outbound hawb '.$v['hawb']]);                
        }
    }
}