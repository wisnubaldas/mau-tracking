<?php
namespace App\Repositories;
use App\Models\Warehouse\ImpHostAwb;
use App\Models\Warehouse\ImpMasterWaybill;
use App\Models\Warehouse\ImpBreakdownheader;
use App\Models\Warehouse\ImpBreakdownDetail;

class WarehouseImportInputPort extends WarehouseEntities {
    const FILE_COUNTER_MASTER = 'C_WB_HAWB';
    const FILE_COUNTER_BR_HEADER = 'C_BR_HEADER';
    const FILE_COUNTER_BR_DETAIL = 'C_BR_DETAIL';

    public function breakdown_factory()
    {
        $this->c_file = 'counter/'.self::FILE_COUNTER_BR_DETAIL;
        $limit = $this->count_data(ImpBreakdownDetail::class);
        if($limit){
            $data = $this->get_breakdown_detail(ImpBreakdownDetail::class,$limit);
            if($data)
                $result = [];
                foreach ($data as $k => $v) {
                    $result[$k]['status_date'] = $v->DateOfBreakdown;
                    $result[$k]['status_time'] = $v->TimeOfBreakdown;
                    $result[$k]['master'] = $v->MasterAWB;
                }
                return $result;
        }
    }
    public function air_craft_factory()
    {
        $this->c_file = 'counter/'.self::FILE_COUNTER_BR_HEADER;
        $limit = $this->count_data(ImpBreakdownheader::class);
        if($limit){
            $data = $this->get_breakdown(ImpBreakdownheader::class,$limit);
            if($data)
                $result = [];
                foreach ($data as $k => $v) {
                    $result[$k]['status_date'] = $v->DateEntry;
                    $result[$k]['status_time'] = $v->TimeEntry;
                    $result[$k]['master'] = $v->detail->pluck('MasterAWB');
                }
                return $result;
        }
    }
    public function inbound_factory()
    {
        $this->c_file = 'counter/'.self::FILE_COUNTER_MASTER;

        $limit = $this->count_data(ImpHostAwb::class);
        $data = $this->get_master(ImpHostAwb::class,$limit);
        if($data){
            $result = [];
            foreach ($data as $i => $v) {
                $result[$i]['tps'] = 'MAU1';
                $result[$i]['gate_type'] = 'import';
                $result[$i]['waybill_smu'] = $v->MasterAWB;
                $result[$i]['hawb'] = $v->HostAWB;
                $result[$i]['koli'] = $v->Quantity;
                $result[$i]['netto'] = $v->Weight;
                $result[$i]['volume'] = $v->Volume;
                $result[$i]['kindofgood'] = $v->DescriptionGoods;
                $result[$i]['airline_code'] = $v->airlinescode;
                $result[$i]['flight_no'] = $v->FlightNo;
                $result[$i]['origin'] = $v->Origin;
                $result[$i]['dest'] = 'CGK';
                $result[$i]['shipper_name'] = $v->shippername;
                $result[$i]['consignee_name'] = $v->Consigneename;
                $result[$i]['_is_active'] = 1;
                $result[$i]['full_check'] = 1;
            }
            return $result;
        }
    }
}