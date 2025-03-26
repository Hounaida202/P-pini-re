<?php

namespace App\DAO;

use App\Models\Commande;

class CommandeRepository implements CommandeInterface
{
    public function createCommande(array $data)
    {
        return Commande::create($data);
    }
}
