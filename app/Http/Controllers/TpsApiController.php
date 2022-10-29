<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use App\Repositories\WarehouseImportOutputPort;
use App\Driver\LoggingRotateTrait;

class TpsApiController extends Controller
{
    use LoggingRotateTrait;
    public $repo;
    public function __construct() {
        $this->repo = new WarehouseImportOutputPort();
    }
    public function cek_token($token)
    {
        try {
            $decrypted = Crypt::decrypt($token);
            if($decrypted == env('TOKEN_API')){
                return true;
            }else{
                return response()->json(['message'=>'Token tidak cocok'],500);
            }
        } catch (DecryptException $e) {
            $e->getMessage();
            info("Error.... token bermasalah......!!!");
        }
    }

    public function th_inbound(Request $request)
    {
        $token = $request->header('X-XSRF-TOKEN');
        $token = $this->cek_token($token);
        if($token){
            $this->info_log([$request->all()],'api.log');
            $this->repo->save_to_inbound([$request->all()]);
            return response()->json(['message'=>'Sukses insert data'],200);
        }
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
    public function th_aircarft(Request $request)
    {
        $token = $request->header('X-XSRF-TOKEN');
        $token = $this->cek_token($token);
        if($token)
        {
            $this->repo->save_to_aircarft(json_decode($request->data,true));
            return response()->json(['message'=>'Sukses insert data'],200);
        }
        
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
    public function th_breakdown(Request $request)
    {
        $token = $request->header('X-XSRF-TOKEN');
        $token = $this->cek_token($token);
        if($token)
        {
            $this->repo->save_to_breakdown(json_decode($request->data,true));
            return response()->json(['message'=>'Sukses insert data'],200);
        }
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
    public function th_storage(Request $request)
    {
        $token = $request->header('X-XSRF-TOKEN');
        $token = $this->cek_token($token);
        if($token)
        {
            $this->repo->save_to_storage(json_decode($request->data,true));
            return response()->json(['message'=>'Sukses insert data'],200);
        }
    }

    public function th_clearance(Request $request)
    {
        $token = $request->header('X-XSRF-TOKEN');
        $token = $this->cek_token($token);
        if($token)
        {
            $this->repo->save_to_clearances(json_decode($request->data,true));
            return response()->json(['message'=>'Sukses insert data'],200);
        }
    }
    
    public function th_pod(Request $request)
    {
        $token = $request->header('X-XSRF-TOKEN');
        $token = $this->cek_token($token);
        if($token)
        {
            $this->repo->save_to_pod(json_decode($request->data,true));
            return response()->json(['message'=>'Sukses insert data'],200);
        }
    }
}
