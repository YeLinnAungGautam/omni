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
        'category_id',
        'percentage_id',
        'item_id',
        'store_id',
        'new_arrival',
        'most_popular',
        'subcategory_id',
        'top_selling'
    ];
    public function ProductImage(){
        return $this->hasMany(ProductImage::class,'product_id');
    }
    public function Category(){
        return $this->belongsTo(Category::class,'category_id');
    }
    public function SubCategory(){
        return $this->belongsTo(SubCategory::class,'subcategory_id');
    }
    public function Percentage(){
        return $this->hasOne(Percentages::class, 'id', 'percentage_id');
    }
    public function Store(){
        return $this->belongsTo(Store::class,'store_id'); 
    }
}
