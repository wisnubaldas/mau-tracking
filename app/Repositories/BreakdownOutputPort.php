<?php
namespace App\Repositories;

// use App\Repositories\BreakdownInputPort;
use App\Models\Tps\Inbound;
use App\Domain\BreakdownEntities;
use App\Driver\LoggingRotateTrait;
use App\Models\Warehouse\ImpHostAwb;
class BreakdownOutputPort {
    use LoggingRotateTrait;

    public $breakdown;
    
    // public function __construct($breakdown = BreakdownInputPort) {
    //     $this->breakdown = $breakdown;
    // }
    public function save_to_tps($data)
    {
        $this->breakdown = $data;
        if($this->breakdown){
            $this->th_inbound();
        }
    }
    protected function th_inbound()
    {
       $arr = [];

        foreach ($this->breakdown as $i => $v) {
            $log = ['breakdown_id'=> $v->BreakdownNumber,'jml_detail'=>$v->detail->count()];
            
            $data_handler = [
                'br_number'=>$v->BreakdownNumber,
                'tps'=>BreakdownEntities::TPS,
                'gate_type'=>BreakdownEntities::GATE,
            ];
            // abis breakdown berapa jumlah master yg di breakdown
            foreach ($v->detail as $d) {
                // dapet host nya
                $data_handler['waybill_smu'] = $d->MasterAWB;
                $data_handler['koli'] = $d->Pieces;
                $data_handler['netto'] = $d->Netto;
                $data_handler['volume'] = $d->Volume;
                $data_handler['kindofgood'] = $d->KindOfGood;
                $data_handler['airline_code'] = $d->AirlinesCode;
                $data_handler['flight_no'] = $d->FlightNumber;
                if($d->hosts->count() == 0)
                {
                    dump($d->MasterAWB);

                    // $xx = ImpHostAwb::where('HostAWB',$d->MasterAWB)->get()->toArray();
                    // dump($xx);
                }else{
                    foreach ($d->hosts as $h) {
                        $data_handler['hawb'] = $h->HostAWB;
                        $data_handler['shipper_name'] = $h->shippername;
                        $data_handler['consignee_name'] = $h->Consigneename;
                        $data_handler['consignee_name'] = $h->Consigneename;
                        $data_handler['origin'] = $h->Origin;
                        $data_handler['dest'] = 'CGK';
                        $data_handler['_is_active'] = 1;
                        $data_handler['_created_by'] = 'MY_APP';
                        // array_push($arr,$data_handler);
                        // Inbound::create($data_handler);
                        // $this->warehouse_log($data_handler,'th_inbound.log');
                    }
                }
                
            }
           
            $log['detail'][] = ['detail_id'=>$d->MasterAWB,'jml_hosts'=>$d->hosts->count()];
        }
         $this->warehouse_log($log,'breakdown_count.log');
        
    }
}