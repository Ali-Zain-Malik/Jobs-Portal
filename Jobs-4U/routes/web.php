<?php

use App\Http\Controllers\user\AuthController;
use App\Http\Controllers\user\CategoryController;
use App\Http\Controllers\user\HomeController;
use App\Http\Controllers\user\JobController;
use App\Http\Controllers\user\SearchController;
use App\Http\Middleware\userRedirect;
use Illuminate\Support\Facades\Route;


Route::group(["middleware"=> userRedirect::class], function()
{
    Route::get("/signup", [AuthController::class, "index"])->name("user.signup");
    Route::get("/signin", [AuthController::class, "signin"])->name("user.signin");
    Route::post("/authenticate", [AuthController::class, "authenticate"])->name("user.authenticate");
    Route::post("/create-account", [AuthController::class, "createAccount"])->name("user.createAccount");
});




Route::get("/home", [HomeController::class, "index"])->name("user.home");
Route::get("/signout", [AuthController::class, "signout"])->name("user.signout");
Route::post("/toggle-favorite", [JobController::class, "favorite"])->name("toggleFavorite");
Route::get("/all-categories", [CategoryController::class, "index"])->name("all-categories");
Route::get("/search", [SearchController::class, "index"])->name("search-jobs");
Route::get("/favorite-jobs", [JobController::class, "index"])->name("user.favorites");