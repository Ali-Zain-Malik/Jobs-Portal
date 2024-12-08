<?php

namespace App\Models\user;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
