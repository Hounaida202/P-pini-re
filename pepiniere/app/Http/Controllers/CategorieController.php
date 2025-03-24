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
}
