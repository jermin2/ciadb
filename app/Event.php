<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = ['name', 'location' , 'notes'];

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function people()
    {
        return $this->belongsToMany(Person::class);
    }

    public function author()
    {
        return $this->belongsTo(User::class);
    }
}
