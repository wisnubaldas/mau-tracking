<?php
namespace App\Domain;
use App\Repositories\SearchFactoryInputPort;
use App\Repositories\SearchFactoryOutputPort;

use App\Driver\CounterHandler;
use App\Driver\LoggingRotateTrait;
class SearchFactory implements SearchFactoryInterface
{
    use LoggingRotateTrait;
    public $counter_file;
    public $jml_data;
    public $limit_file;
    public $input_port;

    public function __construct($input = new SearchFactoryInputPort) {
        $this->input_port = $input;
    }
    // count nya harus di pindah disini nih
    public function count_data($model):void
    {
        $this->jml_data = $this->input_port->__count($model);
    }
    public function set_file_counter($counter,$limit):void
    {
        $this->counter_file = new CounterHandler('counter/'.$counter);
        $this->limit_file = new CounterHandler('counter/'.$limit);
    }
    
    public function set_tracking($input_method):void
    {
        if($this->jml_data > $this->counter_file->get()){
            $l = ($this->jml_data - $this->counter_file->get());
            $dataNya = $this->input_port->$input_method($l);
            // bug relasi dengan limit diatas 1000
            SearchFactoryOutputPort::save_to_tracking($dataNya);

            $this->counter_file->save($this->jml_data);
            $this->limit_file->save($l);
            $this->debug_log(['message'=>'Proses '.$l.' data '.$input_method.' :)']);
        }else{
            $this->debug_log(['message'=>'Tidak ada data '.$input_method.' yg di proses']);
        }
    }

    static public function run()
    {
        $d = new SearchFactory;
        $d->count_data('App\Models\Tps\TdInboundDeliveryAircarft');
        $d->set_file_counter(self::C_AIRCARFT,self::L_AIRCARFT);
        $d->set_tracking('aircarft_data');
        $d->count_data('App\Models\Tps\TdInboundBreakdown');
        $d->set_file_counter(self::C_BREAKDOWN,self::L_BREAKDOWN);
        $d->set_tracking('breakdown_data');
        $d->count_data('App\Models\Tps\TdInboundStorage');
        $d->set_file_counter(self::C_STORAGE,self::L_STORAGE);
        $d->set_tracking('storage_data');
        $d->count_data('App\Models\Tps\TdInboundClearance');
        $d->set_file_counter(self::C_CLEARANCE,self::L_CLEARANCE);
        $d->set_tracking('clearances_data');
        $d->count_data('App\Models\Tps\TdInboundPod');
        $d->set_file_counter(self::C_POD,self::L_POD);
        $d->set_tracking('pod_data');
    }
}
