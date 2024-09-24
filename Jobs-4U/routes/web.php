<?php

use App\Http\Controllers\user\AuthController;
use App\Http\Middleware\userRedirect;
use Illuminate\Support\Facades\Route;


Route::group(["middleware"=> userRedirect::class], function()
{
    Route::get("/signup", [AuthController::class, "index"])->name("user.signup");
    Route::get("/signin", [AuthController::class, "signin"])->name("user.signin");
    Route::post("/authenticate", [AuthController::class, "authenticate"])->name("user.authenticate");
    Route::post("/create-account", [AuthController::class, "createAccount"])->name("user.createAccount");
});




Route::get("/home", function(){return view("user.home");})->name("user.home");
Route::get("/signout", [AuthController::class, "signout"])->name("user.signout");