<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\user\Category;
use Illuminate\Http\Request;

class categoryController extends Controller
{
    public function getCategories()
    {
        $categories =   Category::where("is_active", 1)->inRandomOrder()->limit(8)->get();
        if($categories)
        {
            return view("user.includes.categories_card", ["categories" => $categories]);
        }
    }
}
