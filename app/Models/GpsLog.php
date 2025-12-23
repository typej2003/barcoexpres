<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GpsLog extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'lat', 'lng', 'speed', 'alt', 'recorded_at'];
}
