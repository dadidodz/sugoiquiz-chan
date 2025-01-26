<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

// Nécessaire pour Auth::attempt et Auth::user



class UserController extends Controller
{
    use AuthorizesRequests;
    // Liste des utilisateurs
    public function index()
    {
        return User::paginate(10); // Retourne 10 utilisateurs par page
    }

    // Afficher un utilisateur
    public function show(User $user)
    {
        return response()->json($user);
    }

    // Ajouter un utilisateur
    public function store(StoreUserRequest $request)
    {
        try {
            $validatedData = $request->validated();

            $user = User::create([
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
                'password' => Hash::make($validatedData['password']),
                'is_admin' => $validatedData['is_admin'] ?? false,
            ]);

            return response()->json([
                'message' => 'Utilisateur ajouté avec succès.',
                'user' => $user,
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Erreur lors de l\'ajout de l\'utilisateur.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    // Modifier un utilisateur
    public function update(UpdateUserRequest $request, User $user)
    {

        $validatedData = $request->validated();

        if (isset($validatedData['password'])) {
            $validatedData['password'] = Hash::make($validatedData['password']);
        }

        $user->update($validatedData);

        return response()->json([
            'message' => 'Utilisateur mis à jour avec succès.',
            'user' => $user,
        ]);
    }

    // Supprimer un utilisateur
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return response()->json([
            'message' => 'Utilisateur supprimé avec succès.',
        ]);
    }

    // Authentification
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:8',
        ]);

        // Vérifie les identifiants
        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json(['message' => 'Identifiants incorrects.'], 401);
        }

        // Récupère l'utilisateur authentifié
        $user = Auth::user();

        // Génère un token Passport
        $token = $user->createToken('authToken')->accessToken;

        return response()->json([
            'token' => $token,
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'is_admin' => $user->is_admin,
            ],
        ]);
    }

}
