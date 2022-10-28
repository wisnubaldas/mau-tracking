<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tracking;
use App\Models\Tps\Inbound;
use App\Driver\LoggingRotateTrait;
use Jenssegers\Agent\Agent;

class SearchingController extends Controller
{
    const API_LOG = 'api.log';
    use LoggingRotateTrait;
    public function master_search(Request $request)
    {
        $agent = new Agent();
        $this->log_api($request->ip(),$request->host,$agent);

        $conten =  $request->host;
        $t = new Tracking;
        return $t->with('status')->where('hawb',$request->host)->get();
    }
    public function search_banyak(Request $request)
    {
        $agent = new Agent();
        $this->log_api($request->ip(),$request->host,$agent);

        $d = Inbound::with(['delivery_aircarft','breakdown','storage','clearance','pod'])
                        ->where('hawb',$request->host)
                        ->get();
        $x = [];
        foreach ($d as $i => $k) {
            if($k->delivery_aircarft){
                $k->delivery_aircarft->code = 'B1';
                $k->delivery_aircarft->status = 'Delivery from aircraft to incoming warehouse';
            }
            if($k->breakdown){
                $k->breakdown->code = 'B2';
                $k->breakdown->status = 'Arrival at Incoming warehouse';
            }
            if($k->storage){
                $k->storage->code = 'B3';
                $k->storage->status = 'Storage';
            }
            if($k->clearance){
                $k->clearance->code = 'B4';
                $k->clearance->status = 'Custom & quarantine Clearance';
            }
            if($k->pod){
                $k->pod->code = 'B5';
                $k->pod->status = 'Received by consignee';
            }

            $x[$i] = $k;
        }
        return $x;
    }
    protected function log_api($ip,$host,$agent)
    {
        $this->info_log([
                        'message'=>[
                                    'host'=>$host,
                                    'ip'=>$ip,
                                    'robot'=>$agent->robot(),
                                    'browser'=>$agent->browser(),
                                    'device'=>$agent->device(),
                                    'platform'=>$agent->platform()
                                ]
                        ],self::API_LOG);
    }
}
