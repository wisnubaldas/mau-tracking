<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tracking extends Model
{
    use HasFactory;
    protected $fillable = ['status_trackings_id','no_aju','mawb','hawb',
    'air_lines','flight','shipper','alamat','notify','kd_gudang','status_date',
    'status_time'];
    protected $hidden = ['created_at','updated_at','id','status_trackings_id'];
    public function status()
    {
        return $this->belongsTo(StatusTracking::class,'status_trackings_id','id');
    }
}
