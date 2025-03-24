<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use Illuminate\Http\Request;
use App\Models\Plante;

class PlanteController extends Controller
{
    public function storePlante(Request $request){
        $validé=$request->validate([
            'nom'=>'required',
            'description'=>'required',
            'prix'=>'required',
            'image'=>'required',
            'categories_id' => 'required|exists:categories,id',

        ]);

        if(!$validé){
            return response()->json([
             'message'=>'invalide cette plante',
            ]);
        }
        $categorie_id = Categorie::findOrFail($validé['categories_id']);
        $plante=Plante::create([
            'nom'=>$validé['nom'],
            'description'=>$validé['description'],
            'image'=>$validé['image'],
            'prix'=>$validé['prix'],
            'categories_id' => $validé['categories_id'], 

          ]);
        //   $categorie_id->plantes()->save($plante);
          return response()->json([
              'status' => true,
              'message' => 'Plante Created Successfully',
              
          ], 201);
    }
    public function afficherPlantes($categorie_id){
        $plantes = Plante::where('categories_id', $categorie_id)->get();
        return response()->json([
            'categorie'=>$plantes
        ], 200);
    }

}
