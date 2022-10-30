<?php

namespace App\Models\Warehouse;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EksMasterwaybill extends Model
{
    use HasFactory;
    protected $connection= 'rdwarehouse_jkt';
    protected $table = 'eks_masterwaybill';
    protected $primaryKey = 'MasterAWB';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;
    public function host()
    {
        return $this->hasMany(EksHostawb::class,'MasterAWB','MasterAWB');
    } 
}
