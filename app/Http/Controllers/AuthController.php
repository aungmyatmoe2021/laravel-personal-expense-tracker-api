<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\LoginRequest;
use App\Http\Requests\User\RegisterRequest;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    public function register(RegisterRequest $request){
        try{
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ]);
            $token = $user->createToken('tracker_api_token')->plainTextToken;
            return response()->json([
                "message" => "User registered successfully",
                "token" => $token
            ],201);
        }catch(Exception $e){
            Log::error("User Register Error Section : ".$e->getMessage());
            return response()->json([
                "message" => "Internal Server Error"
            ],500);
        }
    }

    public function login(LoginRequest $request){
        try{
            $user = User::where('email',$request->email)->first();
            if(!$user){
                return response()->json([
                    "message" => "Email not found"
                ],404);
            }
            if(!Hash::check($request->password, $user->password)){
                return response()->json([
                    "message" => "Password incorrect"
                ],404);
            }
            $token = $user->createToken('tracker_api_token')->plainTextToken;
            return response()->json([
                "message" => "User logged in successfully",
                "token" => $token
            ],200);
        }catch(Exception $e){
            Log::error("User Register Error Section : ".$e->getMessage());
            return response()->json([
                "message" => "Internal Server Error"
            ],500);
        }
    }

    public function logout(){
        try{
            $user = Auth::user();
            $user->currentAccessToken()->delete();
            return response()->json([
                "message" => "User logged out successfully"
            ],200);
        }catch(Exception $e){
            Log::error("User Register Error Section : ".$e->getMessage());
            return response()->json([
                "message" => "Internal Server Error"
            ],500);
        }
    }

    public function profile(){
        try{
            $user = Auth::user();
            return response()->json([
                "message" => "User found",
                "data" => $user
            ],200);
        }catch(Exception $e){
            Log::error("User Register Error Section : ".$e->getMessage());
            return response()->json([
                "message" => "Internal Server Error"
            ],500);
        }
    }
}
