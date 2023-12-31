<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    use HasFactory;

    protected $table="educations";

    public function personal()
    {
        return $this->belongsTo('App\Models\Personal','personal_id');
    }

    public function Eds(){
        return $this->hasMany('App\Models\Ed','education_id');
    }

}
