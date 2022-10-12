<?php
namespace App\Domain;

use App\Driver\CounterHandler;

class InboundEntities implements TrackingInterface{
    // table inbound
    public $th_inbound;
    // baca file counter
    public $inbound_counter;
    // limit query
    public $limit = 0;
    public function __construct($th_inbound) {
        $this->th_inbound = new $th_inbound;
        $this->inbound_counter = new CounterHandler('counter/inbound');
    }
    public function count()
    {
        $jml_real = $this->th_inbound->count();
        $jml_storage = $this->inbound_counter->get();
        if($jml_real - $jml_storage > 0){
            $this->limit = $jml_real - $jml_storage;
        }
        $this->inbound_counter->save($jml_real);
        return $this;
    }
    
    protected function get_data($data)
    {
        
        $result = [];
        if($data){
            foreach ($data as $d) {
                
                $a = [
                    'no_aju'=>0,
                    'mawb'=>$d->waybill_smu,
                    'hawb'=>0,
                    'air_lines'=>($d->airline_code)?$d->airline_code:'0',
                    'flight'=>($d->flight_no)?$d->flight_no:'0',
                    'shipper'=>($d->shipper_name)?$d->shipper_name:'0',
                    'alamat'=>0,
                    'notify'=>0,
                    'kd_gudang'=>$d->tps,
                ];
                if($d->delivery_aircarft){
                    $a['status_trackings_id'] = 10;
                    $a['status_date'] = $d->delivery_aircarft->status_date;
                    $a['status_time'] = $this->inbound_counter->time_format($d->delivery_aircarft->status_time);
                    array_push($result,$a);
                }
                // warehouse
                if($d->breakdown){
                    $a['status_trackings_id'] = 11;
                    $a['status_date'] = $d->breakdown->status_date;
                    $a['status_time'] = $this->inbound_counter->time_format($d->breakdown->status_time);
                    array_push($result,$a);
                }
                if($d->storage){
                    $a['status_trackings_id'] = 12;
                    $a['status_date'] = $d->storage->status_date;
                    $a['status_time'] = $this->inbound_counter->time_format($d->storage->status_time);
                    array_push($result,$a);
                }
                if($d->clearance){
                    $a['status_trackings_id'] = 13;
                    $a['status_date'] = $d->clearance->status_date;
                    $a['status_time'] = $this->inbound_counter->time_format($d->clearance->status_time);
                    array_push($result,$a);
                }
                if($d->pod){
                    $a['status_trackings_id'] = 14;
                    $a['status_date'] = $d->pod->status_date;
                    $a['status_time'] = $this->inbound_counter->time_format($d->pod->status_time);
                    array_push($result,$a);
                }
                
    
            }
        }

        return $result;
    }
}