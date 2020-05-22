<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    protected $fillable = ['first_name', 'last_name', 'email', 'number', 'year', 'dob', 'baptism', 'parents', 'school', 'notes'];

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

    public function usertags()
    {
        return $this->belongsToMany(Usertag::class);
    }

    public function goals()
    {
        return $this->hasMany(Goal::class);
    }

    public function getDobAttribute( $value ) {
        return (new \Carbon\Carbon($value))->format('d-m-Y');
    }

    public function getBaptismAttribute( $value ) {
        return (new \Carbon\Carbon($value))->format('d-m-Y');
    }

    
    public function setDobAttribute($value) {
        $this->attributes['dob'] =  \Carbon\Carbon::createFromFormat('d-m-Y', $value);
    }

    public function setBaptismAttribute($value) {
        $this->attributes['baptism'] =  \Carbon\Carbon::createFromFormat('d-m-Y', $value);
    }

}
