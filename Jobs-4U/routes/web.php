<?php

use App\Http\Controllers\user\AuthController;
use App\Http\Controllers\user\CategoryController;
use App\Http\Controllers\user\HomeController;
use App\Http\Controllers\user\JobController;
use App\Http\Controllers\user\SearchController;
use App\Http\Controllers\user\UserController;
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
Route::get("/search-jobs", [SearchController::class, "index"])->name("search-jobs");
Route::get("/favorite-jobs", [JobController::class, "index"])->name("user.favorites");
Route::post("/view-job", [JobController::class, "viewJob"])->name("viewJob");
Route::post("/apply-job", [JobController::class, "applyJob"])->name("applyJob");
Route::get("/profile-page", [UserController::class, "index"])->name("user.profile");
Route::post("/profile/change-profile-pic", [UserController::class, "changeProfilePic"])->name("user.changeProfilePic");
Route::post("/proifle/change-name", [UserController::class, "changeName"])->name("user.changeName");
Route::post("/proifle/update-description", [UserController::class, "updateDescription"])->name("user.updateDescription");
Route::post("/proifle/update-skills", [UserController::class, "updateSkills"])->name("user.updateSkills");