<?php
namespace App\Repositories;
use App\Models\Tps\ThOutbound;
use App\Models\Tps\TdOutbondAcceptance;
use App\Models\Tps\TdOutbondWeighing;
use App\Models\Tps\TdOutbondManifest;
use App\Models\Tps\TdOutbondStorage;
use App\Models\Tps\TdOutbondBuildup;
use App\Models\Tps\TdOutbondDeliveryStaging;
use App\Models\Tps\TdOutbondDeliveryAircarft;


use Carbon\Carbon;
class WarehouseExportOutputPort extends WarehouseEntities{
    
    public function save_buildup($data)
    {
        foreach ($data as $v) {
            $x = $this->get_id_by_host($v['host']);
            $head = ['id_header'=>$x->id_];
            $body = ['status_date'=>$v['DateEntry'],'status_time'=>$v['TimeEntry'],'_is_active'=>1,'_created_by'=>'MY_APP'];
            TdOutbondBuildup::updateOrCreate($head,$body);

            $date = $this->date_plus_hour($v['DateEntry'],$v['TimeEntry'],2);
            $body = ['status_date'=>$date->toDateString(),'status_time'=>$date->toTimeString(),'_is_active'=>1,'_created_by'=>'MY_APP'];
            TdOutbondDeliveryStaging::updateOrCreate($head,$body);

            $date = $this->date_plus_hour($v['DateEntry'],$v['TimeEntry'],4);
            $body = ['status_date'=>$date->toDateString(),'status_time'=>$date->toTimeString(),'_is_active'=>1,'_created_by'=>'MY_APP'];
            TdOutbondDeliveryAircarft::updateOrCreate($head,$body);

        }
    }

    public function save_storage($data)
    {
        $jml = 0;
        foreach ($data as $k => $v) {
            $id = $this->get_id_by_master($v->MasterAWB);
            if($id)
                foreach ($id as $x) {
                    $head = ['id_header'=>$x->id_];
                    $body = ['status_date'=>$v->DateEntry,'status_time'=>$v->TimeEntry,'_is_active'=>1,'_created_by'=>'MY_APP'];
                    TdOutbondStorage::updateOrCreate($head,$body);                    
                    $jml = $k;
                }
                
        }
        $this->debug_log([$jml.' data telah di buat di TdOutbondStorage::class']); 
    }
    public function save_manifest($head,$body)
    {
        $date = $head['status_date'].' '.$head['status_time'];
        $date = Carbon::parse($date)->addHour(2);
        $head['status_date'] = $date->toDateString();
        $head['status_time'] = $date->toTimeString();
        TdOutbondManifest::updateOrCreate($head,$body);
    }
    public function save_weighing($data)
    {
        $jml = 0;
        foreach ($data as $k => $v) {
            $id = $this->get_id_by_host($v->HostAWB)->first();
            if($id)
                $head = ['id_header'=>$id->id_];
                $body = ['status_date'=>$v->DateEntry,'status_time'=>$v->TimeEntry,'_is_active'=>1,'_created_by'=>'MY_APP'];
                TdOutbondWeighing::updateOrCreate($head,$body);
                // langsung save ke td_outbond_manifest
                $this->save_manifest($head,$body);
                $jml = $k;
        }
        $this->debug_log([$jml.' data telah di buat di TdOutbondWeighing::class']);  
    }
    public function save_approval($data)
    {
        $jml = 0;
        foreach ($data as $k => $v) {
            $id = $this->get_id($v->HostAWB);
            if($id)
                $head = ['id_header'=>$id->id_];
                $body = ['status_date'=>$v->DateOfSLI,'status_time'=>$v->TimeOFSLI,'_is_active'=>1,'_created_by'=>'MY_APP'];
                TdOutbondAcceptance::updateOrCreate($head,$body);
                $jml = $k;
        }
        $this->debug_log([$jml.' data telah di buat di TdOutbondAcceptance::class']);  
    }
    public function save_outbound($data)
    {
        foreach ($data as $v) {
		
            $this->debug_log(['message'=>$v]);
            dd(); 
            $head = ['waybill_smu'=>$v['waybill_smu'],'hawb'=>$v['hawb']];
            ThOutbound::updateOrCreate($head,$v);
            $this->debug_log(['message'=>'Input th_outbound hawb '.$v['hawb']]);                
        }
    }
    protected function get_id_by_master($mawb)
    {
        return ThOutbound::select('id_')->where('waybill_smu',$mawb)->get();
    }
    protected function get_id_by_host($hawb)
    {
        return ThOutbound::select('id_')->where('hawb',$hawb)->first();
    }
    protected function date_plus_hour($date,$time,$plus)
    {
        return Carbon::parse($date.' '.$time)->addHour($plus);
    }
}
