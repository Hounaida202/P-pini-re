<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use Illuminate\Http\Request;

class CategorieController extends Controller
{
    public function store(Request $request){
        $validé=$request->validate([
          'nom'=>'required',

        ]);

        if(!$validé){
            return response()->json([
             'message'=>'invalide ce nom',
            ]);
        }

        Categorie::create([
          'nom'=>$validé['nom'],
        ]);
        return response()->json([
            'status' => true,
            'message' => 'categorie Created Successfully',
            
        ], 201);
    }

    public function afficherCategorie(){
        $categories = Categorie::all(); 
        return response()->json([
            'categorie'=>$categories
            
        ], 200);
    }


    public function modifierCategorie(Request $request, $id)
    {
        $categorie = Categorie::find($id);
        $categorie->update([
            'nom' => $request->nom ?? $categorie->date,
        ]);
        return response()->json([
            'message' => 'categorie mise à jour avec succès',
            'reservation' => $categorie
        ], 200);
    }

    public function supprimerCategorie($id)
        {
            $categorie = Categorie::find($id);
            $categorie->delete();
            return response()->json([
                'message' => 'categorie supprimée avec succès'
            ], 200);
        }
}
