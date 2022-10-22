<?php

namespace App\Models\Warehouse;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Warehouse\ImpPoddetail;
class ImpPodheader extends Model
{
    use HasFactory;
    protected $connection= 'rdwarehouse_jkt';
    protected $table = 'imp_podheader';
    protected $primaryKey = 'noid';
    public function detail()
    {
        return $this->hasOne(ImpPoddetail::class,'InvoiceNumber','InvoiceNumber');
    }
}
