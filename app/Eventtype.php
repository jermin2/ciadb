<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Eventtype extends Model
{
    protected $fillable = ['name'];
    public $timestamps = false;
}
