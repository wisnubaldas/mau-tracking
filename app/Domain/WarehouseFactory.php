<?php
namespace App\Domain;
use Illuminate\Support\Facades\App;
use App\Repositories\WarehouseFactoryInputPort;
use App\Repositories\WarehouseImportInputPort;
use App\Repositories\WarehouseImportOutputPort;
use App\Repositories\WarehouseImportOutputApi;

use App\Models\Warehouse\ImpBreakdownheader;
use App\Models\Warehouse\ImpBreakdownDetail;
use App\Models\Warehouse\ImpHostAwb;

use App\Models\Tps\GetImpIn;

class WarehouseFactory {
    public $method_factory;

    public function __construct() {
        $this->inputPort = new WarehouseImportInputPort();
        $this->outputPort = new WarehouseImportOutputPort();
        $this->outputApi = new WarehouseImportOutputApi();
        $this->method_factory = env('OUTPUT_METHOD');
    }
    public function get_pod()
    {
        $order = $this->inputPort->pod_factory();
        if($order){
            
            switch ($this->method_factory) {
                case 'local':
                    $this->outputPort->save_to_pod($order);
                    break;
                case 'api':
                    $this->outputApi->put_to_pod($order);
                    break;
                default:
                    info('no output get_pod guys...');
                    break;
            }
        }
        return $this;
    }
    public function get_deliorder()
    {
        $order = $this->inputPort->deliorder_factory();
        if($order){
            switch ($this->method_factory) {
                case 'local':
                    $this->outputPort->save_to_clearances($order);
                    break;
                case 'api':
                    $this->outputApi->put_to_clearances($order);
                    break;
                default:
                    info('no output get_breakdown_detail guys...');
                    break;
            }
        }
        return $this;
    }
    public function get_storage()
    {
        $storage = $this->inputPort->storage_factory();
        if($storage){
            switch ($this->method_factory) {
                case 'local':
                    $this->outputPort->save_to_storage($storage);
                    break;
                case 'api':
                    $this->outputApi->put_to_storage($storage);
                    break;
                default:
                    info('no output get_breakdown_detail guys...');
                    break;
            }
        }
        return $this;
    }
    public function get_breakdown_detail()
    {
        $br_data = $this->inputPort->breakdown_factory();
        if($br_data){
            switch ($this->method_factory) {
                case 'local':
                    $this->outputPort->save_to_breakdown($br_data);
                    break;
                case 'api':
                    $this->outputApi->put_to_breakdown($br_data);
                    break;
                default:
                    info('no output get_breakdown_detail guys...');
                    break;
            }
        }
        return $this;
    }
    public function get_breakdown_header()
    {
        $br_data = $this->inputPort->air_craft_factory();
        if($br_data){
            switch ($this->method_factory) {
                case 'local':
                    $this->outputPort->save_to_aircarft($br_data);
                    break;
                case 'api':
                    $this->outputApi->put_to_aircarft($br_data);
                    break;
                default:
                    info('no output get_breakdown_header guys...');
                    break;
            }
        }
        return $this;
    }
    public function get_master()
    {
        $inbound_data = $this->inputPort->inbound_factory();
        if(count($inbound_data) > 0){
            switch ($this->method_factory) {
                case 'local':
                    $this->outputPort->save_to_inbound((array)$inbound_data);
                    break;
                case 'api':
                    $this->outputApi->put_to_inbound((array)$inbound_data);
                    break;
                default:
                    info('no output guys...');
                    break;
            }
        }
        return $this;
    }
    
    static public function run()
    {
        $warehouse = new WarehouseFactory();
        $warehouse->get_master()
                    ->get_breakdown_header()
                    ->get_breakdown_detail()
                    ->get_storage();
                    // ->get_deliorder()
                    // ->get_pod();
    }
}