<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateMusicRequest;
use App\Models\Music;
use Illuminate\Http\Request;

class MusicController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $music = Music::get();
        return $music;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
    public function show(Music $music)
    {
        return response()->json($music);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Music $music)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMusicRequest $request, $id)
    {
        // Liste des champs autorisés pour la mise à jour (basée sur le modèle)
        $fillable = (new Music)->getFillable();

        // Vérification des champs de la requête, s'il y a des champs non autorisés
        $invalidFields = array_diff(array_keys($request->all()), $fillable);

        if (!empty($invalidFields)) {
            return response()->json([
                'error' => 'Invalid fields: ' . implode(', ', $invalidFields)
            ], 400);
        }

        // Validation des données entrantes
        $validatedData = $request->validated();

        // Récupération de la musique par son ID
        $music = Music::find($id);

        if (!$music) {
            return response()->json(['error' => 'Music not found'], 404);
        }

        $music->update($validatedData);

        // Sauvegarde des modifications
        $music->save();

        // Retourne une réponse de succès
        return response()->json([
            'message' => 'Music updated successfully',
            'music' => $music,
        ]);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Trouver l'utilisateur par ID
        $music = Music::find($id);

        // Vérifier si l'utilisateur existe
        if (!$music) {
            return response()->json([
                'message' => 'Anime not found.',
            ], 404);
        }

        // Supprimer l'utilisateur
        $music->delete();

        // Retourner une réponse JSON de succès
        return response()->json([
            'message' => 'Music deleted successfully.',
            'music_id' => $id,
        ], 200);
    }
}
