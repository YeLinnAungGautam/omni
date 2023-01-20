<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Store;
use App\Models\Product;
use App\Models\Slider;
use App\Models\Banner;
use App\Models\WishList;

class HomeController extends Controller
{
    //

    public function indexAuth($userId){
      $product = [];

      $category = Category::with('SubCategory','Product')->get();
      $slider = Slider::with('Store')->get();
      if($userId == null){
        $product = Product::with('Category','SubCategory','Percentage','Store','ProductImage')
        ->orderBy('id','DESC')
        ->limit(30)->get();
      }
      else{
        $product = Product::with('Category','SubCategory','Percentage','Store','ProductImage','ProductWishList')
        ->orderBy('id','DESC')
        ->limit(30)->get();
      }
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
      $banners = Banner::all();
      $wishlist = WishList::with('Product','Product.ProductImage')->where("user_id",$userId)->get();

      return response()->json([
        "categories" => $category,
        "sliders" => $slider,
        "products" => $product,
        "newarrival" => $new_arrival,
        "mostpopular" => $most_popular,
        "topselling" => $top_selling,
        "wishlist" => $wishlist,
        "banners" => $banners
      ], 200);
    }

    public function index(){
      $product = [];

      $category = Category::with('SubCategory','Product')->get();
      $slider = Slider::with('Store')->get();

        $product = Product::with('Category','SubCategory','Percentage','Store','ProductImage')
        ->orderBy('id','DESC')
        ->limit(30)->get();


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
      $banners = Banner::all();


      return response()->json([
        "categories" => $category,
        "sliders" => $slider,
        "products" => $product,
        "newarrival" => $new_arrival,
        "mostpopular" => $most_popular,
        "topselling" => $top_selling,
        "banners" => $banners,
        "wishlist" => ""
      ], 200);
    }
}
