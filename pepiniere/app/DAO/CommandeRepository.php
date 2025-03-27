<?php

namespace App\DAO;

use App\Models\Commande;
use Illuminate\Support\Facades\DB;

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
        $commande = Commande::find($commande_id);
        if (!$commande) {
            return null;
            }
            $commande->update($data);
            return $commande;
    }
    public function countVentes()
    {
        $ventes=DB::table('commandes')->count();
        return $ventes;
    }
    public function countplantes()
    {
        
    }
    
}
