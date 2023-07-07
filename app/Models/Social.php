<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Social extends Model
{
    use HasFactory;

    protected $table="socials";

    public function personal()
    {
        return $this->belongsTo('App\Models\Personal','personal_id');
    }
}
