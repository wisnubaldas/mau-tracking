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
    public function get_pod()
    {
        $order = $this->inputPort->pod_factory();
        if($order)
            $this->outputPort->save_to_pod($order);
        return $this;
    }
    public function get_deliorder()
    {
        $order = $this->inputPort->deliorder_factory();
        if($order)
            $this->outputPort->save_to_clearances($order);
        return $this;
    }
    public function get_storage()
    {
        $storage = $this->inputPort->storage_factory();
        if($storage)
            $this->outputPort->save_to_storage($storage);
        return $this;
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
    
    static public function run()
    {
        $warehouse = new WarehouseFactory();
        $warehouse->get_master()
                    ->get_breakdown_header()
                    ->get_breakdown_detail()
                    ->get_storage()
                    ->get_deliorder()
                    ->get_pod();
    }
}