<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'tagtype_id', 'color'
    ];

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
