<?php
namespace App\Repositories;
use App\Models\Tracking;
class SearchFactoryOutputPort
{
    static public function save_to_tracking($data)
    {
        foreach ($data as $tracking) {
            Tracking::create($tracking);
        }
    }
}
