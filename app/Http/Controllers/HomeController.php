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
use App\Models\SearchList;
use Illuminate\Support\Facades\Redis;

class HomeController extends Controller
{
    //
    

    public function indexAuth($userId){
    //   $product = [];

      $category = Category::with('SubCategory','Product')->get();
      $slider = Slider::with('Store')->get();
    //   if($userId == null){
    //     $product = Product::with('Category','SubCategory','Percentage','Store','ProductImage')
    //     ->orderBy('id','DESC')
    //     ->limit(30)->get();
    //   }
      
        $product = Product::with('Category','SubCategory','Percentage','Store','ProductImage','ProductWishList')
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
      $wishlist = WishList::with('Product','Product.ProductImage')->where("user_id",$userId)->get();
      $productSuggestionArr = Product::pluck('name')->toArray();
      $unique = array_unique($productSuggestionArr);
      $productSuggestion = array_merge($unique, array());

      return response()->json([
        "categories" => $category,
        "sliders" => $slider,
        "products" => $product,
        "newarrival" => $new_arrival,
        "mostpopular" => $most_popular,
        "topselling" => $top_selling,
        "wishlist" => $wishlist,
        "banners" => $banners,
        "productSuggestion" => $productSuggestion
      ], 200);
    }

    public function product(){
        $product = Product::pluck('name')->toArray();
        return $product;
    }

    public function index(){
      $indexData = Redis::get('indexData');
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
      $productSuggestionArr = Product::pluck('name')->toArray();
      $unique = array_unique($productSuggestionArr);
      $productSuggestion = array_merge($unique, array());
      if(!$indexData){
        $indexData = json_encode([
          "categories" => $category,
          "sliders" => $slider,
          "products" => $product,
          "newarrival" => $new_arrival,
          "mostpopular" => $most_popular,
          "topselling" => $top_selling,
          "banners" => $banners,
          "wishlist" => [],
          "productSuggestion" => $productSuggestion
        ]);
        Redis::setex('indexData', 60, $indexData);
      }
      return response()->json(json_decode($indexData), 200);
      
    }

    //   return response()->json([
    //     "categories" => $category,
    //     "sliders" => $slider,
    //     "products" => $product,
    //     "newarrival" => $new_arrival,
    //     "mostpopular" => $most_popular,
    //     "topselling" => $top_selling,
    //     "banners" => $banners,
    //     "wishlist" => [],
    //     "productSuggestion" => $productSuggestion
    //   ], 200);
    // }
}
