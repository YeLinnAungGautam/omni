<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\SubCategory;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $category = Category::with('SubCategory')->get();
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
        ]);
        $subcategory_id = SubCategory::find($request->subcategory_id);
        if($subcategory_id){
            $category = Category::create([
                'name' => $data['name'],
                'subcategory_id' => $subcategory_id->id,
            ]);
            return response()->json([
                'status' => 'success',
                'data' =>  $category    
            ], 201);
        }
        else{
            return response()->json([
                'status' => 'fail',
                'message' => "Error"    
            ], 500);
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
        //
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
        $data = $request->validate([
            'name' => 'required|string',
            'subcategory_id' => 'required',
        ]);
        $category_update = Category::find($id);
        $subcategory_id = SubCategory::find($data['subcategory_id']);
        if($category_update && $subcategory_id){
            $category_update->update([
                'name' => $data['name'],
                'subcategory_id' => $data['subcategory_id']
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
        $success = Category::find($id);
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
