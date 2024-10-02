<?php

use App\Http\Controllers\user\AuthController;
use App\Http\Controllers\user\CategoryController;
use App\Http\Controllers\user\HomeController;
use App\Http\Controllers\user\JobController;
use App\Http\Controllers\user\JobPostController;
use App\Http\Controllers\user\ProfileController;
use App\Http\Controllers\user\SearchController;
use App\Http\Controllers\user\UserController;
use App\Http\Middleware\user\Authenticate;
use Illuminate\Support\Facades\Route;

// Using Laravel default guest middleware
Route::middleware(["guest"])->group(function()
{
    Route::get("/signup", [AuthController::class, "index"])->name("user.signup");
    Route::get("/signin", [AuthController::class, "signin"])->name("user.signin");
});
Route::post("/authenticate", [AuthController::class, "authenticate"])->name("user.authenticate");
Route::post("/create-account", [AuthController::class, "createAccount"])->name("user.createAccount");

Route::middleware([Authenticate::class])->group(function()
{
    Route::get("/home", [HomeController::class, "index"])->name("user.home");
    Route::get("/signout", [AuthController::class, "signout"])->name("user.signout");
    Route::get("/all-categories", [CategoryController::class, "index"])->name("all-categories");
    Route::get("/search-jobs", [SearchController::class, "index"])->name("search-jobs");
    Route::get("/profile-page", [ProfileController::class, "index"])->name("user.profile");

    Route::controller(JobController::class)->group(function()
    {
        Route::post("/toggle-favorite", "favorite")->name("toggleFavorite");
        Route::get("/favorite-jobs", "index")->name("user.favorites");
        Route::post("/view-job", "viewJob")->name("viewJob");
        Route::post("/apply-job", "applyJob")->name("applyJob");
    });

    Route::controller(UserController::class)->group(function()
    {
        Route::post("/profile/change-profile-pic", "changeProfilePic")->name("user.changeProfilePic");
        Route::post("/profile/change-name", "changeName")->name("user.changeName");
        Route::post("/profile/update-description", "updateDescription")->name("user.updateDescription");
        Route::post("/profile/update-skills", "updateSkills")->name("user.updateSkills");
        Route::post("/profile/add-experience", "addExperience")->name("user.addExperience");
        Route::post("/profile/add-education", "addEducation")->name("user.addEducation");
        Route::post("/profile/delete-experience", "deleteExperience")->name("user.deleteExperience");
        Route::post("/profile/delete-education", "deleteEducation")->name("user.deleteEducation");
        Route::get("/user/change-role", "changeRole")->name("user.changeRole");
        Route::get("/my-posts", "myPosts")->name("user.myPosts");
        Route::post("/my-post/delete", "deletePost")->name("user.deletePost");
        Route::get("/applicant-requests", "applicantRequests")->name("job.applicantRequests");
    });

    Route::controller(JobPostController::class)->group(function()
    {
        Route::get("/job-create", "index")->name("job.create");
        Route::post("/job-post", "postJob")->name("job.post");
    });

});