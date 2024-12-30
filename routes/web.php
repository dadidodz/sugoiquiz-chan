<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/connection', function () {
    return view('testing-views.connection');
});

Route::get('/connected', function () {
    return view('testing-views.connected');
});
