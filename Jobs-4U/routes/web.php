<?php

use App\Http\Controllers\user\AuthController;
use Illuminate\Support\Facades\Route;


Route::get("/signup", [AuthController::class, "index"])->name("user.signup");
Route::post("/create-account", [AuthController::class, "createAccount"])->name("user.createAccount");


Route::get("/sigin", [AuthController::class, "signin"])->name("user.signin");
