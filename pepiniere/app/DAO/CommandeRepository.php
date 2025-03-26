<?php

namespace App\DAO;

use App\Models\Commande;

class CommandeRepository implements CommandeInterface
{
    public function createCommande(array $data ,$slug)
    {
        return Commande::create($data,$slug);
    }
    public function verifier(array $data ,$id)
    {
        return Commande::find($id);
    }
}
