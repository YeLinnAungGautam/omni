<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;
use Laravel\Sanctum\HasApiTokens;

class Slider extends Model
{
    use HasApiTokens,HasFactory,HasRoles;
    protected $guard_name = 'api';

    protected $fillable = [
        'name',
        'image',
        'store_id'
    ];
    public function Store(){
        return $this->belongsTo(Store::class,'store_id');
    }
}
