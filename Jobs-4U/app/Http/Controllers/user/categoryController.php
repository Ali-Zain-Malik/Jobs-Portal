<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\user\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories         = Category::where('is_active', 1)
                            ->withCount(['jobs' => function($query) 
                            {
                                $query->where('is_approved', 1)
                                    ->where('is_featured', 1)
                                    ->where('expiry_date', '>=', date('Y-m-d'));
                            }])
                            ->inRandomOrder()
                            ->get();
        return view("user.all_categories", compact("categories"));
    }
}
