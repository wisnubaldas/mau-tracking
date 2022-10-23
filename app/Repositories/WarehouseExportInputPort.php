<?php
namespace App\Repositories;
use App\Models\Warehouse\EksMasterwaybill;
use App\Models\Warehouse\EksHostawb;

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
    public function outbound_factory()
    {
        $this->c_file = 'counter/'.self::COUNT_EXP_MASTER;
        $limit = $this->count_data(EksMasterwaybill::class);
        if($limit){
            $data = $this->get_master(EksMasterwaybill::class,$limit);
            if($data){
                foreach ($data as $e) {
                    $host = $this->get_host(EksHostawb::class,$e->MasterAWB);
                    if($host){
                        if($host->count() == 1){
                            dd($host->toArray());
                        }
                        dump($host->count());
                    }                    
                }
            }
        }

    }
}
