<?php
namespace App\Domain;
use App\Repositories\SearchFactoryInputPort;
use App\Repositories\SearchFactoryOutputPort;

use App\Driver\CounterHandler;
class SearchFactory implements SearchFactoryInterface
{
    public $counter;
    public $jml_data;
    public $limit;
    
    // count nya harus di pindah disini nih
    public function count_data($model)
    {

        switch ($model) {
            case 'td_inbound_delivery_aircarft':
                    
                    return $this->aircarft->count();        
                break;
            
            default:
                    echo "ngga ada data";
                break;
        }
    }

    public function get_aircarft_count():void
    {
        $x = new SearchFactoryInputPort;
        $this->jml_data = $x->count_data('td_inbound_delivery_aircarft');
        $this->counter = new CounterHandler('counter/'.self::C_AIRCARFT);
        $this->limit = new CounterHandler('counter/'.self::L_AIRCARFT);
    }
    public function get_aircarft_data()
    {
        if($this->jml_data > $this->counter->get()){
            $l = ($this->jml_data - $this->counter->get());

            $input = new SearchFactoryInputPort;
            // bug relasi dengan limit diatas 1000
            SearchFactoryOutputPort::set_aircarft_data($input->aircarft_data($l));

            $this->counter->save($this->jml_data);
            $this->limit->save($l);
        }else{
            echo "lempar ke log";
        }
    }
}
