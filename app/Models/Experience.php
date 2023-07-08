<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    use HasFactory;

    protected $table="experiences";

    public function personal()
    {
        return $this->belongsTo('App\Models\Personal','personal_id');
    }

    public function Exs(){
        return $this->hasMany('App\Models\Ex','experience_id');
    }
}
