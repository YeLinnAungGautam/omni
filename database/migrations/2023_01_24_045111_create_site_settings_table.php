<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSiteSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('site_settings', function (Blueprint $table) {
            $table->id();
            $table->string('mobile_login_icon');
            $table->string('web_login_icon');
            $table->string('mobile_loading_icon');
            $table->string('web_register_icon');
            $table->string('web_icon');
            $table->string('web_tab_icon');
            $table->string('facebook_url')->default('NULL');
            $table->string('instagram_url')->default('NULL');
            $table->string('youtube_url')->default('NULL');
            $table->string('linkedin_url')->default('NULL');
            $table->string('phonenumber')->default('NULL');
            $table->string('address')->default('NULL');
            $table->string('short_description')->default('NULL');
            $table->string('email')->default('NULL');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('site_settings');
    }
}
