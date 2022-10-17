<?php
namespace App\Repositories;

// use App\Repositories\BreakdownInputPort;
use App\Models\Tps\Inbound;
use App\Models\Tps\TdInboundBreakdown;
use App\Models\Tps\TdInboundDeliveryAircarft;
use App\Models\Tps\TdInboundStorage;
use App\Models\Tps\TdInboundClearance;
use App\Models\Tps\TdInboundPod;
use App\Models\Tps\GetImpIn;


use App\Domain\BreakdownEntities;
use App\Driver\LoggingRotateTrait;
use App\Models\Warehouse\ImpHostAwb;
use App\Models\Warehouse\ImpDeliorderheader;
use App\Models\Warehouse\ImpPodheader;
use App\Models\Warehouse\ImpPoddetail;

use Carbon\Carbon;
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
                    // ini gratis ngga pake detail
                    $getImpIn = GetImpIn::where('no_master_bl_awb',$d->MasterAWB)->first();
                    if($getImpIn){
                        $data_handler['hawb'] = $getImpIn->no_bl_awb;
                        $data_handler['shipper_name'] = '';
                        $data_handler['consignee_name'] = $getImpIn->consignee;
                        $data_handler['origin'] = $getImpIn->pel_muat;
                        $data_handler['dest'] = 'CGK';
                        $data_handler['_is_active'] = 1;
                        $data_handler['_created_by'] = 'MY_APP';
                    }else{
                        $data_handler['hawb'] = $d->MasterAWB;
                        $data_handler['shipper_name'] = '';
                        $data_handler['consignee_name'] = '';
                        $data_handler['origin'] = '';
                        $data_handler['dest'] = 'CGK';
                        $data_handler['_is_active'] = 1;
                        $data_handler['_created_by'] = 'MY_APP';
                    }
                    $id_header = $this->set_to_td_inbound($data_handler);
                    $this->set_to_td_inbound_delivery_aircarft($id_header,$v->DateEntry,$v->TimeEntry);
                    $this->td_inbound_breakdown($id_header,$d->DateOfBreakdown,$d->TimeOfBreakdown);
                    $this->td_inbound_storage($id_header,$d->DateOfBreakdown,$d->TimeOfBreakdown);
                    $this->td_inbound_clearance($id_header,$d->DateOfBreakdown,$d->TimeOfBreakdown,$d->MasterAWB);
                    $this->td_inbound_pod($id_header,$d->DateOfBreakdown,$d->TimeOfBreakdown,$d->BreakdownNumber,$d->MasterAWB);
                    $this->debug_log(['message'=>'Master '.$d->MasterAWB.' data aneh ngga ada host di prosess']);
                }else{
                    foreach ($d->hosts as $h) {
                        $data_handler['hawb'] = $h->HostAWB;
                        $data_handler['shipper_name'] = $h->shippername;
                        $data_handler['consignee_name'] = $h->Consigneename;
                        $data_handler['origin'] = $h->Origin;
                        $data_handler['dest'] = 'CGK';
                        $data_handler['_is_active'] = 1;
                        $data_handler['_created_by'] = 'MY_APP';

                        $id_header = $this->set_to_td_inbound($data_handler);
                        $this->set_to_td_inbound_delivery_aircarft($id_header,$v->DateEntry,$v->TimeEntry);
                        $this->td_inbound_breakdown($id_header,$d->DateOfBreakdown,$d->TimeOfBreakdown);
                        $this->td_inbound_storage($id_header,$d->DateOfBreakdown,$d->TimeOfBreakdown);
                        $this->td_inbound_clearance($id_header,$d->DateOfBreakdown,$d->TimeOfBreakdown,$d->MasterAWB);
                        $this->td_inbound_pod($id_header,$d->DateOfBreakdown,$d->TimeOfBreakdown,$d->BreakdownNumber,$h->HostAWB);
                        $this->debug_log(['message'=>'Master '.$d->MasterAWB.' ada host nya normal prosess']);
                    }
                }
                
            }
           
        }
        
    }
    private function set_to_td_inbound($data)
    {
        $this->warehouse_log($data,'wh.log');
        return Inbound::create($data)->id_;
    }
    private function set_to_td_inbound_delivery_aircarft($id,$date,$time)
    {
        $data = [
            'id_header'=>$id,
            'status_date'=>$date,
            'status_time'=>$time,
            '_is_active'=>1,
            '_created_by'=>'MY_APP'
        ];
        TdInboundDeliveryAircarft::create($data);
        $this->warehouse_log($data,'wh.log');

    }
    private function td_inbound_breakdown($id,$date,$time)
    {
        $data = [
            'id_header'=>$id,
            'status_date'=>$date,
            'status_time'=>$time,
            '_is_active'=>1,
            '_created_by'=>'MY_APP'
        ];
        TdInboundBreakdown::create($data);
        $this->warehouse_log($data,'wh.log');

    }
    private function td_inbound_storage($id,$date,$time)
    {
        $data = [
            'id_header'=>$id,
            'status_date'=>$date,
            'status_time'=>Carbon::create($time)->add('hour', 1)->format('H:i'),
            '_is_active'=>1,
            '_created_by'=>'MY_APP'
        ];
        TdInboundStorage::create($data);
        $this->warehouse_log($data,'wh.log');

    }
    public function td_inbound_clearance($id,$date,$time,$mawb)
    {
        $d = ImpDeliorderheader::where('MasterAWB',$mawb)->first();
        if($d){
            $date = $d->DateOfDeliveryOrder;
            $time = $d->TimeOfDeliveryOrder;
            $data = [
                'id_header'=>$id,
                'status_date'=>$date,
                'status_time'=>$time,
                '_is_active'=>1,
                '_created_by'=>'MY_APP'
            ];
            TdInboundClearance::create($data);
            $this->warehouse_log($data,'wh.log');
        }else{
            $this->error_log(compact('id','date','time','mawb'),'wh.log');
        }
        

    }
    private function td_inbound_pod($id,$date,$time,$breakdown,$hawb)
    {
        $inv = ImpPoddetail::with('header')->where('HostAWB',$hawb)->first();
        if($inv)
        {
            $data = [
                'id_header'=>$id,
                'status_date'=>$inv->header->DateOfOut,
                'status_time'=>$inv->header->TimeOfOut,
                '_is_active'=>1,
                '_created_by'=>'MY_APP'
            ];
    
            TdInboundPod::create($data);
            $this->warehouse_log($data,'wh.log');
        }else{
            $this->error_log(compact('id','date','time','hawb'),'wh.log');
        }
        
    }
}