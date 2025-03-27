<?php
namespace App\DAO;
use App\Models\Plante;
use App\DAO\PlanteInterface;
use Illuminate\Support\Facades\DB;

class PlanteRepository implements PlanteInterface
{
    public function getAllByCategorie($categorie_id)
    {
        return Plante::where('categories_id', $categorie_id)->get();
    }

    public function getBySlug($slug)
    {
        return Plante::where('slug', $slug)->first();
    }

    public function findById($id)
    {
        return Plante::findOrFail($id);
    }

    public function create(array $data)
    {
        return Plante::create($data);
    }

    public function update($id, array $data)
    {
        $plante = Plante::findOrFail($id);
        $plante->update($data);
        return $plante;
    }

    public function delete($id)
    {
        $plante = Plante::findOrFail($id);
        return $plante->delete();
    }
   
    
}
