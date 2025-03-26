<?php
namespace App\DAO;


interface CommandeInterface
{
    public function createCommande(array $data ,$slug);
    public function verifier($commande_id ,$id);
    public function annulerCommande($commande_id);
    public function changerstatus($data,$commande_id);


}
