<?php

namespace App\Http\Controllers;

use App\Models\Anime;
use Illuminate\Http\Request;

class AnimeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $animes = Anime::get();
        return $animes;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Anime $anime)
    {
        return response()->json($anime);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Liste des champs autorisés pour la mise à jour (basée sur le modèle)
        $fillable = (new Anime)->getFillable();

        // Vérification des champs de la requête, s'il y a des champs non autorisés
        $invalidFields = array_diff(array_keys($request->all()), $fillable);

        if (!empty($invalidFields)) {
            return response()->json([
                'error' => 'Invalid fields: ' . implode(', ', $invalidFields)
            ], 400);
        }

        // Valider les données de la requête
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|string',
            'release_date' => 'nullable|date',
            'details' => 'nullable|string',
        ]);

        // Trouver l'anime par son ID
        $anime = Anime::find($id);

        if (!$anime) {
            return response()->json(['error' => 'Anime not found'], 404);
        }

        // Mettre à jour les attributs de l'anime avec les données validées
        $anime->update($validated);

        // Retourner la réponse après la mise à jour
        return response()->json([
            'message' => 'Anime updated successfully',
            'anime' => $anime
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Trouver l'utilisateur par ID
        $anime = Anime::find($id);

        // Vérifier si l'utilisateur existe
        if (!$anime) {
            return response()->json([
                'message' => 'Anime not found.',
            ], 404);
        }

        // Supprimer l'utilisateur
        $anime->delete();

        // Retourner une réponse JSON de succès
        return response()->json([
            'message' => 'Anime deleted successfully.',
            'anime_id' => $id,
        ], 200);
    }
}
