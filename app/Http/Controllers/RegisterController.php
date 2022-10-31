<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Hash;

class RegisterController extends Controller
{
    
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|unique:users,email',
            'password' => 'required',
        ]);
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password'=> Hash::make($data['password']),
            'verification_code' => sha1(time()),
        ]);
        if($user != null){
            MailController::sendSignupEmail($user->name, $user->email, $user->verification_code); 
            return response()->json([
                'status' => 'success',
                'message' =>  "Your Account Has Been Created Please Check Email for verification"    
            ], 201);
        }
        else{
            return response()->json([
                'status' => 'fail',
                'message' =>  "Not Found"    
            ], 404); 
        }    
    }

    public function verifyUser(Request $request)
    {
        $verification_code = $request->code;
        $user = User::where(['verification_code' => $verification_code])->first();
        if($user != null){
            $user->is_verified = 1;
            $user->save();
            return response()->json([
                'status' => 'success',
                'message' =>  "Verification Completed! Please Log In Now"    
            ], 201);
        }
        return response()->json([
            'status' => 'Fail',
            'message' =>  "Please Verify Your Account"    
        ], 404);
    }

    public function login(Request $request)
    {
        $data = $request->validate([
            'email' => 'required|string',
            'password' => 'required|string'
        ]);
        $user = User::where('email', $data['email'])->first();
        $verify = User::where('email', $data['email'])->first()->is_verified;
        //Check Email
        if(!$user){
            return response([
                'message' => 'Email Is Not Register'
            ], 401);
        }
        //Check Password 
        if(!Hash::check($data['password'], $user->password)){
            return response([
                'message' => 'Password Is Incorrect'
            ], 401);
        }
        //Check Verified 
        if($verify == 0){
            return response([
                'message' => 'Please Verify Your Account'
            ], 401);
        }
        else{
            $token = $user->createToken('myapptoken')->plainTextToken;
            $response = [
                'user' => $user,
                'token' => $token
            ];
            return response($response, 201);
        }
    }
}
