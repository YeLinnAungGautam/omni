<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{

  function __construct()
  {
       // $this->middleware('permission:slider-list|slider-create|slider-edit|slider-delete', ['only' => ['index','store']]);
       $this->middleware('permission:category-list', ['only' => ['index','subcategorylist']]);
       $this->middleware('permission:category-create', ['only' => ['create','store','subcategorystore']]);
       $this->middleware('permission:category-edit', ['only' => ['edit','update','subcategoryupdate']]);
       $this->middleware('permission:category-delete', ['only' => ['destroy','subcategorydestroy']]);
  }

      /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    //    $category = Category::all();
        $category = Category::with('SubCategory','Product')->get();
       return $category;
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
            'image' => 'required|image:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $file= $request->file('image');
        $filename= date('YmdHi').$file->getClientOriginalName();
        $file-> move(public_path('storage/category_image'), $filename);
        $category = Category::create([
            'name' => $data['name'],
            'image' => $filename,
            'number' => 0,
            'unique_id' => $this->UniqueId()
        ]);
        $category_image_name = Category::latest()->first()->image;
        return response()->json([
            'status' => 'success',
            'data' =>  $category,
            'image-url' => Storage::url("category_image/".$category_image_name)
            //if get the error of not found for image url,
            //please run the "php artisan storage:link" command.
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
    public function update($id,Request $request)
    {
        // $data = $request->validate([
        //     'name' => 'nullable',
        //     'image' => 'nullable|image:jpeg,png,jpg,gif,svg|max:2048',
        // ]);
        $category_find_to_update = Category::find($id);
        if($category_find_to_update){
            if($request->hasFile('image') != null){
                $file= $request->file('image');
                $filename= date('YmdHi').$file->getClientOriginalName();
                $file-> move(public_path('storage/category_image'), $filename);
                if(File::exists(public_path('storage/category_image/'.$category_find_to_update->image))){
                    File::delete(public_path('storage/category_image/'.$category_find_to_update->image));
                    $category_find_to_update->update([
                        'image' => $filename
                    ]);
                    return response()->json([
                        'status' => 'success',
                        'message' =>  "Successfully Updated"
                    ], 201);
                }
                else{
                    $category_find_to_update->update([
                        'image' => $filename
                    ]);
                    return response()->json([
                        'status' => 'success',
                        'message' =>  "Successfully Updated"
                    ], 201);
                }
            }
            if(empty($request->input('name'))){
                $category_find_to_update->update([
                    'name' => $category_find_to_update->name,
                    'number' => 0,
                ]);
            }
            else{
                $category_find_to_update->update([
                    'name' => $request->name ?? $category_find_to_update->name,
                    'number' => 0,
                ]);
                return response()->json([
                    'status' => 'success',
                    'message' =>  "Successfully Updated"
                ], 201);
            }
        }
        else{
            return response()->json([
                'status' => 'fail',
                'message' =>  "Not Found"
            ], 404);
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
        $success = Category::find($id);
        if($success){
            $filename = $success->image;
            $success->delete();
            File::delete(public_path('storage/category_image/'.$filename));
            return response()->json([
                'status' => 'success',
                'message' =>  "Successfully Deleted"
            ], 201);
        }
        else{
            return response()->json([
                'status' => 'fail',
                'message' =>  "Not Found"
            ], 404);
        }
    }
    private function UniqueId()
    {
        $characters = 'ladwkiow2qr1234stuvw56789xyz';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < 5; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
            $finalvouchernumber = 'cat'.$randomString;
        }
        return $finalvouchernumber;
    }

    public function subcategorydestroy($id)
    {
        $success = SubCategory::find($id);
        if($success){
            $success->delete();
            return response()->json([
                'status' => 'success',
                'message' =>  "Successfully Deleted"
            ], 201);
        }
        else{
            return response()->json([
                'status' => 'fail',
                'message' =>  "Not Found"
            ], 404);
        }
    }

    public function subcategorylist()
    {
        $subcategory = SubCategory::with('Category')->get();
        return $subcategory;
    }

    public function subcategoryupdate(Request $request, $id)
    {
        // $data = $request->validate([
        //     'name' => 'required|string',
        //     'category_id' => 'required',
        // ]);
        $subcategory_find_to_update = SubCategory::find($id);
        $find_category_id = Category::find($request->category_id);
        if($subcategory_find_to_update && $find_category_id){
            $subcategory_find_to_update->update([
                'name' => $request->name ?? $subcategory_find_to_update->name,
                'category_id' => $request->category_id ?? $subcategory_find_to_update->category_id
            ]);
            return response()->json([
                'status' => 'success',
                'message' =>  "Successfully Updated"
            ], 201);
        }
        else{
            return response()->json([
                'status' => 'fail',
                'message' =>  "Not Found"
            ], 404);
        }
    }

    public function subcategorystore(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'category_id' => 'required',
        ]);
        $category_id = Category::find($request->category_id);
        if($category_id){
            $sub_category = SubCategory::create([
                'name' => $data['name'],
                'category_id' => $category_id->id,
            ]);
            return response()->json([
                'status' => 'success',
                'data' => $sub_category
            ], 201);
        }
            else{
                return response()->json([
                    'status' => 'fail',
                    'message' =>  "Not Found"
                ], 404);
            }
    }
}
