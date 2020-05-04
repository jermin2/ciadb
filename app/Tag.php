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

    public function tagtype()
    {
        return $this->belongsTo(Tagtype::class);
    }

    public function events()
    {
        return $this->belongsToMany(Event::class);
    }
}
