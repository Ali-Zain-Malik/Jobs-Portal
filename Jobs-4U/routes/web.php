<?php

use App\Http\Controllers\admin\AdminAuthController;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\JobsController;
use App\Http\Controllers\FeedbacksController;
use App\Http\Controllers\user\AuthController;
use App\Http\Controllers\user\CategoryController;
use App\Http\Controllers\user\HomeController;
use App\Http\Controllers\user\JobController;
use App\Http\Controllers\user\JobPostController;
use App\Http\Controllers\user\ProfileController;
use App\Http\Controllers\user\SearchController;
use App\Http\Controllers\user\UserController;
use App\Http\Controllers\admin\UsersManagementController;
use App\Http\Controllers\admin\SkillsController;
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
    Route::get("/categories/explore/{id}", [HomeController::class, "exploreCategory"])->name("explore_category");
    Route::post("/leave-feedback", [HomeController::class, "feedback"])->name("leave_a_feedback");
    Route::get("/signout", [AuthController::class, "signout"])->name("user.signout");
    Route::get("/all-categories", [CategoryController::class, "index"])->name("all-categories");
    Route::get("/search-jobs", [SearchController::class, "index"])->name("search-jobs");
    Route::get("/profile-page", [ProfileController::class, "index"])->name("user.profile");
    Route::get("/view-profile/{id}/{name?}", [ProfileController::class, "viewProfile"])->name("user.viewProfile");
    Route::get("/profile-pdf/{id}", [ProfileController::class, "downloadProfilePdf"])->name("profile.pdfDownload");

    Route::controller(JobController::class)->group(function()
    {
        Route::post("/toggle-favorite", "favorite")->name("toggleFavorite");
        Route::get("/favorite-jobs", "favoriteJobs")->name("user.favorites");
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
        Route::post("/applicant-details", "applicantDetails")->name("applicant.details");
        Route::get("/settings", "settingsView")->name("user.settings");
        Route::post("/settings/dob", "DOB")->name("user.DOB");
        Route::post("/settings/change-password", "changePassword")->name("user.changePassword");
    });

    Route::controller(JobPostController::class)->group(function()
    {
        Route::get("/job-create", "index")->name("job.create");
        Route::post("/job-post", "postJob")->name("job.post");
    });
});


Route::group(["prefix" => "admin"], function()
{
    Route::controller(AdminAuthController::class)->group(function()
    {
        Route::get("/signin", "index")->name("admin.signin");
        Route::post("/authenticate", "adminAuthenticate")->name("admin.authenticate");
        Route::get("/signout", "signOut")->name("admin.signout");
    });

    Route::controller(DashboardController::class)->group(function()
    {
        Route::get("/dashboard", "index")->name("admin.dashboard");
    });

    Route::controller(FeedbacksController::class)->group(function()
    {
        Route::get("/user-feedbacks", "index")->name("user.feedbacks");
        Route::put("/toggle-feedbackDisplay", "toggle")->name("feedbackDisplay.toggle");
        Route::post("/feedback-details", "viewDetails")->name("feedback.viewDetails");
        Route::get("/feedback-delete", "delete")->name("feedback.delete");
    });
    
    Route::controller(UsersManagementController::class)->group(function()
    {
        Route::get("/users-management", "index")->name("users.management");
        Route::get("/add-user-form", "addUserView")->name("userAdd.view");
        Route::post("/add-user", "add")->name("user.add");
        Route::get("/user-profile/{id}", "profile")->name("profile.view");
        Route::post("/user-edit/{id}", "editProfile")->name("profile.edit");
        Route::post("/remove-profile-photo/{id}", "removeProfilePhoto")->name("profile_photo.remove");
        Route::get("/user-experience/{id}", "getExperience")->name("get_experience");
        Route::post("/experience-edit/{id}", "editExperience")->name("edit_experience");
        Route::delete("/experience-delete/{id}", "deleteExperience")->name("deleteExperience");
        Route::get("/user-education/{id}", "getEducation")->name("get_education");
        Route::post("/education-edit/{id}", "editEducation")->name("edit_education");
        Route::post("/delete-education/{id}", "deleteEducation")->name("delete_education");
    });

    Route::controller(SkillsController::class)->group(function()
    {
        Route::get("/skill", "index")->name("skills");
        Route::post("/add-skill", "addSkill")->name("add_skill");
        Route::get("get-skill/{id}", "getSkill")->name("get_skill");
        Route::post("edit-skill/{id}", "editSkill")->name("edit_skill");
        Route::post("delete-skill/{id}", "deleteSkill")->name("delete_skill");
    });

    Route::controller(JobsController::class)->group(function()
    {
        Route::get("jobs","index")->name("jobs");
        Route::get("/job-details/{id}", "getJob")->name("get_job");
        Route::post("toggle-approve/{id}", "toggleApprove")->name("toggle_approve");
        Route::post("/toggle-feature/{id}", "toggleFeature")->name("toggle_feature");
        Route::post("/delete-job/{id}", "deleteJob")->name("delete_job");
        Route::get("/categories", "getCategories")->name("categories");
        Route::get("/get-category/{id}", "getCategory")->name("get_category");
        Route::post("/edit-category/{id}", "editCategory")->name("edit_category");
        Route::post("/add-category", "addCategory")->name("add_category");
        Route::post("/delete-category/{id}", "deleteCategory")->name("delete_category");
    });

    Route::post("/change-password", [UserController::class, "adminPasswordChange"])->name("admin.change_password");
});