<?php
namespace App\Repositories;
use App\Models\Warehouse\EksMasterwaybill;
use App\Models\Warehouse\EksHostawb;
use App\Repositories\ExportInputPortTrait;
/**
 * buat narik data export class
 */
class WarehouseExportInputPort extends WarehouseEntities 
{
    /**
     * tarik data dari esport master awb
     * parsing datanya buat di insert ke
     * export outbound kasih flag_complete 1
     *
     * @param Type $var Description
     * @return type
     * @throws conditon
     **/
    
    const COUNT_EXP_MASTER = 'EXP_MASTER';
    const COUNT_EXP_DETAIL = 'EXP_HOST';
    use ExportInputPortTrait;

    public function outbound_factory_detail()
    {
        $this->c_file = 'counter/'.self::COUNT_EXP_DETAIL;
        $limit = $this->count_data(EksHostawb::class);
        if($limit){
            $data = $this->get_host(EksHostawb::class,$limit);
            if($data){
                $jml_host = 0;
                $result = [];
                foreach ($data as $i => $v) {
                   if(!$v->MasterAWB || !$v->HostAWB){
                        $this->error_log(['message'=>'inbound export detail Master atau host null tidak bisa di proses']);
                   }else{
                        $master = $this->get_master_where(EksMasterwaybill::class,$v->MasterAWB);
                        if($master){
                            
                            $result[$i]['tps'] = 'MAU1';
                            $result[$i]['gate_type'] = 'ekspor';
                            $result[$i]['waybill_smu'] = $v->MasterAWB;
                            $result[$i]['hawb'] = $v->HostAWB;
                            $result[$i]['koli'] = $v->Quantity;
                            $result[$i]['netto'] = $v->Weight;
                            $result[$i]['volume'] = $v->Volume;
                            $result[$i]['kindofgood'] = $v->DescriptionGoods;
                            $result[$i]['airline_code'] = $v->airlinescode;
                            $result[$i]['flight_no'] = $v->FlightNo;
                            $result[$i]['origin'] = $master->Origin;
                            $result[$i]['dest'] = $master->Destination;
                            $result[$i]['shipper_name'] = $v->shippername;
                            $result[$i]['consignee_name'] = $v->Consigneename;
                            $result[$i]['_is_active'] = 1;
                            // $result[$i]['full_check'] = 1;
                            $jml_host++;

                        }
                   }
                
                }
                $this->debug_log(['message'=>'outhbound export detail master, '.$jml_host.' host bisa di proses']);
                return $result;
            }
        }
        
    }
    public function outbound_factory()
    {
        $this->c_file = 'counter/'.self::COUNT_EXP_MASTER;
        $limit = $this->count_data(EksMasterwaybill::class);
        if($limit){
            $data = $this->get_master(EksMasterwaybill::class,$limit);
            if($data){
                $result = [];
                foreach ($data as $e) {
                    $host = $this->get_host(EksHostawb::class,$e->MasterAWB);
                    if($host){
                        if($host->count() > 0){
                            foreach ($host as $i => $v) {
                                $result[$i]['tps'] = 'MAU1';
                                $result[$i]['gate_type'] = 'ekspor';
                                $result[$i]['waybill_smu'] = $v->MasterAWB;
                                $result[$i]['hawb'] = $v->HostAWB;
                                $result[$i]['koli'] = $v->Quantity;
                                $result[$i]['netto'] = $v->Weight;
                                $result[$i]['volume'] = $v->Volume;
                                $result[$i]['kindofgood'] = $v->DescriptionGoods;
                                $result[$i]['airline_code'] = $v->airlinescode;
                                $result[$i]['flight_no'] = $v->FlightNo;
                                $result[$i]['origin'] = $e->Origin;
                                $result[$i]['dest'] = $e->Destination;
                                $result[$i]['shipper_name'] = $v->shippername;
                                $result[$i]['consignee_name'] = $v->Consigneename;
                                $result[$i]['_is_active'] = 1;
                                // $result[$i]['full_check'] = 1;
                            }                            
                        }
                    }                    
                }
                return $result;
            }
        }

    }
}
