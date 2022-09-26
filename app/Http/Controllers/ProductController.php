<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Percentages;
use App\Models\Product;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
            'thumbnails' => 'required',
            'category_id' => 'required',
            'percentage_id' => 'required',
            'item_id' => 'required'
            // 'name' => 'required|string',
            // 'price' => 'required|string',
            // 'item_description' => 'required|string',
            // 'thumbnails' => 'nullable|image:jpeg,png,jpg,gif,svg|max:2048',
            // 'category_id' => 'nullable',
            // 'percentage_id' => 'nullable',
            // 'item_id' => 'required'
            
        ]);
        $file= $request->file('image');
            foreach($request->file('thumbnails') as $image)
            {   
                $name=$image->date('YmdHi').$file->getClientOriginalName();
                $image->move(public_path('storage/product_image'), $name);  
                $date[] = $image->getClientOriginalName() ;  
            }
            $product = Product::create([
                'name' => $data['name'],
                'price' => $data['price'],
                'item_description' => $data['item_description'],
                'category_id' => $data['category_id'],
                'percentage_id' => $data['percentage_id'],
                'item_id' => $data['item_id'],
                'thumbnails' => json_encode($date),
            ]);
            return response()->json([
                'status' => 'success',
                'data' =>  $product,
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
    public function update(Request $request, $id)
    {
        //
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
    }
}
