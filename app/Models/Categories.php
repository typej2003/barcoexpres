<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Categories extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'img',
        'parent',
        'category_id',
        'ruta',
    ];

    protected $appends = [
        'img_url',
    ];

    public function getImgUrlAttribute()
    {
        if ($this->img && Storage::disk('avatarscategories')->exists($this->img)) {
            return Storage::disk('avatarscategories')->url($this->img);
        }

        return asset('noimage.png');
    }

    public function subcategories()
    {
        return Categories::where('category_id',$this->id)->get();
    }
}
