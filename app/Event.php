<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = ['name', 'location' , 'time', 'notes'];

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

    public function getTimeAttribute( $value ) {
        return (new \Carbon\Carbon($value))->format('D, jS M H:i Y');
    }
}