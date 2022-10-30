<?php
namespace App\Repositories;
use App\Jobs\WarehouseFactoryJob;
use App\Jobs\AircarftJob;
use App\Jobs\BreakdownJob;
use App\Jobs\StorageJob;
use App\Jobs\ClearanceJob;
use App\Jobs\PodJob;

use Carbon\Carbon;
/**
 * undocumented class
 */
class WarehouseImportOutputApi
{
    public $waktu_yg_terhenti;
    public function __construct() {
        $this->waktu_yg_terhenti = Carbon::parse('now');
    }
    public function put_to_pod($data)
    {
        dispatch(new PodJob(collect($data)->toJson()));
    }
    /**
     * undocumented function summary
     *
     * Undocumented function long description
     *
     * @param Type $var Description
     * @return type
     * @throws conditon
     **/
    public function put_to_clearances($data)
    {
        dispatch(new ClearanceJob(collect($data)->toJson()));
    }
    /**
     * undocumented function summary
     *
     * Undocumented function long description
     *
     * @param Type $var Description
     * @return type
     * @throws conditon
     **/
    public function put_to_storage($data)
    {
        dispatch(new StorageJob(collect($data)->toJson()));
    }
    /**
     * undocumented function summary
     *
     * Undocumented function long description
     *
     * @param Type $var Description
     * @return type
     * @throws conditon
     **/
    public function put_to_breakdown($data)
    {
        dispatch(new BreakdownJob(collect($data)->toJson()));
    }
    /**
     * undocumented function summary
     *
     * Undocumented function long description
     *
     * @param Type $var Description
     * @return type
     * @throws conditon
     **/
    public function put_to_aircarft($data)
    {
       dispatch(new AircarftJob(collect($data)->toJson()));
    }
    /**
     * undocumented function summary
     *
     * Undocumented function long description
     *
     * @param Type $var Description
     * @return type
     * @throws conditon
     **/
    public function put_to_inbound($data)
    {
        foreach ($data as $i => $v) {
            // $time->addSeconds(3);
            dispatch(new WarehouseFactoryJob($v))->delay($this->waktu_yg_terhenti->addSeconds(3));
        }
    }
}
