<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tagtype extends Model
{
   public function tags()
   {
    return $this->hasMany(Tag::class);
   }
}
