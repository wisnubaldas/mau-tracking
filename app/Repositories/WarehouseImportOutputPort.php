<?php
namespace App\Repositories;

use App\Models\Tps\Inbound;
use App\Models\Tps\TdInboundDeliveryAircarft;
use App\Models\Tps\TdInboundBreakdown;

class WarehouseImportOutputPort extends WarehouseEntities{
    
    public function save_to_breakdown($data)
    {
        foreach ($data as $v) {
            $inbound = Inbound::select('id_')->where('waybill_smu',$v['master']);
            foreach ($inbound->get() as $idx) {
                $head = ['id_header'=>$idx->id_];
                    $body = [
                        '_is_active'=>1,
                        '_created_by'=>'MY_APP',
                        'status_date'=>$v['status_date'],
                        'status_time'=>$v['status_time'],
                    ];
                    TdInboundBreakdown::updateOrCreate($head,$body);
                    $this->info_log(['to breakdown status '=>$head],'warehouse.log');
            }
            $inbound->update(['full_check'=>3]);
        }
    }
    public function save_to_aircarft($data)
    {
        foreach ($data as $k => $v) {
            $inbound = Inbound::whereIn('waybill_smu',$v['master']);
                foreach ($inbound->get()->pluck('id_') as $idx) {
                    $head = ['id_header'=>$idx];
                    $body = [
                        '_is_active'=>1,
                        '_created_by'=>'MY_APP',
                        'status_date'=>$v['status_date'],
                        'status_time'=>$v['status_time'],
                    ];
                    TdInboundDeliveryAircarft::updateOrCreate($head,$body);
                    $this->info_log(['to delivery aircarft'=>$head],'warehouse.log');
                }
            $inbound->update(['full_check'=>2]);
        }
    }
    public function save_to_inbound(array $data)
    {
        foreach ($data as $v) {
            $head =  ['waybill_smu'=>$v['waybill_smu'],'hawb'=>$v['hawb']];
            $body = $v;
            unset($body['waybill_smu']);
            unset($body['hawb']);
            Inbound::updateOrCreate($head,$body);
            $this->info_log(['to inbound'=>$head],'warehouse.log');
        }
    }
    
}