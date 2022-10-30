<?php
namespace App\Driver;
use Illuminate\Support\Facades\Http;

trait ClientRequest {
    /**
     * undocumented function summary
     *
     * Undocumented function long description
     *
     * @param Type $var Description
     * @return type
     * @throws conditon
     **/
    
    public function put_data($uri,$token,$data)
    {
       return Http::withHeaders(['X-XSRF-TOKEN'=>$token])->post($uri, $data);
    }
}