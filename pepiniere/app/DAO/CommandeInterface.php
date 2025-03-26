<?php
namespace app\DAO;

interface CommandeInterface
{
    public function createCommande(array $data, $plante_id , $id);

}