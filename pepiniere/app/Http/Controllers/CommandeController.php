<?php

namespace App\Http\Controllers;

use App\DAO\CommandeInterface;
use App\Models\Plante;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class CommandeController extends Controller
{
    
    protected $commandeRepository;

    public function __construct(CommandeInterface $commandeRepository)
    {
        $this->commandeRepository = $commandeRepository;
    }

    public function AjouterCommande(Request $request, $slug)
    {
        $users_id = Auth::id();
        $plante = Plante::where('slug', $slug)->firstOrFail();

        $data = [
            'quantity' => $request->quantity,
            'plantes_id' => $plante->id,
            'users_id' => $users_id
        ];

        $commande = $this->commandeRepository->createCommande($data);

        return response()->json([
            'message' => 'Commande ajoutée avec succès',
            'commande' => $commande
        ], 201);
    }
}
