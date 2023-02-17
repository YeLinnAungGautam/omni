<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Slider;
use App\Models\Store;
use App\Models\AboutUs;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Percentages;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\User;
use App\Models\WishList;

class NonAuthController extends Controller
{
    
    public function searchSuggestions(){
       $productSuggestionArr = Product::pluck('name')->toArray();
      $unique = array_unique($productSuggestionArr);
      $productSuggestion = array_merge($unique, array());
      return response()->json([
         "productSuggestion" => $productSuggestion
        ], 200); 
    }
    
    public function relatedProducts($name){
        $product = Product::find($name);
       $products = Product::with('Category','SubCategory','Percentage','Store','ProductImage')->where('name','LIKE',"$product->name%")->limit(30)->get();
       return $products;
    }
    
    
    //
    public function categoryList()
    {
    //    $category = Category::all();
        $category = Category::with('SubCategory','Product')->get();
       return $category;
    }

    public function categoryUserList($userid)
    {
    //    $category = Category::all();
        $category = Category::with('SubCategory','Product')->get();
        $wishlist = WishList::with('Product','Product.ProductImage')->where("user_id",$userid)->get();
        return response()->json([
            "category" => $category,
            'wishlist' =>  $wishlist
        ], 200);
    }


    public function productListWithLimit()
    {
        $product = Product::with('Category','SubCategory','Percentage','Store','ProductImage')->inRandomOrder()->limit(20)->get();
        return $product;
    }

    public function categoryListShow($id)
    {
        $category = Category::with('SubCategory','Product','Product.ProductImage')->find($id);
        if($category){
            return  $category    ;

        }
        else{
            return response()->json([
                'status' => 'fail',
                'message' =>  "Not Found"
            ], 404);
        }
    }

    public function categoryListShowTest($categoryId)
    {
        try{
            
            $category = Category::where("id",$categoryId)->with('SubCategory','Product','Product.ProductImage')->paginate(100);
            if($category){
                return  $category;
    
            }
            else{
                return response()->json([
                    'status' => 'fail',
                    'message' =>  "Not Found"
                ], 404);
            }
        }
        catch (\Exception $e) {

            return $e->getMessage();
        }
        
    }

    public function subCategoryList()
    {
        $subcategory = SubCategory::with('Category')->get();
        return $subcategory;
    }

    public function subCategoryShow($id)
    {
        $sub_category = SubCategory::with('Category','Product','Product.ProductImage')->find($id);
        if($sub_category){
            return response()->json([
                'status' => 'success',
                'data' =>  $sub_category
            ], 201);
        }
        else{
            return response()->json([
                'status' => 'fail',
                'message' =>  "Not Found"
            ], 404);
        }
    }

    public function productList()
    {
        $product = Product::with('Category','SubCategory','Percentage','Store','ProductImage')->orderBy('id', 'desc')->limit(30)->get();
        return $product;
    }
    
    public function productSubListTest($categoryId){
        $product = Product::where("subcategory_id",$categoryId)->with('Category','SubCategory','Percentage','Store','ProductImage')->orderBy('id', 'desc')->paginate(100);
      return $product;
    }
    
    public function productListTest($categoryId)
    {
        
      $product = Product::where("category_id",$categoryId)->with('Category','SubCategory','Percentage','Store','ProductImage')->orderBy('id', 'desc')->paginate(100);
      return $product;
    }
    public function productShow($id)
    {
        $product = Product::with('Category','SubCategory','Percentage','Store','ProductImage')->find($id);
        if($product){
            return response()->json([
                'status' => 'success',
                'data' =>  $product
            ], 201);
        }
        else{
            return response()->json([
                'status' => 'fail',
                'message' =>  "Not Found"
            ], 404);
        }
    }

    public function brandList()
    {
        $store = Store::with('Slider')->get();
        return $store;
    }

    public function brandShow($uniqueid)
    {
        // $sub_category = SubCategory::with('Category')->find($id);
        // $store = Store::find($uniqueid);
        $store = Store::where(['unique_id' => $uniqueid])->first();
        if($store){
            return response()->json([
                'status' => 'success',
                'data' =>  $store
            ], 201);
        }
        else{
            return response()->json([
                'status' => 'fail',
                'message' =>  "Not Found"
            ], 404);
        }
    }
    
    
    public function showBrandWithProduct($id)
    {
        $store_product_slider = Store::with('Product','Slider','Product.ProductImage')->find($id);
        if($store_product_slider){
            return response()->json([
                'status' => 'success',
                'data' =>  $store_product_slider
            ], 201);
        }
        else{
            return response()->json([
                'status' => 'fail',
                'message' =>  "Not Found"
            ], 404);
        }
    }

    public function sliderList()
    {
        $slider = Slider::with('Store')->get();
        return $slider;
    }

    public function aboutus()
    {
        $aboutus = AboutUs::all()->first();
        return $aboutus;
    }
    
    public function getUserWishList($id){
        $wishlistData = WishList::where([["user_id","=",$id]])->get();
        return $wishlistData;
    }


    public function createWishList($userid,$productid)
    {
      $find_product = Product::find($productid);
      $find_user = User::find($userid);
      $wishlistData = WishList::where([["product_id","=",$productid],["user_id","=",$userid]])->first();
      if($wishlistData){
          return response()->json([
              'status' => 'success',

          ], 200);
      }
      else{
           if($find_user && $find_product){
          WishList::create([
              'user_id' => $userid,
              'product_id' => $productid
          ]);
          return response()->json([
              'status' => 'success',

          ], 200);
      }else{
          return response()->json([
              'status' => 'fail',
              'message' =>  "Not Found"
          ], 404);
      }
      }
  }


    public function wishlist($userid,$productid)
    {
        $find_product = Product::find($productid);
        $find_user = User::find($userid);
        if($find_user && $find_product){
            WishList::create([
                'user_id' => $userid,
                'product_id' => $productid
            ]);
        }else{
            return response()->json([
                'status' => 'fail',
                'message' =>  "Not Found"
            ], 404);
        }
    }

    public function disableWishList($userid,$productid)
    {
        $find_user = User::find($userid);
        if($find_user)
        {
            WishList::where('product_id',$productid)->firstorfail()->delete();
            return response()->json([
                'status' => 'success',
                'message' =>  "Successfully Deleted"
            ], 201);
        }
        else{
            return response()->json([
                'status' => 'fail',
                'message' =>  "User Not Found"
            ], 404);
        }
    }
    public function listofwishlist($userId)
    {
        $wishlist = WishList::with('Product','Product.ProductImage','Product.Category')->where("user_id",$userId)->get();
        return $wishlist;
    }
}
