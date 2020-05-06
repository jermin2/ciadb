<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    protected $fillable = ['first_name', 'last_name', 'email', 'number'];

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function events()
    {
        return $this->belongsToMany(Event::class);
    }

    public function user()
    {
        return $this->hasOne(User::class);
    }

    public function name()
    {
        return $this->first_name.' '.$this->last_name;
    }

}
