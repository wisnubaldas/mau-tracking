<?php
namespace App\Repositories;
use App\Models\Warehouse\EksMasterwaybill;
use App\Models\Warehouse\EksHostawb;
use App\Models\Warehouse\EksApproval;
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
    const C_APPROVAL = 'EXP_APPROVAL';

    use ExportInputPortTrait;
    
    public function approval()
    {
        $this->c_file = 'counter/'.self::C_APPROVAL;
        $limit = $this->count_data(EksApproval::class);
        if($limit){
            $data = $this->get_exp_approval(EksApproval::class,$limit);
            dump($data);
        }
        
    }

    public function outbound_factory_detail()
    {
        $this->c_file = 'counter/'.self::COUNT_EXP_DETAIL;
        $limit = $this->count_data(EksHostawb::class);
        if($limit){
            $data = $this->get_host(EksHostawb::class,$limit);
            if($data){
                $jml_host = 0;
                $result = [];

                foreach ($data->groupBy('MasterAWB') as $i => $v) {
                    $master = $this->get_master_where(EksMasterwaybill::class,$i);
                    if($master){
                        foreach ($v as $h) {
                            $jml_host++;

                            $result[$jml_host]['tps'] = 'MAU1';
                            $result[$jml_host]['gate_type'] = 'ekspor';
                            $result[$jml_host]['waybill_smu'] = $h->MasterAWB;
                            $result[$jml_host]['hawb'] = $h->HostAWB;
                            $result[$jml_host]['koli'] = $h->Quantity;
                            $result[$jml_host]['netto'] = $h->Weight;
                            $result[$jml_host]['volume'] = $h->Volume;
                            $result[$jml_host]['kindofgood'] = $h->DescriptionGoods;
                            $result[$jml_host]['airline_code'] = $h->airlinescode;
                            $result[$jml_host]['flight_no'] = $h->FlightNo;
                            $result[$jml_host]['origin'] = $master->Origin;
                            $result[$jml_host]['dest'] = $master->Destination;
                            $result[$jml_host]['shipper_name'] = $h->shippername;
                            $result[$jml_host]['consignee_name'] = $h->Consigneename;
                            $result[$jml_host]['_is_active'] = 1;
                            // $result[$i]['full_check'] = 1;
                            
                        }
                    }else{
                        $this->error_log(['message'=>'inbound export detail Master atau host null tidak bisa di proses']);
                    }
                }

                $this->info_log(['message'=>'outhbound export detail master, '.$jml_host.' host bisa di proses']);
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
