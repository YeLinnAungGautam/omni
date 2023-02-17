<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
{
    use HasFactory;
    protected $fillable =[
        'logo',
        'sample',
    ];
    //mobile_login_icon
    //web_login_icon
    //mobile_loading_icon
    //web_register_icon
    //web_icon
    //web_tab_icon
}
