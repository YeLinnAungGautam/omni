<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    use HasFactory;

    protected $fillable = [
        'brand_name'
    ];
    public function Sider(){
        return $this->belongsTo(Slider::class,'store_id');
    }
}
