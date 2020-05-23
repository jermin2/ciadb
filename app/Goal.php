<?php

namespace App;
use Carbon\Carbon;

use Illuminate\Database\Eloquent\Model;

class Goal extends Model
{
    protected $fillable = ['goal', 'start_date', 'end_date', 'author_id', 'person_id', 'private'];
    public function person()
    {
        return $this->belongsTo(Person::class);
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function getStartDateAttribute( $value ) {
        return (new \Carbon\Carbon($value))->format('d-m-Y');
    }
    
}
