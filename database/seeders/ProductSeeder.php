<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;
use App\Models\Percentages;
use App\Models\ProductImage;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        $percentage = Percentages::create([
            'percentage' => "1",
        ]);

        $category = Category::create([
            'name' => "Test Category",
            'image' => "202211100359cat-4.jpg",
            'number' => 0,
            'unique_id' => "12312312"
        ]);

        $product = Product::create([
            'name' => "Test Product",
            'price' => "100000",
            'item_description' => "Test Description",
            'category_id' => $category->id,
            'percentage_id' => $percentage->id,
            'subcategory_id' => null,
            'new_arrival' =>1,
            'most_popular' =>1,
            'top_selling' =>1,
            'item_id' => "342342342343234",
            'store_id' => null,
        ]);

        $image = ProductImage::create([
            'thumbnails' => json_encode("202211100359cat-4.jpg"),
            'product_id' => $product->id
        ]);

        $product1 = Product::create([
            'name' => "Test Product 2",
            'price' => "100000",
            'item_description' => "Test Description 2",
            'category_id' => $category->id,
            'percentage_id' => $percentage->id,
            'subcategory_id' => null,
            'new_arrival' =>1,
            'most_popular' =>1,
            'top_selling' =>1,
            'item_id' => "342342342343234",
            'store_id' => null,
        ]);

        $image1 = ProductImage::create([
            'thumbnails' => json_encode("202211100359cat-4.jpg"),
            'product_id' => $product1->id
        ]);
    }
}
