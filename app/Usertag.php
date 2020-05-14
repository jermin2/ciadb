<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Usertag extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'user_id', 'color'
    ];

    public $timestamps = false;

    public function people()
    {
        return $this->belongsToMany(Person::class);
    }

    public function events()
    {
        return $this->belongsToMany(Event::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
