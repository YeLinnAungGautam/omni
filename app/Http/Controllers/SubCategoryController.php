<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\SubCategory;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subcategory = SubCategory::with('Category')->get();
        return $subcategory;
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
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
}
