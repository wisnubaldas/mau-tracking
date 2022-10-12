<?php
namespace App\Repositories;

use App\Models\Warehouse\ImpBreakdownheader;
use App\Driver\CounterHandler;
use App\Domain\BreakdownEntities;
class BreakdownInputPort extends BreakdownEntities{
    public $counter;
    public $jml_breakdown;
    public function __construct() {
        $this->jml_breakdown = ImpBreakdownheader::count();
        $this->counter = new CounterHandler('counter/breakdown_header');
    }
    public function get_breakdown()
    {
        if($this->jml_breakdown > $this->counter->get()){
            $limit = ($this->jml_breakdown - $this->counter->get());
            $this->set_data_breakdown(
                ImpBreakdownheader::with(['detail'=>function($q){
                    $q->with('hosts');
                }])
                ->limit($limit)
                ->orderBy('noid','desc')
                ->get()
            );
        }

        $this->counter->save($this->jml_breakdown);
    }
}
