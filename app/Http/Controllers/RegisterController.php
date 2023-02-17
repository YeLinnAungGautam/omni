<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Hash;

class RegisterController extends Controller
{

    public function store(Request $request)
    {
        // try{
        $data = $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|unique:users,email',
            'profile_image' => 'nullable|image:jpeg,png,jpg,gif,svg|max:2048',
            'factory' => 'required|string',
            'password' => 'required',
        ]);
        // $file= $request->file('profile_image');
        // $filename= time().$file->getClientOriginalName();
        // $file-> move(public_path('storage/profile_pictures'), $filename);
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'factory_name' => $data['factory'],
            'profile_pic' => "user_profile.jpg",
            'password'=> Hash::make($data['password']),
            'is_verified'=> 1,
            'verification_code' => sha1(time()),
        ]);
        $user->assignRole("User");
        if($user != null){
            MailController::sendSignupEmail($user->name, $user->email, $user->verification_code);
            $response = [
                      'user' => $user,
                      'token' => "null"
                  ];
            return response()->json($response, 201);
        }
        else{
            return response()->json([
                'status' => 'fail',
                'message' =>  "Not Found"
            ], 404);
        }
    //   }catch(\Exception $e){
    //     return $e->getMessage();
    //     // return response()->json([
    //     //     'status' => 'fail',
    //     //     'message' =>  "Cannot Sent to Your Email: Please Connect to service@ztrademm.com"
    //     // ], 404);
    //   }
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

        //Check Email
        if(!$user){
            return response([
                'message' => 'Email Is Not Register'
            ], 401);
        }
        else{
          $user = User::with('roles')->where('email', $data['email'])->first();
          $verify = User::where('email', $data['email'])->first()->is_verified;
          if($user->roles[0]->name == "User"){
              return response([
                  'message' => 'I know what you are trying to do! Get out and use this link ztrademm.com.'
              ], 401);
          }
          else{
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
                  $user->api_token = $token;
                  $response = [
                      'user' => $user,
                      'token' => $token
                  ];
                  return response($response, 201);
              }
          }
         
        }

    }
    
    public function userlogin(Request $request)
    {
        $data = $request->validate([
            'email' => 'required|string',
            'password' => 'required|string'
        ]);
        $user = User::where('email', $data['email'])->first();

        //Check Email
        if(!$user){
            return response([
                'message' => 'Email Is Not Register'
            ], 401);
        }
        else{
          $user = User::with('roles')->where('email', $data['email'])->first();
          $verify = User::where('email', $data['email'])->first()->is_verified;

       
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
                  $user->api_token = $token;
                  $response = [
                      'user' => $user,
                      'token' => $token
                  ];
                  return response($response, 201);
              }
          
         
        }

    }

    public function show($id)
    {
        $user = User::find($id);
        $user_permissions = $user->getAllPermissions();
        return ["user" => $user,'permissions' => $user_permissions];
    }

    public function update(Request $request,$id)
    {
        $profile_update_find = User::find($id);
        if($profile_update_find){
            if($request->hasFile('profile_pic') != null)
            {
                $file= $request->file('profile_pic');
                $filename= time().$file->getClientOriginalName();
                $file-> move(public_path('storage/profile_pictures'), $filename);
                if(File::exists(public_path('storage/profile_pictures/'.$profile_update_find->profile_pic)))
                {
                    File::delete(public_path('storage/profile_pictures/'.$profile_update_find->profile_pic));
                    $profile_update_find->update([
                        'name' => $request->name ?? $profile_update_find->name,
                        'email' => $request->email ?? $profile_update_find->email,
                        'factory_name' => $request->factory_name ?? $profile_update_find->factory_name,
                        'profile_pic' => $filename
                    ]);
                    return response()->json([
                        'status' => 'success',
                        'message' =>  "Successfully Updated"
                    ], 201);
                }
                else
                {
                    $profile_update_find->update([
                        'name' => $request->name ?? $profile_update_find->name,
                        'email' => $request->email ?? $profile_update_find->email,
                        'factory_name' => $request->factory_name ?? $profile_update_find->factory_name,
                        'profile_pic' => $filename ?? $profile_update_find->profile_pic
                    ]);
                    return response()->json([
                        'status' => 'success',
                        'message' =>  "Successfully Updated"
                    ], 201);
                }
            }
            else
            {
                $profile_update_find->update([
                    'name' => $request->name ?? $profile_update_find->name,

                    'factory_name' => $request->factory_name ?? $profile_update_find->factory_name,
                    // 'profile_pic' => $filename
                ]);
                return response()->json([
                    "user" => $profile_update_find
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
}
