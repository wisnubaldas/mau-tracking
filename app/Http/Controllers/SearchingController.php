<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tracking;
class SearchingController extends Controller
{
    public function master_search(Request $request)
    {
        $conten =  $request->host;
        $t = new Tracking;
        return $t->with('status')->where('hawb',$request->host)->get();
    }
}
