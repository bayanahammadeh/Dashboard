<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Personal extends Model
{
    use HasFactory;

    protected $table="personals";

    public function skills(){
        return $this->hasMany('App\Models\Skill','personal_id');
    }
    public function projects(){
        return $this->hasMany('App\Models\Project','personal_id');
    }
    public function educations(){
        return $this->hasMany('App\Models\Education','personal_id');
    }
    public function experiences(){
        return $this->hasMany('App\Models\Experience','personal_id');
    }
    public function langs(){
        return $this->hasMany('App\Models\Lang','personal_id');
    }
}
