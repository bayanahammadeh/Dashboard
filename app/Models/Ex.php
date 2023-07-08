<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ex extends Model
{
    use HasFactory;

    protected $table="jobs";


    public function experience()
    {
        return $this->belongsTo('App\Models\Experience','experience_id');
    }
}
