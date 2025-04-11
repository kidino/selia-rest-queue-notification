<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function index() {
        $user = User::paginate(10);

        return response()->json([
            'status' => 'success',
            'data' => $user
        ]);
    }

    public function show( $id ) {
        $user = User::find($id);
        if (!$user) {
            return response()->json([
                'status' => 'error',
                'message' => 'User not found'
            ], 404);
        }

        $user->load(['roles:id,name']);

        echo $user;
    }
}
