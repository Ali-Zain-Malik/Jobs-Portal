<?php

use App\Http\Controllers\user\AuthController;
use Illuminate\Support\Facades\Route;


Route::get("/signup", [AuthController::class, "index"])->name("user.signup");
Route::post("/create-account", [AuthController::class, "createAccount"])->name("user.createAccount");


Route::get("/signin", [AuthController::class, "signin"])->name("user.signin");
Route::post("/authenticate", [AuthController::class, "authenticate"])->name("user.authenticate");


Route::get("/home", function(){return view("user.home");})->name("user.home");