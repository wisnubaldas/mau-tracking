<?php
namespace App\Repositories;
use App\Domain\InboundEntities;
use App\Domain\InboundInterface;
use App\Models\Tps\Inbound;
use App\Models\Tracking;
use App\Driver\LoggingRotateTrait;
class InboundOutputPort extends InboundEntities
{
    use LoggingRotateTrait;

    public function __construct() {
        parent::__construct(Inbound::class);
        $this->count();
    }
    public function get_all_inbound()
    {
        if($this->limit > 0)
        return $this->get_data(
            $this->th_inbound
                    ->with(['delivery_aircarft','breakdown','storage','clearance','pod'])
                    ->orderBy('id_','desc')
                    ->limit($this->limit)
                    ->get()
        );
    }
    public function push_into_tracking():void
    {
        $data = $this->get_all_inbound();
        if($data)
        foreach ($data as $v) {
            Tracking::create($v);
            $this->inbound_to_tracking_log($v);
            // echo \json_encode($v);
            // echo PHP_EOL;
            // \sleep(1);
        }
    }
    public static function run()
    {
        return new InboundOutputPort();
    }
    
    
    
}
