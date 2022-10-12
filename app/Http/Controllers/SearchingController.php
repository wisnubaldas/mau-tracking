<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tracking;
class SearchingController extends Controller
{
    public function master_search(Request $request)
    {
        $conten =  $request->all();
        $t = new Tracking;
        $mawb = $t->whereIn('mawb',$conten);
        if($mawb->count() > 0){
            return $mawb->get();
        }
        $hawb = $t->whereIn('hawb',$conten);
        if($hawb->count() > 0){
            return $hawb->get();
        }
    }
}
