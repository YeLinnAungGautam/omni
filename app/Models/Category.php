<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'subcategory_id'
    ]; 
    public function SubCategory(){
        return $this->hasMany(SubCategory::class,'id','subcategory_id');
    }
}
