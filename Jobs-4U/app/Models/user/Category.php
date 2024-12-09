<?php

namespace App\Models\user;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function jobs()
    {
        return $this->hasMany(Job::class);
    }

    public $timestamps = false;
    protected $guarded = [];
    use HasFactory;

    public function delete()
    {
        Job::where("category_id", $this->id)->update(["category_id" => NULL]);
        parent::delete();
    }
}
