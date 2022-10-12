<?php

namespace App\Models\Tps;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TdInboundClearance extends Model
{
    use HasFactory;
    protected $connection= 'db_tpsonline';
    protected $table = 'td_inbound_clearance';
    protected $primaryKey = 'id_';
    // public $incrementing = false;
    // protected $keyType = 'string';
}
