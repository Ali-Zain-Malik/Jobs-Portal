<?php

namespace App\Models\user;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User_skill extends Model
{
    public $timestamps  =   false;
    protected $fillable =   [
        "user_id",
        "skill_id"
    ];
    use HasFactory;
}
