<?php
namespace app\DAO;

interface PlanteInterface
{
    public function getAllByCategorie($categorie_id);

    public function getBySlug($slug);

    public function findById($id);

    public function create(array $data);

    public function update($id, array $data);

    public function delete($id);

}