<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Percentages;

class PercentageController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'percentage' => 'required',
        ]);
        $percentage = Percentages::create([
            'percentage' => $data['percentage'],
        ]);
        if($percentage){
            return response()->json([
                'status' => 'success',
                'data' =>  $percentage    
            ], 201);
        } 
    }
    
    public function update($id,Request $request){
        $data = $request->validate([
            'percentage' => 'required',
        ]);
        $percentage_update = Percentages::find($id);
        if($percentage_update){
            $percentage_update->update([
                'percentage' => $data['percentage']
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
    public function show($id)
    {
        // $percentage = Percentages::find($id);
        $percentage = Percentages::where('id', $id)->first();
        if($percentage){
            return response()->json([
                'status' => 'success',
                'data' =>  $percentage    
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
