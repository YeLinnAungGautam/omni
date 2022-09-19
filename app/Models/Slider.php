<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'image',
        'store_id'
    ];
    public function Store(){
        return $this->hasMany(Store::class,'id','store_id');
    }
}
