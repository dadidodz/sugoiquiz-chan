<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\AnimeController;
use App\Http\Controllers\MusicController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//Route::post('/users/create', [UserController::class, 'store'])->withoutMiddleware([\App\Http\Middleware\IsAdmin::class]);
route::post('/login', [UserController::class, 'login'])->withoutMiddleware(['auth:api', 'isAdmin']);

// La route POST pour créer un utilisateur (sans authentification)
Route::apiResource('/users/create', UserController::class)->only(['store'])->withoutMiddleware(['auth:api', 'isAdmin']);

// La route GET pour la recherche d'animes dans la library
Route::get('/animes/search', [AnimeController::class, 'search'])->withoutMiddleware(['auth:api', 'isAdmin']);;


// Routes GET protégées par les middlewares auth:api et is_admin
Route::middleware(['auth:api', 'isAdmin'])->group(function () {
    Route::get('/users', [UserController::class, 'index']);        // Liste des utilisateurs
    Route::get('/users/{user}', [UserController::class, 'show']); // Afficher un utilisateur
    Route::post('/users', [UserController::class, 'store']);      // Ajouter un utilisateur
    Route::patch('/users/{user}', [UserController::class, 'update']); // Modifier un utilisateur
    Route::delete('/users/{id}', [UserController::class, 'destroy']); // Supprimer un utilisateur
});

// Routes GET protégées par les middlewares auth:api et is_admin
Route::middleware(['auth:api', 'isAdmin'])->group(function () {
    Route::ApiResource('animes', AnimeController::class);
});

Route::middleware(['auth:api', 'isAdmin'])->group(function () {
    Route::get('/musics', [MusicController::class, 'index']);
    Route::get('/musics/{music}', [MusicController::class, 'show']);
    Route::patch('/musics/{music}', [MusicController::class, 'update']);
});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
