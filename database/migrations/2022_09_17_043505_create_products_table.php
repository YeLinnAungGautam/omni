<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('price');
            $table->string('item_description');
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('percentage_id');
            $table->unsignedBigInteger('store_id')->nullable();
            $table->unsignedBigInteger('subcategory_id')->nullable();
            $table->string('item_id');
            $table->foreign('category_id')
                  ->references('id')
                  ->on('categories')
                  ->onDelete('cascade');
            $table->foreign('percentage_id')
                  ->references('id')
                  ->on('percentages')
                  ->onDelete('cascade');
            $table->foreign('store_id')
                  ->references('id')
                  ->on('stores')
                  ->onDelete('cascade');
            $table->foreign('subcategory_id')
                  ->references('id')
                  ->on('sub_categories')
                  ->onDelete('cascade');
            $table->string('new_arrival')->default(0);
            $table->string('most_popular')->default(0);
            $table->string('top_selling')->default(0);
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
        Schema::dropIfExists('products');
    }
}
