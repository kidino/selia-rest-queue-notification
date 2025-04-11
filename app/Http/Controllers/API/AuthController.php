<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'email' => 'required|string|email',
            'password' => 'required|string'
        ]);


        if($validate->fails()){
            return response()->json([
                'status' => 'failed',
                'message' => 'Validation Error!',
                'data' => $validate->errors(),
            ], 403);  
        }


        $data = [];


        // Check email exist
        $user = User::where('email', $request->email)->first();


        // Check password
        if(!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Invalid credentials'
                ], 401);
        }


        // generate the token
        $data['token'] = $user->createToken(
            $request->email, 
            $user->roles->pluck('name')->toArray()
            // ['Admin', 'Manager']
        )->plainTextToken;

        $data['user'] = $user;
       
        $response = [
            'status' => 'success',
            'message' => 'User is logged in successfully.',
            'data' => $data,
        ];

        return response()->json($response, 200);        
    }

    public function logout(Request $request)
    {
        $user = auth()->user();
        $user->tokens()->where('name', '!=', 'profile-token')->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'User is logged out successfully'
            ], 200);
    }
}
