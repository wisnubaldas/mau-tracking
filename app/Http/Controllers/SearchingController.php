<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tracking;
use App\Models\Tps\Inbound;
use App\Models\Tps\ThOutbound;
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

        $inbound = Inbound::with(['delivery_aircarft','breakdown','storage','clearance','pod'])
                        ->where('hawb',$request->host)
                        ->first();
        if($inbound){

            return response()->json([
                                        'status'=>'success',
                                        'message'=>'Tracking hawb '.$request->host,
                                        'data'=>$inbound
                                    ],200);
        }
        $outbound = ThOutbound::with(['acceptance','weighing','manifest',
                                        'storage','buildup','staging','aircarft'])
                            ->where('hawb',$request->host)
                            ->first();

        if($outbound){
            return response()->json([
                                        'status'=>'success',
                                        'message'=>'Tracking hawb '.$request->host,
                                        'data'=>$outbound
                                    ],200);
        }

        return response()->json([
                                    'status'=>'failed',
                                    'message'=>'Tidak ada data tracking untuk hawb '.$request->host,
                                    'data'=>null
                                ],500);
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
