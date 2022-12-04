<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Store;
use App\Models\Product;
use App\Models\Slider;

class HomeController extends Controller
{
    //

    public function index(){
      $category = Category::with('SubCategory','Product')->get();
      $slider = Slider::with('Store')->get();
      $product = Product::with('Category','SubCategory','Percentage','Store','ProductImage')->orderBy('id','DESC')->take(5)->get() ;
      $new_arrival = Product::with('Category','SubCategory','Percentage','Store','ProductImage')->where([
          'new_arrival' => 1,
      ])->get();
      $most_popular = Product::with('Category','SubCategory','Percentage','Store','ProductImage')->where([
          'most_popular' => 1,
      ])->get();
      $top_selling = Product::with('Category','SubCategory','Percentage','Store','ProductImage')->where([
          'top_selling' => 1,
      ])->get();
      $store = Store::with('Slider')->get();

      return response()->json([
        "categories" => $category,
        "sliders" => $slider,
        "products" => $product,
        "newarrival" => $new_arrival,
        "mostpopular" => $most_popular,
        "topselling" => $top_selling
      ], 200);
    }
}
