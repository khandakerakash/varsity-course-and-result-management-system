<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RegisterStudent extends Model
{
    public function department()
    {
        return $this->belongsTo('Department');
    }
}
