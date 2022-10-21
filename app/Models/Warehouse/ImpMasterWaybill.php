<?php

namespace App\Models\Warehouse;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImpMasterWaybill extends Model
{
    use HasFactory;
    use HasFactory;
    protected $connection= 'rdwarehouse_jkt';
    protected $table = 'imp_masterwaybill';
    protected $primaryKey = 'MasterAwb';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    // const CREATED_AT = '_created_at';
    // const UPDATED_AT = '_updated_at';
    
}
