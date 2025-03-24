<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller

{

    public function __construct(){
        $this->middleware('auth:api',['except'=>['login','register']]);
    }
    

    public function register(Request $request)
    {
        // $Validator=Validator::make($request->all(), [
        //     'name' => 'required|string|max:255',
        //     'email' => 'required|email|unique:users,email',
        //     'password' => 'required|min:6|confirmed'
        // ]);  

        
        // $user = User::create([
        //     'name' => $request->name,
        //     'email' => $request->email,
        //     'password' => Hash::make($request->password),
        // ]);

        // return response()->json([
        //     'status' => true,
        //     'message' => 'Utilisateur créé avec succès',
        // ], 201);


    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:6',
    ]);
    
    $user = User::create([
                'name' => $request['name'],
                'email' => $request['email'],
                'password' => Hash::make($request['password']),
            ]);

            $token = JWTAuth::fromUser($user);

            return response()->json([
                'status' => true,
                'message' => 'User Created Successfully',
                'token' => $token,
            ], 201);
    }

     public function login(Request $request)
    {
        $user = $request->only('email', 'password');

        if (!$token = Auth::attempt($user)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return response()->json([
            'token' => $token,
            'user'=> $user
    
    ],200);
    }

    

    public function logout()
    {
        Auth::logout();
        return response()->json(['message' => 'Déconnexion réussie']);
    }

    public function me()
    {
        return response()->json(Auth::user());
    }
   
}
