<?php

namespace App\Models\user;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Job extends Model
{
    protected $guarded      =   [];
    public $timestamps      =   false;
    use HasFactory;

    public function delete()
    {
        Favorite_job::where("job_id", $this->id)->delete();
        Job_applicant::where("job_id", $this->id)->delete();
        Job_skill::where("job_id", $this->id)->delete();

        parent::delete();
    }

    public function isFavorite()
    {
        $favorite_jobs = Favorite_job::where("user_id", Auth::id())->pluck("job_id")->toArray();
        return in_array($this->id, $favorite_jobs);
    }

    public function isExpired()
    {
        return $this->expiry_date < now()->toDateString();
    }

    public function remainingDays()
    {
        return ceil(now()->diffInDays($this->expiry_date));
    }

    public function isOwner($user)
    {
        if(empty($user))
        {
            return false;
        }
        if($user->id != $this->user_id)
        {
            return false;
        }
        return true;
    }
}
