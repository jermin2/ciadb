<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    //

    public function people()
    {
        return $this->belongsToMany(Person::class);
    }
}
