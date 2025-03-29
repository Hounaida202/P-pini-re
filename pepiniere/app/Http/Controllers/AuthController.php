<?php

namespace App\Http\Controllers;

/**
 * @OA\Info(
 *      title="API de Gestion des Catégories",
 *      version="1.0",
 *      description="Documentation de l'API pour la gestion des catégories",
 *      @OA\Contact(
 *          email="support@example.com"
 *      )
 * )
 */



use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;



/**
 * @OA\Info(
 *      title="API de Gestion des Catégories",
 *      version="1.0",
 *      description="Documentation de l'API"
 * )
 */

/**
 * @OA\Post(
 *     path="/api/categories",
 *     summary="Créer une nouvelle catégorie",
 *     tags={"Catégories"},
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"nom"},
 *             @OA\Property(property="nom", type="string", example="Fruits")
 *         )
 *     ),
 *     @OA\Response(
 *         response=201,
 *         description="Catégorie créée avec succès"
 *     ),
 *     @OA\Response(
 *         response=400,
 *         description="Données invalides"
 *     )
 * )
 */

class AuthController extends Controller

{
    public function register(Request $request)
    {

    $request->validate([
        'nom' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:6',
        'role' => 'required',
    ]);
    
    $user = User::create([
                'nom' => $request['nom'],
                'email' => $request['email'],
                'password' => Hash::make($request['password']),
                'role' => $request['role'],

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
