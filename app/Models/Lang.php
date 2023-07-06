<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lang extends Model
{
    use HasFactory;

    protected $table="langs";

    public function personal()
    {
        return $this->belongsTo('App\Models\Personal','personal_id');
    }
}
