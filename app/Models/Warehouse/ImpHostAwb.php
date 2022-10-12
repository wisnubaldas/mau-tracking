<?php

namespace App\Models\Warehouse;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImpHostAwb extends Model
{
    use HasFactory;
    protected $connection= 'rdwarehouse_jkt';
    protected $table = 'imp_hostawb';
    // protected $primaryKey = 'nomor_aju';
    // public $incrementing = false;
    // protected $keyType = 'string';
}
