<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TermAndCondition;

class TermandConditionController extends Controller
{
    public function store(Request $request)
    { 
        $data = $request->validate([
            'description' => 'required|string',
        ]);
        $terms_and_condition = TermAndCondition::create([
            'description' => $data['description'],
        ]);
        return response()->json([
            'status' => 'success',
            'data' =>  $terms_and_condition,
        ], 201);
    }
    public function index()
    {
        $terms_and_condition = TermAndCondition::all();
        return $terms_and_condition;
    }
    public function show($id)
    {
        $$terms_and_condition = TermAndCondition::find($id);
        if($$terms_and_condition){
            return response()->json([
                'status' => 'success',
                'data' =>  $$terms_and_condition    
            ], 201); 
        }
        else{
            return response()->json([
                'status' => 'fail',
                'message' =>  "Not Found"   
            ], 404); 
        }
    }
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'description' => 'required|string',
        ]);
        $term_and_condition_find_to_update = TermAndCondition::find($id);
        if($term_and_condition_find_to_update){
            $term_and_condition_find_to_update->update([
                'description' => $data['description'],
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
    public function delete($id)
    {
        $success = TermAndCondition::find($id);
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
