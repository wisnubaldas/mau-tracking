<?php

namespace App\Models\Tps;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TdInboundStorage extends Model
{
    use HasFactory;
    protected $connection= 'mysql';
    protected $table = 'td_inbound_storage';
    protected $primaryKey = 'id_';
    const CREATED_AT = '_created_at';
    const UPDATED_AT = '_updated_at';
    public $fillable = ['id_header','status_date','status_time','_is_active','_created_by'];
    protected $hidden = ['id_','id_header','_is_active','_created_by','_created_at','_updated_by','_updated_at','_remarks_last_update'];
    
    // public $incrementing = false;
    // protected $keyType = 'string';
    protected $appends = ['code','status'];
    public function getCodeAttribute()
    {
        return 'B3';
    }
    public function getStatusAttribute()
    {
        return 'Storage Postion';
    }
}
