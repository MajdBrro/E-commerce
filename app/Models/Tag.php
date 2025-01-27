<?php

namespace App\Models;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;
    use Translatable;
    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = ['translations'];
    protected $translatedAttributes = ['name'];
    protected $fillable = ['slug', 'is_active'];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function scopeActive($query){
        return $query -> where('is_active',1);
    }

    public function getActive(){
        return $this -> is_active == 0 ? __('admin.un_available') : __('admin.available');
        // return  $this -> is_active  == 0 ?  ' مفعل'   : 'غير مفعل' ;

    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    // protected $hidden = ['translations'];




}
