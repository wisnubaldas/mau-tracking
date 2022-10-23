<?php
namespace App\Repositories;

use App\Models\Tps\Inbound;
use App\Models\Tps\TdInboundDeliveryAircarft;
use App\Models\Tps\TdInboundBreakdown;
use App\Models\Tps\TdInboundStorage;
use App\Models\Tps\TdInboundClearance;
use App\Models\Tps\TdInboundPod;

class WarehouseImportOutputPort extends WarehouseEntities{
    public function save_to_pod($data)
    {
        foreach ($data as $v) {
            $inbound = new Inbound;
            $s = $inbound->select('id_')->where('hawb',$v['hawb'])->first();
            if($s){
                $head = ['id_header'=>$s->id_];
                $body = [
                    '_is_active'=>1,
                    '_created_by'=>'MY_APP',
                    'status_date'=>$v['status_date'],
                    'status_time'=>$v['status_time'],
                ];
                TdInboundPod::updateOrCreate($head,$body);
                $this->info_log(['to pod status '=>$head],'warehouse.log');
                $updt = $inbound->where('hawb',$v['hawb'])->update(['full_check'=>6]);
                if($updt){
                    $this->info_log(['message'=>'Sukses update pod '.$v['hawb']],'warehouse.log');
                }else{
                    $this->error_log(['message'=>'Gagal update pod'.$v['hawb']],'warehouse.log');
                }
            }
        }
    }
    public function save_to_clearances($data)
    {
        foreach ($data as $v) {
            $inbound = new Inbound;
            $s = $inbound->select('id_')->where('waybill_smu',$v['master'])->get();
            foreach ($s as $idx) {
                    $head = ['id_header'=>$idx->id_];
                    $body = [
                        '_is_active'=>1,
                        '_created_by'=>'MY_APP',
                        'status_date'=>$v['status_date'],
                        'status_time'=>$v['status_time'],
                    ];
                    TdInboundClearance::updateOrCreate($head,$body);
                    $this->info_log(['to deliveri order status '=>$head],'warehouse.log');
            }
            $updt = $inbound->where('waybill_smu',$v['master'])->update(['full_check'=>5]);
            if($updt){
                $this->info_log(['message'=>'Sukses update '.$v['master']],'warehouse.log');
            }else{
                $this->error_log(['message'=>'Gagal update '.$v['master']],'warehouse.log');
            }
        }
    }
    public function save_to_storage($data)
    {
        foreach ($data as $v) {
            $inbound = new Inbound;
            $s = $inbound->select('id_')->where('waybill_smu',$v['master'])->get();
            foreach ($s as $idx) {
                $head = ['id_header'=>$idx->id_];
                    $body = [
                        '_is_active'=>1,
                        '_created_by'=>'MY_APP',
                        'status_date'=>$v['status_date'],
                        'status_time'=>$v['status_time'],
                    ];
                    TdInboundStorage::updateOrCreate($head,$body);
                    $this->info_log(['to storage status '=>$head],'warehouse.log');
            }
            $updt = $inbound->where('waybill_smu',$v['master'])->update(['full_check'=>4]);
            if($updt){
                $this->info_log(['message'=>'Sukses update '.$v['master']],'warehouse.log');
            }else{
                $this->error_log(['message'=>'Gagal update '.$v['master']],'warehouse.log');
            }
        }
    }
    public function save_to_breakdown($data)
    {
        foreach ($data as $v) {
            $inbound = new Inbound;
            $s = $inbound->select('id_')->where('waybill_smu',$v['master'])->get();
            foreach ($s as $idx) {
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
            $updt = $inbound->where('waybill_smu',$v['master'])->update(['full_check'=>3]);
            if($updt){
                $this->info_log(['message'=>'Sukses update '.$v['master']],'warehouse.log');
            }else{
                $this->error_log(['message'=>'Gagal update '.$v['master']],'warehouse.log');
            }
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