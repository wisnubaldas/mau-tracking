<?php

namespace App\Models\Tps;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GetImpIn extends Model
{
    use HasFactory;
    protected $connection= 'db_tpsonline';
    protected $table = 'get_imp_in';
    protected $primaryKey = 'id_kms';
    // public $incrementing = false;
    // protected $keyType = 'string';
    // public $timestamps = false;
    const CREATED_AT = 'date_create';
    const UPDATED_AT = 'date_update';

}
