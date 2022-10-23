<?php
namespace App\Domain;
use App\Repositories\WarehouseExportInputPort;
/**
 * undocumented class
 */

class ExportFactory
{
    public function __construct() {
        $this->inputPort = new WarehouseExportInputPort;
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
    protected function generate_th_outbound()
    {
        $this->inputPort->outbound_factory();
        return $this;
    }
    static public function run()
    {
        $fk = new ExportFactory;
        $fk->generate_th_outbound();
    }
}
