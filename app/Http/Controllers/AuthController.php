<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;
use App\Models\User;
use \stdClass;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $resquest){

        $validator = Validator::make($resquest->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }

        $user = User::create(
            [
                'name' => $resquest->get('name'),
                'email' => $resquest->get('email'),
                'password' => bcrypt($resquest->get('password')),
            ]
        );

        $token = $user->createToken('authToken')->plainTextToken;

        return response()->json([
            'data' => $user,
            'access_token' => $token,
            'token_type' => 'Bearer',
        ], 201);
    }

    public function login(Request $resquest){

        if(!Auth::attempt($resquest->only('email', 'password'))){
            return response()->json([
                'message' => 'No autorizado',
            ], 401);
        }

        $user = User::where('email', $resquest['email'])->firstOrFail();
        $token = $user->createToken('authToken')->plainTextToken;

        return response()->json([
            'message' => 'Hola ' . $user->name,
            'data' => $user,
            'access_token' => $token,
            'token_type' => 'Bearer',
            'user' => $user,
        ], 201);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Sesión cerrada',
        ], 201);
    }
}
