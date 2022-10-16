<?php

namespace App\Models\Tps;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TdInboundDeliveryAircarft extends Model
{
    use HasFactory;
    protected $connection= 'mysql';
    protected $table = 'td_inbound_delivery_aircarft';
    protected $primaryKey = 'id_';
    const CREATED_AT = '_created_at';
    const UPDATED_AT = '_updated_at';
    public $fillable = ['id_header','status_date','status_time','_is_active','_created_by'];
    // public $incrementing = false;
    // protected $keyType = 'string';
    public function header()
    {
        return $this->hasOne(Inbound::class,'id_','id_header');
    }
}
