<?php

namespace App\Models\Tps;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManifestHeader extends Model
{
    use HasFactory;
    protected $connection= 'db_tpsonline';
    protected $table = 'manifest_header';
    protected $primaryKey = 'nomor_aju';
    public $incrementing = false;
    protected $keyType = 'string';
}
