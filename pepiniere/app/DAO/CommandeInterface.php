<?php
namespace App\DAO;


interface CommandeInterface
{
    public function createCommande(array $data ,$slug);
    public function verifier(array $data ,$id);

}
