<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ed extends Model
{
    use HasFactory;

    protected $table="edudetails";


    public function education()
    {
        return $this->belongsTo('App\Models\Education','education_id');
    }
}
