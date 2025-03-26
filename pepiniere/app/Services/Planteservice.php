<?php

namespace App\Services;

use App\DAO\PlanteInterface;

class PlanteService
{
    protected $planteRepository;

    public function __construct(PlanteInterface $planteRepository)
    {
        $this->planteRepository = $planteRepository;
    }

    public function createPlante($data)
    {
        return $this->planteRepository->create($data);
    }

    public function getPlantesByCategorie($categorie_id)
    {
        return $this->planteRepository->getAllByCategorie($categorie_id);
    }

    public function getPlanteDetails($slug)
    {
        return $this->planteRepository->getBySlug($slug);
    }

    public function updatePlante($id, $data)
    {
        return $this->planteRepository->update($id, $data);
    }

    public function deletePlante($id)
    {
        return $this->planteRepository->delete($id);
    }
}
