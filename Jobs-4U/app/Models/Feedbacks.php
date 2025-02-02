<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedbacks extends Model
{
    use HasFactory;
    protected $guarded  =   [];
    public $timestamps  =   false;

    public static function getFeedbacks()
    {
        return self::join("users", "users.id", "=", "feedbacks.user_id")
                    ->leftJoin("cities", "cities.id", "=", "users.city_id")
                    ->select("feedbacks.*", "users.name as user_name", "users.profile_pic", "cities.city_name")
                    ->get();
    }
}
