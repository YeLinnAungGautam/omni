<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable =[
        'name',
        'price',
        'item_description', 
        'thumbnails',
        'category_id',
        'percentage_id',
        'item_id'
    ];
}
