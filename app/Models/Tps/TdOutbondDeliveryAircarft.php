<?php

namespace App\Models\Tps;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TdOutbondDeliveryAircarft extends Model
{
    use HasFactory;
    protected $connection= 'mysql';
    protected $table = 'td_outbond_delivery_aircarft';
    protected $primaryKey = 'id_';
    // public $incrementing = false;
    // protected $keyType = 'string';
    // public $timestamps = false;
    const CREATED_AT = '_created_at';
    const UPDATED_AT = '_updated_at';
    public $fillable = ['id_header','status_date','status_time','_is_active','_created_by'];
    protected $hidden = ['id_','id_header','_is_active','_created_by','_created_at','_updated_by','_updated_at','_remarks_last_update'];
}
