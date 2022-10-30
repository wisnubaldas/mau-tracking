<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use App\Repositories\WarehouseImportOutputPort;
use App\Driver\LoggingRotateTrait;
use Jenssegers\Agent\Agent;

class TpsApiController extends Controller
{
    use LoggingRotateTrait;
    public $repo;
    protected $agent;
    public function __construct() {
        $this->repo = new WarehouseImportOutputPort();
        $this->agent = new Agent();
    }
    public function cek_token($token)
    {
        // $this->log_api($request->ip(),$request->host,$this->agent);
        try {
            $decrypted = Crypt::decrypt($token);
            if($decrypted == env('TOKEN_API')){
                return true;
            }else{
                $this->error_log(['message'=>'token tidak cocok ']);
                return response()->json(['message'=>'Token tidak cocok'],500);
            }
        } catch (DecryptException $e) {
            $e->getMessage();
            $this->error_log(['message'=>'token tidak cocok ']);
        }
    }

    public function th_inbound(Request $request)
    {
        $token = $request->header('X-XSRF-TOKEN');
        $token = $this->cek_token($token);
        if($token){
            $this->repo->save_to_inbound([$request->all()]);
            $this->log_api($request->ip(),$request->host,$this->agent);
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
            $this->log_api($request->ip(),$request->host,$this->agent);
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
            $this->log_api($request->ip(),$request->host,$this->agent);
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
            $this->log_api($request->ip(),$request->host,$this->agent);

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
            $this->log_api($request->ip(),$request->host,$this->agent);

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
            $this->log_api($request->ip(),$request->host,$this->agent);

            return response()->json(['message'=>'Sukses insert data'],200);
        }
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
                        ],'api.log');
    }
}
