<?php

namespace App\Models\Tps;

use Illuminate\Database\Eloquent\Casts\Attribute;
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
    protected $appends = ['code','status'];
    // public $incrementing = false;
    // protected $keyType = 'string';

    protected $hidden = ['_created_by','id_','id_header','_is_active','_created_at','_updated_by','_updated_at','_remarks_last_update'];
    

    public function header()
    {
        return $this->hasOne(Inbound::class,'id_','id_header');
    }
    public function getCodeAttribute()
    {
        return 'B1';
    }
    public function getStatusAttribute()
    {
        return 'Delivery from aircraft to incoming warehouse';
    }
}
