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
              'message' => 'Plante cree avec succes',
              
          ], 201);
    }
    public function afficherPlantes($categorie_id){
        $plantes = Plante::where('categories_id', $categorie_id)->get();
        return response()->json([
            'plante'=>$plantes
        ], 200);
    }

    public function afficherPlanteDetailles($slug){
        $plante = Plante::where('slug', $slug)->get();
        return response()->json([
            'nom'=>$plante
        ], 200);
    }


    public function modifierPlante(Request $request, $id)
    {
        $plante = Plante::find($id);
        $plante->update([
            'nom' => $request->nom ?? $plante->nom,
            'description' => $request->description ?? $plante->description,
            'image' => $request->image ?? $plante->image,
            'prix' => $request->prix ?? $plante->prix,

        ]);
        return response()->json([
            'message' => 'plante modifié',
            'reservation' => $plante
        ], 200);
    }
    public function supprimerPlante($id)
        {
            $plante = Plante::find($id);
            $plante->delete();
            return response()->json([
                'message' => 'plante supprime avec succes'
            ], 200);
        }

}
