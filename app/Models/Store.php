<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    use HasFactory;

    protected $fillable = [
        'brand_name',
        'image',
        'unique_id'
    ];
    public function Slider(){
        return $this->hasMany(Slider::class,'store_id');
    }
    public function Product(){
        return $this->hasMany(Product::class,'store_id');
    } 
}
