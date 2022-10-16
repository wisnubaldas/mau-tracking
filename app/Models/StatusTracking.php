<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatusTracking extends Model
{
    use HasFactory;
    // protected $fillable = ['stat','code'];
    protected $hidden = ['created_at','updated_at','id'];

    
}
