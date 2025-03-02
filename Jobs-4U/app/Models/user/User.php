<?php

namespace App\Models\user;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Models\Feedbacks;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [];


    public function jobs()
    {
        return $this->hasMany(Job::class);
    }

    public $timestamps =   false;

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Get city
     * @return string
     */
    public function getCity()
    {
        if(empty($this->city_id))
        {
            return "N/A";
        }

        return City::where("id", $this->city_id)->select("city_name")->first()->city_name;
    }

    public function getFeedback()
    {
        $feedback = Feedbacks::where("user_id", $this->id)->first();
        if(empty($feedback))
        {
            return false;
        }

        return $feedback->feedback;
    }
}
