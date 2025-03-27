<?php

namespace App\Http\Controllers;

use App\DAO\CommandeInterface;
use App\Models\Plante;
use App\Models\Commande;

use App\DAO\CommandeRepository;
use Illuminate\Auth\Events\Validated;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class CommandeController extends Controller
{
    
    protected $commandeRepository;

    public function __construct(CommandeInterface $commandeRepository)
    {
        $this->commandeRepository = $commandeRepository;
    }

    public function AjouterCommande(Request $request, $slug )
    {
        $users_id = Auth::id();
        $plante = Plante::where('slug', $slug)->firstOrFail();

        if (!$plante) {
            return response()->json(['message' => 'Plante non trouvée'], 404);
        }

        $data = [
            'quantity' => $request->quantity,
            'palntes_id' => $plante->id,
            'users_id' => $users_id
        ];

        $commande = $this->commandeRepository->createCommande($data,$slug);
        return response()->json([
            'message' => 'Commande ajoutée avec succès',
            'commande' => $commande
        ], 201);
    }

    // -------verifie le status de la commande-----------

    public function verifierr($commande_id){
        $id=Auth::id();


         $commande=$this->commandeRepository->verifier($commande_id,$id);
            if(!$commande){
            return response()->json([
            'message'=>'element non trouvé'
            ],404);
          }
            return response()->json([
                'message'=>'le status est bien reccuperé',
                'status'=>$commande->status
            ],200);
    }

     // -------annuler une commande de status en attente-----------
     public function annuler($commande_id)
{
    $id = Auth::id();
    $commande = $this->commandeRepository->verifier($commande_id, $id);
    if (!$commande) {
        return response()->json([
            'message' => 'element non trouvé'
        ], 404);
    }
    if ($commande->status !== 'en attente') {
        return response()->json([
            'message' => 'la commande est deja preparée pour la livraison'
        ]);
    }
    $this->commandeRepository->annulerCommande($commande_id);
    return response()->json([
        'message' => 'la commande est annulée'
    ], 200);
}

// ------------changer le status de la commande-------
public function ChangerStatus(Request $request, $commande_id)
{
    $request->validate([
        'status' => 'required|string'
    ]);
    $commande = $this->commandeRepository->changerStatus($commande_id, ['status' => $request->status]);
    if (!$commande) {
        return response()->json([
            'message' => 'Commande non trouvée'
        ], 404);
    }
    return response()->json([
        'message' => 'Statut de la commande changé avec succès',
        'commande' => $commande
    ], 200);

}
// ------------count les commandes-------
       
public function countVentes(){
    $ventes=$this->commandeRepository->countVentes();

    return response()->json([
        'nombre des ventes est'=>$ventes
        ]);

    }
}
