<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = ['name', 'location' , 'time', 'notes', 'author_id', 'private'];

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

    public function usertags()
    {
        return $this->belongsToMany(Usertag::class)->where('user_id', auth()->user()->id);;
    }

    public function shortdate()
    {
        $date = \Carbon\Carbon::createFromFormat('D, jS M H:i Y',$this->time);
        return $date->format('jS M');
    }

}