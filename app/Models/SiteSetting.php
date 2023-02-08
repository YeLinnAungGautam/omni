<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
{
    use HasFactory;
    protected $fillable =[
        'mobile_login_icon',
        'web_login_icon',
        'mobile_loading_icon',
        'web_register_icon',
        'web_icon',
        'web_tab_icon',
        'facebook_url',
        'instagram_url',
        'youtube_url',
        'linkedin_url',
        'phonenumber',
        'address',
        'short_description',
        'email'
    ];
}
