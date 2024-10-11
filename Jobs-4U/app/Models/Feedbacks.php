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
                    ->select("feedbacks.*", "users.name as user_name")
                    ->get();
    }
}
