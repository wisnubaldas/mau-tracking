<?php

namespace App\Models\Warehouse;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Warehouse\ImpHostAwb;
class ImpBreakdownDetail extends Model
{
    use HasFactory;
    protected $connection= 'rdwarehouse_jkt';
    protected $table = 'imp_breakdowndetail';
    protected $primaryKey = 'noid';
    // public $incrementing = false;
    // protected $keyType = 'string';
    public function hosts()
    {
        return $this->hasMany(ImpHostAwb::class,'MasterAWB','MasterAWB');
    }
}
