<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Percentages;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Store;
use App\Models\SubCategory;
use App\Models\SearchList;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product = Product::with('Category','SubCategory','Percentage','Store','ProductImage')->get();
        return $product;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'price' => 'required|string',
            'item_description' => 'required|string',
            'thumbnails' => 'nullable',
            'category_id' => 'required',
            'percentage_id' => 'required',
            // 'item_id' => 'required',
            'store_id' => 'nullable'
        ]);
        $category_id = Category::find($request->category_id);
        $store_id = Store::find($request->store_id);
        $subcategory_id = SubCategory::find($request->subcategory_id);
        $percentage_id = Percentages::find($request->percentage_id);
        if($category_id && $percentage_id){
            if($store_id){
                $product = Product::create([
                    'name' => $data['name'],
                    'price' => $data['price'],
                    'item_description' => $data['item_description'],
                    'category_id' => $category_id->id,
                    'percentage_id' => $percentage_id->id,
                    'subcategory_id' => $subcategory_id->id ?? null,
                    'new_arrival' =>$request->new_arrival ?? 0,
                    'most_popular' =>$request->most_popular ?? 0,
                    'top_selling' =>$request->top_selling ?? 0,
                    'item_id' => $this->Itemid(),
                    'store_id' => $store_id->id,
                ]);
            }
            else{
                $product = Product::create([
                    'name' => $data['name'],
                    'price' => $data['price'],
                    'item_description' => $data['item_description'],
                    'category_id' => $category_id->id,
                    'percentage_id' => $percentage_id->id,
                    'subcategory_id' => $subcategory_id->id ?? null,
                    'new_arrival' =>$request->new_arrival ?? 0,
                    'most_popular' =>$request->most_popular ?? 0,
                    'top_selling' =>$request->top_selling ?? 0,
                    'item_id' => $this->Itemid(),
                    'store_id' => null,
                ]);
            }
            $store_multiple_image = array();
            $product_id = Product::latest()->first()->id;
            for ($x = 0; $x < $request->image_list; $x++) {
                $file=$request->file('thumbnails'.strval($x));
                $image_name = md5(rand(1000, 10000));
                $ext = strtolower($file->getClientOriginalExtension());
                $image_full_name = $image_name.'.'.$ext;
                $file->move(public_path('storage/product_image'), $image_full_name);
                $store_multiple_image[] = $image_full_name;
              }
                if($product_id){
                    foreach($store_multiple_image as $value) {
                        $image = ProductImage::create([
                            'thumbnails' => json_encode($value),
                            'product_id' => $product_id
                        ]);
                      }
                      $image_to_get = ProductImage::where('product_id',$product_id)->get(['thumbnails']);
                      return response()->json([
                        'status' => 'success',
                        'data' =>  $product,
                        'image' => $image_to_get
                    ], 201);
                }
                else{
                    return response()->json([
                        'status' => 'fail',
                        'message' =>  "Not Found"
                    ], 404);
                }
        }
        else{
            return response()->json([
                'status' => 'Fail',
                'message' =>  "Not Found"
            ], 404);
        }
    }
    private function Itemid()
    {
        $characters = 'abcdef12345ghijklm67890';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < 5; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
            $finalvouchernumber = 'ZT'.$randomString;
        }
        return $finalvouchernumber;
    }

    public function newarrival()
    {
        $new_arrival = Product::with('Category','SubCategory','Percentage','Store','ProductImage')->where([
            'new_arrival' => 1,
        ])->get();
            return response()->json([
                'status' => 'success',
                'data' =>  $new_arrival
            ], 201);
    }

    public function destroyImage($id){
          $success = ProductImage::find($id);
          if($success){
              $filename = $success->image;
              $success->delete();
              File::delete(public_path('storage/product_image/'.$filename));
              return response()->json([
                  'status' => 'success',
                  'message' =>  "Successfully Deleted"
              ], 201);
          }
    }

    public function mostpopular()
    {
        $most_popular = Product::with('Category','SubCategory','Percentage','Store','ProductImage')->where([
            'most_popular' => 1,
        ])->get();
            return response()->json([
                'status' => 'success',
                'data' =>  $most_popular
            ], 201);
    }
    public function topselling()
    {
        $top_selling = Product::with('Category','SubCategory','Percentage','Store','ProductImage')->where([
            'top_selling' => 1,
        ])->get();
            return response()->json([
                'status' => 'success',
                'data' =>  $top_selling
            ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
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
    public function showSingleCategoryProduct($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //

        $product = Product::find($id);
        $category = Category::find($request->category_id ?? $product->category_id);
        $subCategory = SubCategory::find($request->subcategory_id ?? $product->subcategory_id);
        $store = Store::find($request->store_id ?? $product->store_id);
        if($product){
          $product->update([
              'name' => $request->name ?? $product->name,
              'price' => $request->price ?? $product->price,
              'item_description' => $request->item_description ?? $product->item_description,
              'category_id'=> $category->id,
              'store_id'=>$store->id ?? $product->store_id,
              'subcategory_id'=>$subCategory->id ?? null,
              'new_arrival'=> $request->new_arrival ?? $product->new_arrival,
              'most_popular'=> $request->most_popular ?? $product->most_popular,
              'top_selling'=> $request->top_selling ?? $product->top_selling,
          ]);
          error_log("Image List");
          error_log($request->deleteImagelist);
          if(sizeof(json_decode($request->deleteImagelist)) > 0){
            for($i=0;$i<sizeof(json_decode($request->deleteImagelist));$i++){
              ProductImage::destroy(json_decode($request->deleteImagelist)[$i]);
            }
          }

          if($request->image_list > 0){
            error_log("Yay ");
            for ($x = 0; $x < $request->image_list; $x++) {
                $file=$request->file('thumbnails'.strval($x));
                $image_name = md5(rand(1000, 10000));
                $ext = strtolower($file->getClientOriginalExtension());
                $image_full_name = $image_name.'.'.$ext;
                $file->move(public_path('storage/product_image'), $image_full_name);
                $store_multiple_image[] = $image_full_name;
                ProductImage::create([
                    'thumbnails' => json_encode($image_full_name),
                    'product_id' => $id
                ]);
              }
          }
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        Product::destroy($id);
        return response()->json([
            'status' => 'success',
        ], 201);
    }

    public function search(Request $request)
    {
        $search = $request->search ?? "";
        if($search != "")
        {
            $product = Product::where('name','LIKE',"$search%")->get();
            SearchList::create([
                'search_data' => $search,
                'user_id' => 1,
            ]);
            return $product;
        }
    }   
}
