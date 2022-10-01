<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    use HasFactory;

    protected $fillable = [
        'brand_name',
        'image'
    ];
    public function Sider(){
        return $this->hasMany(Slider::class,'store_id');
    }
}
