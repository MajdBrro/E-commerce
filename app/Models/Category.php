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

    public function _parent(){
        return $this -> belongsTo( self::class , 'parent_id');
    }


    public function scopeParent($query){
        return $query -> whereNull('parent_id');
    }
    public function scopeChild($query){
        return $query -> whereNotNull('parent_id');
    }

    public function scopechildrens(){
        return $this -> hasMany(Self::class,'parent_id');
    }

    public function scopeActive($query){
        return $query -> where('is_active',1);
    }


}
