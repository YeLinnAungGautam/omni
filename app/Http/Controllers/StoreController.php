<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Store;

class StoreController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
        ]);
        $store = Store::create([
            'brand_name' => $data['name'],
        ]);
        if($store){
            return response()->json([
                'status' => 'success',
                'data' =>  $store    
            ], 201);
        } 
    }
    public function update($id,Request $request){
        $data = $request->validate([
            'name' => 'required',
        ]);
        $store_update = Store::find($id);
        if($store_update){
            $store_update->update([
                'brand_name' => $data['name']
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
}
