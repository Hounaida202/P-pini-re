<?php
namespace App\DAO;


interface CommandeInterface
{
    public function createCommande(array $data ,$slug);
    public function verifier($commande_id ,$id);
    public function ChangerStatus($commande,$commande_id,$id);
}
