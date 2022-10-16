<?php

namespace App\Models\Warehouse;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImpPoddetail extends Model
{
    use HasFactory;
    protected $connection= 'rdwarehouse_jkt';
    protected $table = 'imp_poddetail';
    protected $primaryKey = 'noid';
    public function header()
    {
        return $this->hasOne(ImpPodheader::class,'InvoiceNumber','InvoiceNumber');
    }
}
