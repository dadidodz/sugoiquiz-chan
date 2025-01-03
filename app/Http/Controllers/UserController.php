<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::get();
        return $users;
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
        $faker = Faker::create();
        // Validation des données d'entrée
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
        ]);

        // Création d'un nouvel utilisateur
        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']), // Hachage du mot de passe
            'remember_token' => $faker->uuid, // Génération d'un token
        ]);

        // Retourner une réponse JSON
        return response()->json([
            'message' => 'User created successfully.',
            'user' => $user,
        ], 201);

//        try {
//            // Validation des données d'entrée
//            $validatedData = $request->validate([
//                'name' => 'required|string|max:255',
//                'email' => 'required|email|unique:users,email',
//                'password' => 'required|string|min:8',
//            ]);
//
//            // Création d'un nouvel utilisateur
//            $user = User::create([
//                'name' => $validatedData['name'],
//                'email' => $validatedData['email'],
//                'password' => Hash::make($validatedData['password']), // Hachage du mot de passe
//                'remember_token' => Str::random(10), // Génération d'un token
//            ]);
//
//            return response()->json([
//                'message' => 'User created successfully.',
//                'user' => $user,
//            ], 201);
//
//        } catch (\Illuminate\Validation\ValidationException $e) {
//            return response()->json([
//                'message' => 'Validation error.',
//                'errors' => $e->errors(),
//            ], 422); // Assurez-vous de renvoyer 422 ici
//        }


    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return response()->json($user);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        // Valider les données de la requête
        $request->validate([
            'name' => 'nullable|string|max:255',
            'email' => 'nullable|email|unique:users,email,' . $user->id,
//            'password' => 'nullable|min:8|confirmed',  // La confirmation doit être envoyée dans le champ 'password_confirmation'
        ]);

        // Mettre à jour les champs disponibles dans la requête
        if ($request->has('name')) {
            $user->name = $request->input('name');
        }

        if ($request->has('email')) {
            $user->email = $request->input('email');
        }

        if ($request->has('password')) {
            // Hash le nouveau mot de passe
            $user->password = Hash::make($request->input('password'));
        }

        // Sauvegarder les changements dans la base de données
        $user->save();

        // Retourner l'utilisateur mis à jour
        return response()->json($user);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Trouver l'utilisateur par ID
        $user = User::find($id);

        // Vérifier si l'utilisateur existe
        if (!$user) {
            return response()->json([
                'message' => 'User not found.',
            ], 404);
        }

        // Supprimer l'utilisateur
        $user->delete();

        // Retourner une réponse JSON de succès
        return response()->json([
            'message' => 'User deleted successfully.',
            'user_id' => $id,
        ], 200);
    }
}
