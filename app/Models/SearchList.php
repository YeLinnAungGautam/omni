<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SearchList extends Model
{
    use HasFactory;

    protected $fillable =[
        'search_data',
        'user_id'
    ];
    public function User(){
        return $this->belongsTo(User::class,'user_id');
    }
}
