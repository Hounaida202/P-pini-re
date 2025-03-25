<?php

namespace App\Http\Controllers;

use App\Models\Commande;
use App\Models\Plante;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class CommandeController extends Controller
{
    public function AjouterCommande(Request $request , $slug){
        $users_id=Auth::user()->id;
        $plante = Plante::where('slug', $slug)->first();


        $commande=Commande::create([
         'quantity'=>$request->quantity,
         'palntes_id'=>$plante->id,
         'users_id'=>$users_id

        ]);
        return response()->json([
            'message' => 'Commande ajoute avec succes',
            'commande' => $commande
        ], 201);

    }
}
