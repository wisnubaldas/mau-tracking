<?php

namespace App\Models\Tps;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Tps\TdInboundDeliveryAircarft;
use App\Models\Tps\TdInboundBreakdown;
use App\Models\Tps\TdInboundStorage;
use App\Models\Tps\TdInboundClearance;
use App\Models\Tps\TdInboundPod;

class Inbound extends Model
{
    use HasFactory;
    protected $connection= 'mysql';
    protected $table = 'th_inbound';
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

   

    public function delivery_aircarft()
    {
        return $this->hasOne(TdInboundDeliveryAircarft::class,'id_header','id_');
    }
    public function breakdown()
    {
        return $this->hasOne(TdInboundBreakdown::class,'id_header','id_');
    }
    public function storage()
    {
        return $this->hasOne(TdInboundStorage::class,'id_header','id_');
    }
    public function clearance()
    {
        return $this->hasOne(TdInboundClearance::class,'id_header','id_');
    }
    public function pod()
    {
        return $this->hasOne(TdInboundPod::class,'id_header','id_');
    }

}
