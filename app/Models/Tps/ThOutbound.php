<?php

namespace App\Models\Tps;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ThOutbound extends Model
{
    use HasFactory;
    protected $connection= 'mysql';
    protected $table = 'th_outbond';
    protected $primaryKey = 'id_';
    // public $incrementing = false;
    // protected $keyType = 'string';
    // public $timestamps = false;
    const CREATED_AT = '_created_at';
    const UPDATED_AT = '_updated_at';
    protected $hidden = ['id_','_updated_by','_updated_at','_remarks_last_update',
    '_is_active','_created_by','_created_at','key_upload','full_check'];
    
    protected $fillable = ['waybill_smu','volume','transit','tps','shipper_name','origin',
    'netto','koli','kindofgood','key_upload','hawb','gate_type','full_check','flight_no',
    'dest','consignee_name','airline_code','_updated_by','_updated_at','_remarks_last_update',
    '_is_active','_created_by','_created_at'];

    public function acceptance()
    {
        return $this->hasOne(TdOutbondAcceptance::class,'id_header','id_');
    }
    public function weighing()
    {
        return $this->hasOne(TdOutbondWeighing::class,'id_header','id_');
    }
    public function manifest()
    {
        return $this->hasOne(TdOutbondManifest::class,'id_header','id_');
    }
    public function storage()
    {
        return $this->hasOne(TdOutbondStorage::class,'id_header','id_');
    }
    public function buildup()
    {
        return $this->hasOne(TdOutbondBuildup::class,'id_header','id_');
    }
    public function staging()
    {
        return $this->hasOne(TdOutbondDeliveryStaging::class,'id_header','id_');
    }
    public function aircarft()
    {
        return $this->hasOne(TdOutbondDeliveryAircarft::class,'id_header','id_');
    }
}
