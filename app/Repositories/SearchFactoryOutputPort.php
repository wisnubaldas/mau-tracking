<?php
namespace App\Repositories;
use App\Models\Tracking;
class SearchFactoryOutputPort
{
    static public function set_aircarft_data($data)
    {
        foreach ($data as $tracking) {
            Tracking::create($tracking);
        }
    }
}
