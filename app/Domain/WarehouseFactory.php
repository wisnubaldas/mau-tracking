<?php
namespace App\Domain;
use App\Repositories\WarehouseFactoryInputPort;
use App\Repositories\WarehouseImportInputPort;
use App\Repositories\WarehouseImportOutputPort;

use App\Models\Warehouse\ImpBreakdownheader;
use App\Models\Warehouse\ImpBreakdownDetail;
use App\Models\Warehouse\ImpHostAwb;

use App\Models\Tps\GetImpIn;

class WarehouseFactory {
    public function __construct() {
        $this->inputPort = new WarehouseImportInputPort();
        $this->outputPort = new WarehouseImportOutputPort();
    }
    public function get_breakdown_detail()
    {
        $br_data = $this->inputPort->breakdown_factory();
        if($br_data)
            $this->outputPort->save_to_breakdown($br_data);
            return $this;
    }
    public function get_breakdown_header()
    {
        $br_data = $this->inputPort->air_craft_factory();
        if($br_data)
            $this->outputPort->save_to_aircarft($br_data);
            return $this;
    }
    public function get_master()
    {
        $inbound_data = $this->inputPort->inbound_factory();
        $this->outputPort->save_to_inbound((array)$inbound_data);
        return $this;
    }
    
    // public function breakdown()
    // {
    //     $limit = $this->inputPort->count_data(ImpBreakdownheader::class);
    //     if($limit){
    //         $data = $this->inputPort->get_breakdown(ImpBreakdownheader::class,$limit);
    //         $collect = [];
    //         foreach ($data as $i => $v) {
    //             $collect[$i]['status_date'] = $v->DateEntry;
    //             $collect[$i]['status_time'] = $v->TimeEntry;
    //             $mawb = $this->inputPort->get_breakdown_detail(ImpBreakdownDetail::class,null,$v->BreakdownNumber);
    //             if($mawb){
    //                 $host_data = $this->inputPort->imp_host_awb(ImpHostAwb::class,$mawb->MasterAWB);
    //                 if($host_data){
    //                     dump($host_data);
    //                 }
    //             }
    //         }
    //     }
    // }

    static public function run()
    {
        $warehouse = new WarehouseFactory();
        $warehouse->get_master()->get_breakdown_header()->get_breakdown_detail();
    }
}