<?php
namespace App\Repositories;
use App\Models\Tracking;
use App\Models\Tps\TdInboundDeliveryAircarft;
use App\Models\Tps\Inbound;

class SearchFactoryInputPort {
    public $aircarft;
    public function __construct() {
        $this->aircarft = new TdInboundDeliveryAircarft;
    }

    public function count_data($model)
    {
        switch ($model) {
            case 'td_inbound_delivery_aircarft':
                    return $this->aircarft->count();        
                break;
            
            default:
                    echo "ngga ada data";
                break;
        }
    }
    
    public function aircarft_data($limit)
    {

       $data = $this->aircarft
                    ->limit($limit)
                    ->orderBy('id_','desc')
                    ->get();
        $obj = [];
        foreach ($data as $i => $v) {
            $header = Inbound::find($v->id_header);
            $obj[$i]['status_trackings_id'] = 1;
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