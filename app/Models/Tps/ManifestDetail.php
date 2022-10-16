<?php

namespace App\Models\Tps;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManifestDetail extends Model
{
    use HasFactory;
    protected $connection= 'mysql';
    protected $table = 'manifest_detail';
    // protected $primaryKey = 'nomor_aju';
    // public $incrementing = false;
    // protected $keyType = 'string';
}
