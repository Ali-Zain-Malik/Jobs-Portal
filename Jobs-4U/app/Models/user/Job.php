<?php

namespace App\Models\user;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    protected $guarded      =   [];
    public $timestamps      =   false;
    use HasFactory;
}
