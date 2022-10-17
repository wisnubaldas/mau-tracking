<?php
namespace App\Repositories;
use App\Models\Tracking;
use App\Models\Tps\TdInboundDeliveryAircarft;
use App\Models\Tps\TdInboundBreakdown;

use App\Models\Tps\Inbound;

class SearchFactoryInputPort {
    public $model_nya;

    public function __count($model)
    {
        $this->model_nya = new $model();
        return $this->model_nya->count();
    }
    public function pod_data($limit)
    {
        $data = $this->model_nya->limit($limit)->orderBy('id_','desc')->get();
        return self::prepare_data($data,14);
    }
    public function clearances_data($limit)
    {
        $data = $this->model_nya->limit($limit)->orderBy('id_','desc')->get();
        return self::prepare_data($data,13);
    }
    public function storage_data($limit)
    {
        $data = $this->model_nya->limit($limit)->orderBy('id_','desc')->get();
        return self::prepare_data($data,12);
    }
    public function breakdown_data($limit)
    {
        $data = $this->model_nya->limit($limit)->orderBy('id_','desc')->get();
        return self::prepare_data($data,11);
    }

    public function aircarft_data($limit)
    {
       $data = $this->model_nya->limit($limit)->orderBy('id_','desc')->get();
        return self::prepare_data($data,10);
    }
    static private function prepare_data($data,$id_status)
    {
        $obj = [];
        foreach ($data as $i => $v) {
            $header = Inbound::find($v->id_header);
            $obj[$i]['status_trackings_id'] = $id_status;
            $obj[$i]['no_aju'] = 0;
            $obj[$i]['mawb'] = $header->waybill_smu;
            $obj[$i]['hawb'] = $header->hawb;
            $obj[$i]['air_lines'] = $header->airline_code;
            $obj[$i]['flight'] = $header->flight_no;
            $obj[$i]['shipper']= $header->shipper_name;
            $obj[$i]['alamat']= '';
            $obj[$i]['notify']= $header->consignee_name;
            $obj[$i]['kd_gudang'] = $header->tps;
            $obj[$i]['status_date'] = $v->status_date;
            $obj[$i]['status_time'] = $v->status_time;
        }
        return $obj;
    }

}