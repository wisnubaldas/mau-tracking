<?php
namespace App\Domain;
use App\Repositories\WarehouseExportInputPort;
use App\Repositories\WarehouseExportOutputPort;
/**
 * undocumented class
 */

class ExportFactory
{
    public function __construct() {
        $this->inputPort = new WarehouseExportInputPort;
        $this->outputPort = new WarehouseExportOutputPort;
    }
    /**
     * fungsi buat jalanin bikin data
     *
     * data yg ditarik dari data export 
     *
     * @param Type $var Description
     * @return type
     * @throws conditon
     **/
    protected function generate_th_outbound_host()
    {
        $data = $this->inputPort->outbound_factory_detail();
        if($data)
            $this->outputPort->save_outbound($data);
        return $this;
    }
    protected function generate_th_outbound()
    {

        $data = $this->inputPort->outbound_factory();
        if($data)
            $this->outputPort->save_outbound($data);
        return $this;
    }
    static public function run()
    {
        $fk = new ExportFactory;
        $fk->generate_th_outbound()->generate_th_outbound_host();
    }
}
