<?php

namespace App\Http\Controllers;
use App\Models\Categorie;
use Illuminate\Http\Request;
use App\Services\PlanteService;

class PlanteController extends Controller
{
    protected $planteService;

    public function __construct(PlanteService $planteService)
    {
        $this->planteService = $planteService;
    }

    public function storePlante(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required',
            'description' => 'required',
            'prix' => 'required',
            'image' => 'required',
            'categories_id' => 'required|exists:categories,id',
        ]);

        $plante = $this->planteService->createPlante($validated);

        return response()->json([
            'status' => true,
            'message' => 'Plante créée avec succès',
            'plante' => $plante
        ], 201);
    }

    public function afficherPlantes($categorie_id)
    {
        $plantes = $this->planteService->getPlantesByCategorie($categorie_id);

        return response()->json(['plantes' => $plantes], 200);
    }

    public function afficherPlanteDetailles($slug)
    {
        $plante = $this->planteService->getPlanteDetails($slug);

        if (!$plante) {
            return response()->json(['message' => 'Plante non trouvée'], 404);
        }

        return response()->json(['plante' => $plante], 200);
    }

    public function modifierPlante(Request $request, $id)
    {
        $plante = $this->planteService->updatePlante($id, $request->all());

        return response()->json([
            'message' => 'Plante modifiée',
            'plante' => $plante
        ], 200);
    }

    public function supprimerPlante($id)
    {
        $this->planteService->deletePlante($id);

        return response()->json(['message' => 'Plante supprimée avec succès'], 200);
    }

}
