<?php

namespace App\DAO;

use App\Models\Commande;

class CommandeRepository implements CommandeInterface
{
    public function createCommande(array $data ,$slug)
    {
        return Commande::create($data,$slug);
    }
    public function verifier($commande_id,$id)
    {
        return Commande::where('id',$commande_id)->where('users_id',$id)->first();
    }
    public function annulerCommande($commande_id)
    {
        $commande = Commande::find($commande_id);
        if ($commande) {
            $commande->delete();
        }
        return $commande;
    }
    public function changerStatus($commande_id, $data)
    {
       
    }
    
}
