<?php

namespace App\Models\Warehouse;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EksApproval extends Model
{
    use HasFactory;
    protected $connection= 'rdwarehouse_jkt';
    protected $table = 'eks_approval';
    protected $primaryKey = 'noid';
    // public $incrementing = false;
    // protected $keyType = 'string';
    // public $timestamps = false;
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'modify_at';
}
