<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\AnimeController;
use App\Http\Controllers\MusicController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;

//Route::get('/user', function (Request $request) {
//    return $request->user();
//});
//
//Route::middleware('auth:api')->get('/start-quiz', function () {
//    return "Voici la question";
//});

//Route::middleware('auth:api')->ApiResource('/usersapi', UserController::class);

//Route::ApiResource('/users', UserController::class);

//Route::get('start-quizz', function(){
//    return "Voici la question";
//});

//Route::post('/users/create', [UserController::class, 'store'])->withoutMiddleware([\App\Http\Middleware\IsAdmin::class]);
route::post('/login', [UserController::class, 'login'])->withoutMiddleware(['auth:api', 'isAdmin']);

// La route POST pour créer un utilisateur (sans authentification)
Route::apiResource('/users/create', UserController::class)->only(['store'])->withoutMiddleware(['auth:api', 'isAdmin']);

// Routes GET protégées par les middlewares auth:api et is_admin
Route::middleware(['auth:api', 'isAdmin'])->group(function () {
    Route::get('/users', [UserController::class, 'index']);        // Liste des utilisateurs
    Route::get('/users/{user}', [UserController::class, 'show']); // Afficher un utilisateur
    Route::post('/users', [UserController::class, 'store']);      // Ajouter un utilisateur
    Route::patch('/users/{user}', [UserController::class, 'update']); // Modifier un utilisateur
    Route::delete('/users/{id}', [UserController::class, 'destroy']); // Supprimer un utilisateur
});


//Route::middleware(['auth:api', 'isAdmin'])->group(function () {
//    Route::patch('/users/{user}', [UserController::class, 'update']);
//});

//Route::middleware(['auth:api', 'isAdmin'])->group(function () {
//    Route::delete('/users/{id}', [UserController::class, 'destroy']);
//});


// Routes GET protégées par les middlewares auth:api et is_admin
Route::middleware(['auth:api', 'isAdmin'])->group(function () {
//    Route::get('/animes', [AnimeController::class, 'index']);
//    Route::get('/animes/{anime}', [AnimeController::class, 'show']);
//    Route::post('/animes', [AnimeController::class, 'store']);
//    Route::patch('/animes/{animes}', [AnimeController::class, 'update']);
//    Route::delete('/animes/{id}', [AnimeController::class, 'destroy']);
    Route::ApiResource('animes', AnimeController::class);
});

//Route::middleware(['auth:api', 'isAdmin'])->group(function () {
//    Route::patch('/animes/{animes}', [AnimeController::class, 'update']);
//});

Route::middleware(['auth:api', 'isAdmin'])->group(function () {
    Route::get('/musics', [MusicController::class, 'index']);
    Route::get('/musics/{music}', [MusicController::class, 'show']);
    Route::patch('/musics/{music}', [MusicController::class, 'update']);
});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
