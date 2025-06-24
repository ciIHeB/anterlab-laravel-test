<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/api/users', function () {
    return response()->json(\App\Models\User::all());
});

Route::get('/users', [UserController::class, 'index']);
