<?php

namespace App\Models\Warehouse;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Warehouse\ImpBreakdownDetail;
class ImpBreakdownheader extends Model
{
    use HasFactory;
    protected $connection= 'rdwarehouse_jkt';
    protected $table = 'imp_breakdownheader';
    protected $primaryKey = 'noid';
    // public $incrementing = false;
    // protected $keyType = 'string';

    public function detail()
    {
        return $this->hasMany(ImpBreakdownDetail::class,'BreakdownNumber','BreakdownNumber');
    }
}
