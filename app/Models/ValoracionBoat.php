<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ValoracionBoat extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'embarcacion_id',
        'ca_valoracion',
        'class',
        'comment',
    ];
}
