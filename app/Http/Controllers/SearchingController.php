<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tracking;
use App\Models\Tps\Inbound;
class SearchingController extends Controller
{
    public function master_search(Request $request)
    {
        $conten =  $request->host;
        $t = new Tracking;
        return $t->with('status')->where('hawb',$request->host)->get();
    }
    public function search_banyak(Request $request)
    {
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
                $k->storage->code = 'B4';
                $k->storage->status = 'Custom & quarantine Clearance';
            }
            if($k->clearance){
                $k->storage->code = 'B5';
                $k->storage->status = 'Received by consignee';
            }

            $x[$i] = $k;
        }
        return $x;
    }
}
