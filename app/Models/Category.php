<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    use Translatable;
    protected $with = ['translations'];
    protected $translatedAttributes = ['name'];
    protected $fillable = ['parent_id', 'slug', 'is_active'];
    // protected $hidden =['translations'];//لكل الداتا الراجعة return لإخفاء الترجمات من الظهور عندما نعمل
    protected $casts = [
        'is_active' => 'boolean',
    ];



}
